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
}