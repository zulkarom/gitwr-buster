<?php
namespace backend\models;

class MainAsset extends \yii\web\AssetBundle
{
    public $sourcePath = '@backend/views/myasset';
	
	public $js = [
		'js/moment-with-locales.js',
		'js/Chart.js'
		
		
    ];

}
