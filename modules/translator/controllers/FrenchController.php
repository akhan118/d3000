<?php
namespace app\modules\translator\controllers;

use yii\web\Controller;
use Yii;

class FrenchController extends Controller {

    
    
    
    function actionIndex()
    {
 
        
$session = Yii::$app->session;

if(!$session->isActive)
{
    $session->open();
}
$session->set('lang_code', 'fr');
$session->set('lang','French');
$session->close();


        return   $controller=Yii::$app->runAction('translator/arabic/index');
        
    }
    
    
    
    
      public function actionTranslation() {
        
         $session = Yii::$app->session;

if(!$session->isActive)
{
    $session->open();
}
$session->set('lang_code', 'fr');
$session->set('lang','French');
$session->close();


        return   $controller=Yii::$app->runAction('translator/arabic/translation');

          
          
      }
     
}