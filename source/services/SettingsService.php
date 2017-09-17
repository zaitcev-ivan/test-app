<?php

namespace app\source\services;

use app\source\entities\Settings;
use app\source\forms\SettingsEditForm;
use app\source\repositories\SettingsRepository;

class SettingsService
{
    private $settings;

    public function __construct(
        SettingsRepository $settings
    )
    {
        $this->settings = $settings;
    }

    public function edit(SettingsEditForm $form, $userId): void
    {
        $userSettings = $this->settings->getByUserId($userId);
        $userSettings->edit($form->limit_sum,$form->scenario);
        $this->settings->save($userSettings);
    }
}