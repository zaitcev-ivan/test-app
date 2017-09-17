<?php

namespace app\source\services;

use app\source\forms\LimitEditForm;
use app\source\repositories\LimitRepository;
use app\source\repositories\UserRepository;

class LimitService
{
    private $limits;
    private $users;

    public function __construct(
        LimitRepository $limits,
        UserRepository $users
    )
    {
        $this->limits = $limits;
        $this->users = $users;
    }

    public function edit(LimitEditForm $form, $limitId, $userId): void
    {
        $limit = $this->limits->get($limitId);
        $user = $this->users->get($userId);
        if(!$limit->user_id == $user->id) {
            throw new \DomainException("Ошибка в выборе ограничений");
        }
        $limit->editLimit($form->limit_sum);
        $this->limits->save($limit);
    }

    public function remove($limitId, $userId): void
    {
        $limit = $this->limits->get($limitId);
        $user = $this->users->get($userId);
        if(!$limit->user_id == $user->id) {
            throw new \DomainException("Ошибка в выборе ограничений");
        }
        $this->limits->remove($limit);
    }
}