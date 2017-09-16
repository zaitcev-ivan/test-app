<?php

namespace app\controllers;

use app\source\forms\CategoryCreateForm;
use Yii;
use app\models\search\CategorySearch;
use yii\web\Controller;
use app\source\services\CategoryService;
use yii\filters\VerbFilter;
use yii\filters\AccessControl;

class CategoryController extends Controller
{
    private $service;

    public function __construct($id, $module, CategoryService $service, $config = [])
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

    /**
     * Lists all Category models.
     * @return mixed
     */
    public function actionIndex()
    {
        $searchModel = new CategorySearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);

        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }

    public function actionCreate()
    {
        $form = new CategoryCreateForm();

        if ($form->load(Yii::$app->request->post()) && $form->validate()) {
            try {
                $this->service->create($form, Yii::$app->user->id);
                Yii::$app->session->setFlash('success', 'Новая категория создана');
                return $this->redirect(['index']);
            } catch (\DomainException $e) {
                Yii::$app->errorHandler->logException($e);
                Yii::$app->session->setFlash('error', $e->getMessage());
            }
        }

        return $this->render('create', [
            'model' => $form,
        ]);
    }
}