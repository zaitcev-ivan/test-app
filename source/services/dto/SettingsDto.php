<?php

namespace app\source\services\dto;

class SettingsDto
{
    public $limitSum;
    public $scenario;
    public $userId;

    public function __construct($limitSum, $scenario, $userId)
    {
        $this->limitSum = $limitSum;
        $this->scenario = $scenario;
        $this->userId = $userId;
    }
}