<?php

namespace app\source\services;

use app\source\entities\User;
use app\source\entities\Settings;
use app\source\repositories\UserRepository;
use app\source\repositories\SettingsRepository;
use app\source\services\dto\SettingsDto;
use app\source\forms\SignupForm;


class SignupService
{
    private $users;
    private $settings;
    private $transaction;

    public function __construct(
        UserRepository $users,
        SettingsRepository $settings,
        TransactionManager $transaction
    )
    {
        $this->users = $users;
        $this->settings = $settings;
        $this->transaction = $transaction;
    }

    public function signup(SignupForm $form, SettingsDto $settingsDto) : User
    {
        $user = User::requestSignup(
            $form->username,
            $form->email,
            $form->password
        );

        $this->transaction->wrap(function () use ($user, $settingsDto) {
            $this->users->save($user);
            $settingsDto->userId = $user->id;
            $settings = Settings::create($settingsDto);
            $this->settings->save($settings);
        });

        return $user;
    }

}