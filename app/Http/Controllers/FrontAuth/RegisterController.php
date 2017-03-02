<?php

namespace App\Http\Controllers\FrontAuth;

use App\User;
use Mail;
use Validator;
use Session;
use App\Http\Controllers\Controller;
use Illuminate\Foundation\Auth\RegistersUsers;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Auth\Events\Registered;
use Illuminate\Support\Facades\Input;
use Illuminate\Support\Facades\Redirect;
use Doctrine\ORM\EntityManager;
use App\Repository\UserRepo as repo;

class RegisterController extends Controller {

    /**
     * Get the post register / login redirect path.
     *
     * @return string
     */
    public function redirectPath() {
        return property_exists($this, 'redirectTo') ? $this->redirectTo : '/home';
    }

    /**
     * Show the application registration form.
     *
     * @return \Illuminate\Http\Response
     */
    public function showRegistrationForm() {
        return view('front.auth.register');
    }

    /**
     * Handle a registration request for the application.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function register(Request $request) {
        $this->validator($request->all())->validate();

        event(new Registered($user = $this->create($request->all())));

//        Auto login
//        $this->guard()->login($user);

        return redirect('user/login');
    }

    /**
     * Get the guard to be used during registration.
     *
     * @return \Illuminate\Contracts\Auth\StatefulGuard
     */
    protected function guard() {
        return Auth::guard();
    }

    /**
     * The user has been registered.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  mixed  $user
     * @return mixed
     */
    protected function registered(Request $request, $user) {
//
    }

    /**
     * Where to redirect users after login / registration.
     *
     * @var string
     */
    protected $redirectTo = '/home';

    /**
     * @var EntityManager
     */
    protected $em;
    private $repo;

    /**
     * Create a new controller instance.
     *
     * @param EntityManager $em
     */
    public function __construct(EntityManager $em, repo $repo) {
        $this->middleware('guest');

        $this->em = $em;

        $this->repo = $repo;
    }

    /**
     * Get a validator for an incoming registration request.
     *
     * @param  array $data
     *
     * @return \Illuminate\Contracts\Validation\Validator
     */
    protected function validator(array $data) {
        return Validator::make(
                        $data, [
                    'name' => 'required|max:255',
                    'email' => sprintf('required|email|max:255|unique:%s,email', User::class),
                    'password' => 'required|min:8|confirmed',
        ]);
    }

    /**
     * Create a new user instance after a valid registration.
     *
     * @param  array $data
     *
     * @return User
     */
    protected function create(array $data) {
        Session::flash('success', 'Please check your Mail Box for verification!');

        $confirmation_code = str_random(30);
        Mail::send('auth.verify', ['confirmation_code' => $confirmation_code], function($message) {
            $message->to(Input::get('email'), Input::get('username'))
                    ->subject('Verify your email address');
        });
        $usrObject = new User();
        $usrObject->setName($data['name']);
        $usrObject->setEmail($data['email']);
        $usrObject->setPassword(bcrypt($data['password']));
        $usrObject->setConfirmationCode($confirmation_code);
        $this->em->persist($usrObject);
        $this->em->flush($usrObject);
        return $usrObject;
    }

    public function confirm(Request $request, $confirmation_code) {
        if (!$confirmation_code) {
            $request->session()->flash('error', 'Confirmation Token Not Found!');
            return redirect('user/login');
        }
        $usrObject = $this->repo->PostOfConfirmation_code($confirmation_code);
        if (!$usrObject) {
            $request->session()->flash('error', 'Confirmation Token Is Expired!');
            return redirect('user/login');
        }
        $usrObject->setConfirmed(1);
        $usrObject->setConfirmationCode(null);
        $this->em->persist($usrObject);
        $this->em->flush($usrObject);
        $request->session()->flash('success', 'You have successfully verified your account.');
        if ($usrObject->role == 'user') {
            return Redirect('user/login');
        }
        if ($usrObject->role == 'admin') {
            return Redirect('user/login');
        }
    }

}
