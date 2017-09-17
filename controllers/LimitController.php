<?php

namespace app\controllers;

use app\source\entities\Limit;
use app\source\forms\LimitEditForm;
use Yii;
use app\models\search\LimitSearch;
use yii\web\Controller;
use app\source\services\LimitService;
use yii\filters\VerbFilter;
use yii\filters\AccessControl;
use yii\web\NotFoundHttpException;

class LimitController extends Controller
{
    private $service;

    public function __construct($id, $module, LimitService $service, $config = [])
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
        $searchModel = new LimitSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);

        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }

    public function actionView($id)
    {
        $limit = $this->findModel($id);
        return $this->redirect(['update', 'id' => $limit->id]);
    }

    public function actionUpdate($id)
    {
        $limit = $this->findModel($id);
        $form = new LimitEditForm($limit);

        if ($form->load(Yii::$app->request->post()) && $form->validate()) {
            try {
                $this->service->edit($form, $limit->id, Yii::$app->user->id);
                Yii::$app->session->setFlash('success', 'Предельная сумма изменена');
                return $this->redirect(['index']);
            } catch (\DomainException $e) {
                Yii::$app->errorHandler->logException($e);
                Yii::$app->session->setFlash('error', $e->getMessage());
            }
        }
        return $this->render('update', [
            'model' => $form,
        ]);
    }

    public function actionDelete($id)
    {
        $limit = $this->findModel($id);
        try {
            $this->service->remove($limit->id, Yii::$app->user->id);
            Yii::$app->session->setFlash('success', 'Предельная сумма удалена');
        } catch (\DomainException $e) {
            Yii::$app->session->setFlash('error', $e->getMessage());
        }
        return $this->redirect(['index']);
    }

    protected function findModel($id)
    {
        if (($model = Limit::findOne(['id' => $id,'user_id' => Yii::$app->user->id])) !== null) {
            return $model;
        } else {
            throw new NotFoundHttpException('Запрашиваемая страница не существует');
        }
    }
}