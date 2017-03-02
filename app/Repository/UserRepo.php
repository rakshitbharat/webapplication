<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of UserRepo
 *
 * @author xperts
 */

namespace App\Repository;

use App\User;
use Doctrine\ORM\EntityManager;

class UserRepo {

    /**
     * @var string
     */
    private $class = 'App\User';

    /**
     * @var EntityManager
     */
    private $em;

    public function __construct(EntityManager $em) {
        $this->em = $em;
    }

    public function create(Post $post) {
        $this->em->persist($post);
        $this->em->flush();
    }

    public function update(Post $post, $data) {
        $post->setTitle($data['title']);
        $post->setBody($data['body']);
        $this->em->persist($post);
        $this->em->flush();
    }

    public function PostOfId($id) {
        return $this->em->getRepository($this->class)->findOneBy([
                    'id' => $id
        ]);
    }

    public function PostOfConfirmation_code($confirmation_code) {
        return $this->em->getRepository($this->class)->findOneBy([
                    'confirmationCode' => $confirmation_code
        ]);
    }
    
    public function findByEmail($email) {
        return $this->em->getRepository($this->class)->findOneBy([
                    'email' => $email
        ]);
    }

    public function delete(Post $post) {
        $this->em->remove($post);
        $this->em->flush();
    }

    /**
     * create Post
     * @return Post
     */
    private function perpareData($data) {
        return new Post($data);
    }

}
