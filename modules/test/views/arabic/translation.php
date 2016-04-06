<?php

use yii\web\Controller;
use yii\helpers\Url;
use yii\jui\AutoComplete;
use yii\helpers\Html;
use yii\widgets\ActiveForm;
use app\assets\arabic2_assets;
/* @var $this yii\web\View */

arabic2_assets::register($this);

$this->title = 'Definition';
?>



<script src="//code.jquery.com/jquery-1.11.2.min.js"></script>
<script src="//code.jquery.com/jquery-migrate-1.2.1.min.js"></script>
<script src="../vendor/Readmore/readmore.js"></script>





<script>
$(document).ready(function () {
    var p = $('.row p');
    p.css({cursor: 'pointer'});
    p.dblclick(function (e) {
        var range = window.getSelection() || document.getSelection() || document.selection.createRange();
        var word = $.trim(range.toString());
        if (word !== '') {
            window.location = ' http://dictionary3000.com/translator/arabic/translation?Dictionary%5Binput%5D=' + word + '&search_button=';
        }
        range.collapse();
        e.stopPropagation();
    });
});
</script>


<div class="site-index">
    <div class="row">  

        <div class="col-sm-offset-4 col-md-offset-4 col-lg-offset-4 col-sm-5 col-md-4 col-lg-5 form-inline">
            <?php
            $form = ActiveForm::begin([
                        'options' => ['class' => '', 'role' => "search"],
                        'method' => 'get',
                        'action' => ['/test/arabic/translation'],
            ]);
            echo $form->field(new app\models\Dictionary(), 'input')->textInput(array('class' => 'form-control keyboardInput'));
            echo Html::submitButton('Search', ['class' => 'btn btn-primary pull-right', 'name' => 'search_button']);
            ActiveForm::end();
            ?>
        </div>
        
        
        
        
        <div class="col-sm-7">

            <p class="lead">         </p>  


            <div class="row">
                <div class="col-md-4"><h3>


                                <?php
                                
                                             var_dump($image);
                                $imageHtml = <<<END
        
                               <h3>Images</h3>
                                       <p>
            <small>
                <p class="text-muted">From <a href="http://pixabay.com/"  target="_blank" class="text-muted" >Pixabay</a> </p>
       
            </small>
            </p>
END;


                                   

                                echo $imageHtml;
                               
                      
                                
                                
                                ?>

            <?php
            
            
            
            


if (is_array($image) || is_object($image))
{
  
         echo 'array';
}

else
{
    
  echo  'nop';
  var_dump($image);
    
}
            

//            foreach ($image['hits'] as $photo) {
//                $Preview = $photo['previewURL'];
//
//                $page_url = $photo['pageURL'];
//                                
//
//                echo '<a target="_blank" href="' . $page_url . '"><img  src="' . $Preview . '"   '
//                . 'height="80" width="80" ></a>';
//            }
//            
            
  
            ?>

         

    

        <div class="col-xs-6 col-md-4">
            
                      
            
        </div>
        
        
    </div>   
</div>
