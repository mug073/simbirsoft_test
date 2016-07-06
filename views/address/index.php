<?php

use yii\helpers\Html;
use yii\grid\GridView;
use yii\widgets\Pjax;
use kartik\daterange\DateRangePicker;
/* @var $this yii\web\View */
/* @var $searchModel app\models\AddressSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Addresses';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="address-index">

    <h1><?= Html::encode($this->title) ?></h1>
    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <p>
        <?= Html::a('Create Address', ['create'], ['class' => 'btn btn-success']) ?>

	<?= Html::a('Reset Filters', ['index'], ['class' => 'btn btn-danger']) ?>
    </p>
<?php Pjax::begin(); ?>    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

            'id',
            'country',
            'city',
            'street',
            'house',
    	    'zipcode',



                        [
                            'attribute' => 'created_at',
                            'format' => ['date', 'php:d.m.Y, H:s'],
			    'filter' => DateRangePicker::widget(
[
		    'name' => 'AddressSearch[created_at]',
	            'value' => $searchModel->created_at,
                    //'convertFormat'=>false,
                    'pluginOptions'=>[
                        //'format'=>'YYYY-MM-DD',
                        'opens'=>'left',
                    ]   
                    ]),


                        ], 





            //'updated_at',

            ['class' => 'yii\grid\ActionColumn'],
        ],
    ]); ?>
<?php Pjax::end(); ?></div>
