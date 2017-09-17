<?php

namespace app\source\forms;

use Yii;
use yii\base\Model;
use app\source\entities\Limit;

use yii\helpers\ArrayHelper;

class LimitEditForm extends Model
{

    public $limit_sum;

    private $_limit;

    public function __construct(Limit $limit, array $config = [])
    {
        $this->limit_sum = $limit->limit_sum;
        $this->_limit = $limit;
        parent::__construct($config);
    }

    public function rules()
    {
        return [
            [['limit_sum'], 'required'],
        ];
    }

    public function attributeLabels()
    {
        return [
            'limit_sum' => 'Предельная сумма',
        ];
    }
}