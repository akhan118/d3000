<?php

/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

namespace app\assets;

use yii\web\AssetBundle;

/**
 * @since 2.0
 */
class localAssets extends AssetBundle
{
    public $basePath = '@webroot';
    public $baseUrl = '@web';
    public $css = [
        'VirtualKeyboard/keyboard.css',
    ];

    
        public $js = [
      'VirtualKeyboard/keyboard.js',
    ];
        
        
        
     

}
