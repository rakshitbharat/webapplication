<?php

use Illuminate\Database\Seeder;
use Carbon\Carbon;

class UsersTableSeeder extends Seeder {

    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run() {
        //$carbon = new \Carbon\Carbon::now()->toDateTimeString();
        DB::table('users')->insert([
        'name' => 'timestart',
        'email' => 'test@gmail.com',
        'role' => 'admin',
        'confirmed' => 1,
        'created_at' => \Carbon\Carbon::now()->toDateTimeString(),
        'updated_at' => \Carbon\Carbon::now()->toDateTimeString(),
        'password' => bcrypt('12345678'),
        ]);
    }

}
