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
    var p = $('.clickable');
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
    'action' => ['/translator/arabic/translation'],
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
        
        
        
        
        <div class="col-sm-7">

            <p class="lead">         </p>  


            <div class="row">
                <div class="col-md-4"><h3><?php
                
                
                        if (isset($definition) && is_object($definition[0])) {
                            $word = $definition[0]->word;
                            echo '<p class="text-capitalize">' . $word . '</p>';
                        }
                        ?></h3>
                    
                    <h4> <?php echo  $translation;?>
</h4>
                </div>
                <div class="col-md-4">
                        <?php
                        if (isset($definition) && is_array($audio)) {
                            echo '<button id="audio_b" type="button" class="btn btn-primary btn ">
                    <span class="glyphicon glyphicon-play-circle" aria-hidden="true"></span>
                </button>';
                        }
                        ?>
                </div>

                <div class="col-md-4"></div>
            </div>

            <p id="PartOfSpeach"> 
                    
<?php
if (isset($definition) && is_object($definition[0])) {
    $part_Of_Speech = $definition[0]->partOfSpeech;
    echo $part_Of_Speech;
}
?>
                          </p>


                                <?php
                                $imageHtml = <<<END
        
                               <h3>Images</h3>
                                       <p>
            <small>
                <p class="text-muted">powerd by <a href="http://pixabay.com/"  target="_blank" class="text-muted" >Pixabay</a> </p>
       
            </small>
            </p>
END;


                                if (isset($image) && !count($image['hits']) == 0) {

                                    echo $imageHtml;
                                }
                                ?>

            <?php
            
            
            if (isset($image)){
            foreach ($image['hits'] as $photo) {
                $Preview = $photo['previewURL'];

                $page_url = $photo['pageURL'];

                echo '<a target="_blank" href="' . $page_url . '"><img  src="' . $Preview . '"   '
                . 'height="80" width="80" ></a>';
            }
            
            
            }
            ?>


            <h3>Definition</h3>
            <small>
     
            </small>              

            <ol>

                <p class="lead">  
                    <?php
                    if ( isset($definition) && is_object($definition[0])) {
                        foreach ($definition as $value) {
                            echo '<li><p class="clickable" >' . $value->text . '</p>'
                                    . '<small> <p class="text-muted">'.$value->attributionText.'</p></small>'
                                    . '</li>';
                        }
                    }
                    ?>
                </p>




            </ol>


            <p></p>

                    <?php
                    if ( isset($definition) && is_object($definition[0])) {
                        if (count($example->examples) > 0) {


                            echo $ExampleTitle ='<h3>Examples</h3>';
                }
                    }
                    ?>

            <ul>
                <p class="lead"> 
            <?php
            if (isset($definition) && is_object($definition[0])) {
                if (count($example->examples) > 0) {
                    foreach ($example->examples as $object) {

                        echo "<li><p class='clickable'>" . $object->text . "</p>"
                                . "<small>
                        <p class='text-muted'>".Html::a($object->title ,$object->url,array('target'=>'blank'))."  </p>
       
            </small>   </li>";
                    }
                }
            }
            ?>
                </p>
            </ul>


<p>

<?php
if (isset($wiki) && $wiki_count = strlen($wiki) > 600) {
    echo $wiki = <<<END
                           <div id='wiki' class="body-content">

                            <h3>Wikipedia</h3>
           <small>
                <p class="text-muted">From <a href="http://en.wikipedia.org/wiki/$word"  target="_blank" class="text-muted" >Wikipedia</a> </p>
       
            </small> 
                        
                   
                       $wiki 

            </div>
END;
}
?>



            </p>
            <ul id="suggestions" class="list-unstyled">


            <?php
            if (isset($suggestions) && count($suggestions) != 0) {
                echo "<h2>More Suggestions:</h2>";
                
                
                
            for ($i = 0; $i < count($suggestions); $i ++) {

                echo "<li>" . Html::a(str_replace("'", "", $suggestions[$i]), ['/dictionary/index/', 'word' => str_replace("'", "", $suggestions[$i])]) . "</li>";
            }
            
            
            }

            ?>

            </ul>
            
                        <a  href="http://www.wordnik.com/words/<?php echo $word = $definition[0]->word ?>"> <img src="/wordnik_badge_a2.png"  alt="Power by Wordnik" > </a>

        </div>
        <script>
            $(document).ready(function () {
                $.ajax({
                    type: 'post',
                    url: "<?php echo Url::to(['dictionary/audio']); ?>",
                    success: function (result) {
                        $("#audio").html(result);
                    }
                });

                $("#wiki a").on('click', function (e)
                {
                    e.preventDefault();
                    var win = window.open('<?php if (isset($word)) echo 'http://en.wikipedia.org/wiki/' . $word ?>', '_blank');
                    if (win) {
                        //Browser has allowed it to be opened
                        win.focus();
                    } else {
                        //Broswer has blocked it
                        alert('Please allow popups for this site');
                    }
                });

                $("#audio_b").on('click', function () {
                    $("#audio").trigger('play');
                });


                $('#wiki').readmore({
                    speed: 75,
                    maxHeight: 500
                });

            });
        </script>     

        <audio id="audio">
            <source src="<?php if (isset($audio) && is_array($audio)) echo $audio[0]->fileUrl; ?>" type="audio/mpeg">
            Your browser does not support the audio element.
        </audio>


        <div class="col-xs-6 col-md-4">
            
                      
            
        </div>
        
        
    </div>   
</div>
