<?php
use yii\helpers\Html;
use yii\widgets\ActiveForm;
use  yii\web\Session;
$this->title = 'Translators';
$this->params['breadcrumbs'][] = $this->title;

?>


<div class="translator-default-index">
    
                    <div class="col-xs-12 col-sm-8 col-md-4">



  <ul class="list-group">
          <li class="list-group-item"><?php echo Html::a('French English Translator', ['/translator/french/']); ?></li>

    <li class="list-group-item"><?php echo Html::a('Arabic English Translator', ['/translator/arabic']); ?></li>

  </ul>
    

                    </div>


</div>
