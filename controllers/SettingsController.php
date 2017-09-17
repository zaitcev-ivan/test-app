<?php

namespace app\controllers;

use app\source\entities\Settings;
use app\source\forms\SettingsEditForm;
use Yii;
use yii\web\Controller;
use app\source\services\SettingsService;
use yii\filters\VerbFilter;
use yii\filters\AccessControl;
use yii\web\NotFoundHttpException;

class SettingsController extends Controller
{
    private $service;

    public function __construct($id, $module, SettingsService $service, $config = [])
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

    public function actionIndex()
    {
        $settings = $this->findModel();
        $form = new SettingsEditForm($settings);

        if ($form->load(Yii::$app->request->post()) && $form->validate()) {
            try {
                $this->service->edit($form, Yii::$app->user->id);
                Yii::$app->session->setFlash('success', 'Настройки сохранены');
                return $this->redirect(['index']);
            } catch (\DomainException $e) {
                Yii::$app->errorHandler->logException($e);
                Yii::$app->session->setFlash('error', $e->getMessage());
            }
        }
        return $this->render('index', [
            'model' => $form,
        ]);
    }

    protected function findModel()
    {
        if (($model = Settings::findOne(['user_id' => Yii::$app->user->id])) !== null) {
            return $model;
        } else {
            throw new NotFoundHttpException('Запрашиваемая страница не существует');
        }
    }
}