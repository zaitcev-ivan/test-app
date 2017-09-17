<?php

namespace app\controllers;

use Yii;
use yii\web\Controller;
use app\source\services\SignupService;
use yii\filters\AccessControl;
use app\source\forms\SignupForm;
use app\source\services\dto\SettingsDto;

class SignupController extends Controller
{
    private $service;

    public function __construct($id, $module, SignupService $service, $config = [])
    {
        parent::__construct($id, $module, $config);
        $this->service = $service;
    }

    public function behaviors(): array
    {
        return [
            'access' => [
                'class' => AccessControl::className(),
                'only' => ['request'],
                'rules' => [
                    [
                        'actions' => ['request'],
                        'allow' => true,
                        'roles' => ['?'],
                    ],
                ],
            ],
        ];
    }

    /**
     * @return mixed
     */
    public function actionRequest()
    {
        $form = new SignupForm();
        if ($form->load(Yii::$app->request->post()) && $form->validate()) {
            try {
                $settings = new SettingsDto(
                    Yii::$app->params['settings.limitSum'],
                    Yii::$app->params['settings.scenario']
                );
                $this->service->signup($form, $settings);
                Yii::$app->session->setFlash('success', 'Вы успешно зарегистрировались, заполните форму входа');
                return $this->redirect(['site/index']);
            } catch (\DomainException $e) {
                Yii::$app->errorHandler->logException($e);
                Yii::$app->session->setFlash('error', $e->getMessage());
            }
        }

        return $this->render('request', [
            'model' => $form,
        ]);
    }

}