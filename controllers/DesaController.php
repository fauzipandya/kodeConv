<?php

namespace app\controllers;

use Yii;
use app\models\desa;
use yii\helpers\Json;
use app\models\searchDesa;
use app\models\searchRekap;
use app\models\searchLevenshtein;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;

/**
 * DesaController implements the CRUD actions for desa model.
 */
class DesaController extends Controller
{
    /**
     * @inheritdoc
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
     * Lists all desa models.
     * @return mixed
     */
    public function actionIndex()
    {
        $searchModel = new searchDesa();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);
    if (Yii::$app->request->isPjax) {
        return $this->renderPartial('index',[
            'searchModel'=> $searchModel,
            'dataProvider' => $dataProvider,
         ]);} else{ 
        return $this->render('index',[
            'searchModel'=> $searchModel,
            'dataProvider' => $dataProvider,
         ]);
         };
    }
    public function actionTmbps(){
        $searchModel=new \app\models\searchTMBPS();
        $dataProvider=$searchModel->search(Yii::$app->request->queryParams);
        return $this->render('tmbps',[
            'searchModel'=>$searchModel,
            'dataProvider'=>$dataProvider
        ]);
    }
    public function actionTmdagri(){
        $searchModel=new \app\models\searchTMDagri();
        $dataProvider=$searchModel->search(Yii::$app->request->queryParams);
        return $this->render('tmdagri',[
            'searchModel'=>$searchModel,
            'dataProvider'=>$dataProvider
        ]);
    }
    public function actionRekap(){
     $searchModel = new searchRekap();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);
    if (Yii::$app->request->isPjax) {
        return $this->renderPartial('rekap',[
            'searchModel'=> $searchModel,
            'dataProvider' => $dataProvider,
         ]);} else{ 
        return $this->render('rekap',[
            'searchModel'=> $searchModel,
            'dataProvider' => $dataProvider,
         ]);
         };
        
    }
 
//    public function actionGet()
//{
//	$request = Yii::$app->request;
//	$obj = $request->post('obj');
//	$value = $request->post('value');
//	switch ($obj) {
//		case 'PROV':
//			$data = desa::find()->andFilterWhere(['=', 'PROV', $value])->asArray();
//                        $renderSelectOptions = Html::renderSelectOptions([], ArrayHelper::map($data,'kab_bps','kab_bps'));
//			break;
//	}
////	$tagOptions = ['prompt' => "=== Select ==="];
//	return $renderSelectOptions;
//}

    public function actionLevenshtein(){ 
        $searchModelL= new searchLevenshtein();
        $dataProviderL = $searchModelL->search(Yii::$app->request->queryParams);
         if (Yii::$app->request->isPjax) {
        return $this->renderPartial('hasilL',[
            'searchModel'=> $searchModelL,
            'dataProvider' => $dataProviderL,
         ]);} else{ 
        return $this->render('hasilL',[
            'searchModel'=> $searchModelL,
            'dataProvider' => $dataProviderL,
         ]);
         };
    }
    /**
     * Displays a single desa model.
     * @param string $id
     * @return mixed
     */
    public function actionView($id)
    {
        return $this->render('view', [
            'model' => $this->findModel($id),
        ]);
    }

    /**
     * Creates a new desa model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    /**
     * Updates an existing desa model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param string $id
     * @return mixed
     */
    public function actionUpdate($id)
    {
        $model = $this->findModel($id);

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            return $this->redirect(['view', 'id' => $model->kode_bps]);
        } else {
            return $this->render('update', [
                'model' => $model,
            ]);
        }
    }

    /**
     * Deletes an existing desa model.
     * If deletion is successful, the browser will be redirected to the 'index' page.
     * @param string $id
     * @return mixed
     */
    public function actionKab(){
        $out=[];
        /* @var $_POST type */
        if(isset($_POST['depdrop_parents'])){
            /* @var $parents type */
            $parents = $_POST['depdrop_parents'];
            if($parents !=null){
                $prov_=$parents[0];
                $prov_=substr($prov_,0,2);
                $out=desa::find()->where(['substring(kode_bps,1,2)'=>$prov_])
                        ->select(['substring(kode_bps,1,4) as id','substring(kode_bps,1,4)||\' \'||kab_bps as name'])
                        ->distinct()->orderBy('id') ->asArray()->all();
                echo Json::encode(['output'=>$out,'selected'=>'']);
                return;
            }
        }
        echo Json::encode(['output'=>'','selected'=>'']);
    }
    public function actionKec(){
        $out=[];
        /* @var $_POST type */
        if(isset($_POST['depdrop_parents'])){
            /* @var $parents type */
            $parents = $_POST['depdrop_parents'];
            if($parents !=null){
                $kab_=$parents[0];
                $kab_=substr($kab_,0,4);
                $out=desa::find()->where(['substring(kode_bps,1,4)'=>$kab_])
                        ->select(['substring(kode_bps,1,7) as id','substring(kode_bps,1,7)||\' \'||kec_bps as name'])
                        ->distinct()->orderBy('id') ->asArray()->all();
                echo Json::encode(['output'=>$out,'selected'=>'']);
                return;
            }
        }
        echo Json::encode(['output'=>'','selected'=>'']);
    }
    public function actionKabdagri(){
        $out=[];
        /* @var $_POST type */
        if(isset($_POST['depdrop_parents'])){
            /* @var $parents type */
            $parents = $_POST['depdrop_parents'];
            if($parents !=null){
                $prov_=$parents[0];
                $prov_=substr($prov_,0,2);
                $out=desa::find()->where(['substring(kode_dagri,1,2)'=>$prov_])
                        ->select(['substring(kode_dagri,1,5) as id','substring(kode_dagri,1,5)||\' \'||kab_dagri as name'])
                        ->distinct()->orderBy('id') ->asArray()->all();
                echo Json::encode(['output'=>$out,'selected'=>'']);
                return;
            }
        }
        echo Json::encode(['output'=>'','selected'=>'']);
    }
    public function actionKecdagri(){
        $out=[];
        /* @var $_POST type */
        if(isset($_POST['depdrop_parents'])){
            /* @var $parents type */
            $parents = $_POST['depdrop_parents'];
            if($parents !=null){
                $kab_=$parents[0];
                $kab_=substr($kab_,0,5);
                $out=desa::find()->where(['substring(kode_dagri,1,5)'=>$kab_])
                        ->select(['substring(kode_dagri,1,8) as id','substring(kode_dagri,1,8)||\' \'||kec_dagri as name'])
                        ->distinct()->orderBy('id') ->asArray()->all();
                echo Json::encode(['output'=>$out,'selected'=>'']);
                return;
            }
        }
        echo Json::encode(['output'=>'','selected'=>'']);
    }
    /**
     * Finds the desa model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.workw
     * @param string $id
     * @return desa the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = desa::findOne($id)) !== null) {
            return $model;
        } else {
            throw new NotFoundHttpException('The requested page does not exist.');
        }
    }
    

}
