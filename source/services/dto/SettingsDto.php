<?php

namespace app\source\services\dto;

class SettingsDto
{
    public $limitSum;
    public $scenario;

    public function __construct($limitSum, $scenario)
    {
        $this->limitSum = $limitSum;
        $this->scenario = $scenario;
    }
}