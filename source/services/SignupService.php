<?php

namespace app\source\services;

use app\source\entities\User;
use app\source\repositories\UserRepository;
use app\source\forms\SignupForm;


class SignupService
{
    private $users;

    public function __construct(
        UserRepository $users
    )
    {
        $this->users = $users;
    }

    public function signup(SignupForm $form) : User
    {
        $user = User::requestSignup(
            $form->username,
            $form->email,
            $form->password
        );

        $this->users->save($user);

        return $user;
    }

}