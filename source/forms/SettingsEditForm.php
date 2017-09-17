<?php

namespace app\source\forms;

use yii\base\Model;
use app\source\entities\Settings;

class SettingsEditForm extends Model
{
    public $limit_sum;
    public $scenario;

    private $_settings;

    public function __construct(Settings $settings, array $config = [])
    {

        $this->limit_sum = $settings->limit_sum;
        $this->scenario = $settings->scenario;

        $this->_settings = $settings;

        parent::__construct($config);
    }

    public function rules()
    {
        return [
            [['limit_sum','scenario'], 'required'],
            [['limit_sum', 'scenario'], 'integer'],
        ];
    }

    public function attributeLabels()
    {
        return [
            'scenario' => 'Сценарий превышения предела',
            'limit_sum' => 'Предельная сумма',
        ];
    }
}