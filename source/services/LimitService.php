<?php

namespace app\source\services;

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
}