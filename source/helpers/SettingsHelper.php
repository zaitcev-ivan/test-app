<?php

namespace app\source\helpers;

use app\source\entities\Settings;
use yii\helpers\ArrayHelper;

class SettingsHelper
{
    public static function scenarioList(): array
    {
        return [
            Settings::SCENARIO_ADAPTIVE => 'Адаптивный предел',
            Settings::SCENARIO_INCREMENT => 'Увеличение предела',
        ];
    }

    public static function scenarioName($scenario): string
    {
        return ArrayHelper::getValue(self::scenarioList(), $scenario);
    }

    public static function isScenarioExist($scenario): bool
    {
        return ArrayHelper::getValue(self::scenarioList(), $scenario) ? true: false;
    }
}