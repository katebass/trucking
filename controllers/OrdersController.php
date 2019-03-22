<?php

namespace app\controllers;

use Yii;
use yii\base\Model;
use app\models\Orders;
use app\models\Drivers;
use app\models\DriversOrders;
use app\models\Salaries;
use app\models\OrdersSearch;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;

/**
 * OrdersController implements the CRUD actions for Orders model.
 */
class OrdersController extends Controller
{
    /**
     * {@inheritdoc}
     */
    public function behaviors()
    {
        return [
            'verbs' => [
                'class' => VerbFilter::className(),
                'actions' => [
                    'delete' => ['POST'],
                ],
            ],
        ];
    }

    /**
     * Lists all Orders models.
     * @return mixed
     */
    public function actionIndex()
    {
        $searchModel = new OrdersSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);

        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }

    /**
     * Displays a single Orders model.
     * @param integer $id
     * @return mixed
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionView($id)
    {
        return $this->render('view', [
            'model' => $this->findModel($id),
        ]);
    }

    /**
     * Creates a new Orders model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate()
    {
        $model = new Orders();
        $driver = new DriversOrders();

        if ($model->load(Yii::$app->request->post())) {
            $model->save();
            
            $driversData = Yii::$app->request->post('DriversOrders', []);
            
            foreach ($driversData['drivers'] as $driverPostData) {
                $driver = new DriversOrders();
                $driver->driver_id = $driverPostData['driver_id'];
                $driver->distance = $driverPostData['distance'];
                $driver->order_id = $model['id'];
                $driver->save();

                $driverDescription = Drivers::findOne($driver->driver_id);

                $salary = new Salaries();
                $salary->drivers_orders_id = $driver->id;

                $rateFactor = 1 + $driverDescription->experience / 10;
                $salary->salary =  $rateFactor * $driverDescription->rate * $driver->distance;
                
                $salary->save();
            }

            return $this->redirect(['view', 'id' => $model->id]);
        }

        return $this->render('create', [
            'model' => $model,
            'driversInOrder' => $driver
        ]);
    }

    /**
     * Updates an existing Orders model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param integer $id
     * @return mixed
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionUpdate($id)
    {
        $model = $this->findModel($id);        
        $driversInOrder = DriversOrders::find()->where(['order_id' => $model->id])->all();
        
        $postData = Yii::$app->request->post();

        if ($model->load(Yii::$app->request->post())) {
            
            $model->load($postData);
            $driversPostData = Yii::$app->request->post('DriversOrders', []);
            
            foreach ($driversData['drivers'] as $driverPostData) {
                /*
                $driver->load($postData->);
                $driver->order_id = $model->id;
                $driver->save();
                */
                $driver = DriversOrders::findOne($driverPostData['id']);
                $driver->load($driverPostData);
                echo "<pre>";
                print_r($driver);
                die;
                $driver->driver_id = $driverPostData['driver_id'];
                $driver->distance = $driverPostData['distance'];
                $driver->order_id = $model['id'];
                $driver->save();

                $driverDescription = Drivers::findOne($driverPostData->driver_id);
                
                $salary = Salaries::find()->where(['drivers_orders_id' => $driver->id])->one();
                $salary = isset($salary) ? $salary : new Salaries();
                $salary->drivers_orders_id = $driver->id;

                $rateFactor = 1 + $driverDescription->experience / 10;
                $salary->salary =  $rateFactor * $driverDescription->rate * $driver->distance;
                $salary->save(); 
            }

            if($model->save()){
                return $this->redirect(['view', 'id' => $model->id]);
            }
        }

        return $this->render('update', [
            'model' => $model,
            'driversInOrder' => $driversInOrder
        ]);
    }

    /**
     * Deletes an existing Orders model.
     * If deletion is successful, the browser will be redirected to the 'index' page.
     * @param integer $id
     * @return mixed
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionDelete($id)
    {
        $this->findModel($id)->delete();

        return $this->redirect(['index']);
    }

    public function actionReport()
    {
        $searchModel = new OrdersSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);

        return $this->render('report', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }

    /**
     * Finds the Orders model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @return Orders the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = Orders::findOne($id)) !== null) {
            return $model;
        }

        throw new NotFoundHttpException('The requested page does not exist.');
    }

}
