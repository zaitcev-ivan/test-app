<?php

namespace app\source\repositories;

use app\source\entities\Settings;

class SettingsRepository
{
    public function get($id): Settings
    {
        if (!$settings = Settings::findOne($id)) {
            throw new NotFoundException('Настройки не найдены');
        }
        return $settings;
    }

    public function save(Settings $settings): void
    {
        if (!$settings->save()) {
            throw new \RuntimeException('Ошибка сохранения настроек');
        }
    }

    public function remove(Settings $settings): void
    {
        if (!$settings->delete()) {
            throw new \RuntimeException('Ошибка удаления настроек');
        }
    }

    private function getBy(array $condition): Settings
    {
        /* @var $settings \app\source\entities\Settings*/

        if (!$settings = Settings::find()->andWhere($condition)->limit(1)->one()) {
            throw new NotFoundException('Настройки не найдены');
        }
        return $settings;
    }
}