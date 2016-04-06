<?php
use yii\widgets\ActiveForm;
use yii\helpers\Html;
use app\assets\localAssets;

/* @var $this yii\web\View */
localAssets::register($this);

$this->title = 'Dictionary3000';
?>



<div class="site-index">
                <div class="row">
     <div class="col-sm-offset-4 col-md-offset-4 col-lg-offset-4 col-sm-5 col-md-4 col-lg-5 form-inline">
       <?php                   
                    
                $form = ActiveForm::begin([
                        'options' => ['class' => '', 'role' => "search"],
        'method' => 'get',
    'action' => ['/test/arabic/translation'],
            ]);; 

  // echo     // $form->field(new app\models\Dictionary(), 'id') ;
     echo   $form->field(new app\models\Dictionary(), 'input')->textInput(array('class' => 'form-control keyboardInput')) ;

      //   echo '    <div class="form-group field-dictionary-input">';

          // echo  Html::submitButton('Submit', ['class' => 'btn btn-primary pull-left', 'name' => 'search_button']);
                echo  Html::submitButton('Search', ['class' => 'btn btn-primary pull-right', 'name' => 'search_button']);

  ///  echo '    </div>';
     ActiveForm::end();

                    
                    
                     ?>


         


     </div>
                    
                    
                    
</div>
</div>
