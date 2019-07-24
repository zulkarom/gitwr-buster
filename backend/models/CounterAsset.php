<?php
namespace backend\models;

class CounterAsset extends \yii\web\AssetBundle
{
    public $sourcePath = '@backend/views/myasset';
	
	public $js = [
		'js/jquery.plugin.min.js',
		'js/jquery.countdown.js'
		
    ];
	
	public $css = [
		'css/jquery.countdown.css',
    ];



}
