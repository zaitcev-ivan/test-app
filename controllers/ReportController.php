<?php

namespace app\controllers;

use Yii;
use yii\web\Controller;
use yii\filters\VerbFilter;
use yii\filters\AccessControl;
use app\source\services\ReportService;

class ReportController extends Controller
{
    private $service;

    public function __construct($id, $module, ReportService $service, $config = [])
    {
        parent::__construct($id, $module, $config);
        $this->service = $service;
    }

    public function behaviors()
    {
        return [
            'verbs' => [
                'class' => VerbFilter::className(),
                'actions' => [
                    'delete' => ['POST'],
                ],
            ],
            'access' => [
                'class' => AccessControl::className(),
                'rules' => [
                    [
                        'allow' => true,
                        'roles' => ['@'],
                    ],
                ],
            ],
        ];
    }

    public function actionMonthly()
    {
        $report = $this->service->createMonthlyReport(Yii::$app->user->id);

        return $this->render('monthly', [
            'report' => $report,
        ]);
    }

    public function actionSelectMonth()
    {
        $months = $this->service->selectAllMonth(Yii::$app->user->id);

        return $this->render('select-month', [
            'months' => $months,
        ]);
    }

    public function actionDetail($month = 0)
    {
        if($month == 0) {
            return $this->redirect(['select-month']);
        }

        $report = $this->service->createDetailReport($month, Yii::$app->user->id);

        return $this->render('detail', [
            'report' => $report,
        ]);
    }
}