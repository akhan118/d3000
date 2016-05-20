<?php

use yii\web\Controller;
use yii\helpers\Url;
use yii\jui\AutoComplete;
use yii\helpers\Html;
use yii\widgets\ActiveForm;

$this->registerCssFile(Yii::$app->request->baseUrl.'/css/wiki.css'); 

/* @var $this yii\web\View */

$this->title = 'Definition of ' . $definition[0]->word;
$this->params['breadcrumbs'][] = $this->title;

?>
<script src="//code.jquery.com/jquery-1.11.2.min.js"></script>
<script src="//code.jquery.com/jquery-migrate-1.2.1.min.js"></script>
<script>
    $(document).ready(function() {
        var p = $('.row p');
        p.css({cursor: 'pointer'});
        p.dblclick(function(e) {
            var range = window.getSelection() || document.getSelection() || document.selection.createRange();
            var word = $.trim(range.toString());
            if (word !== '') {
                window.location = ' http://dictionary3000.com/dictionary/index?word=' + word;
            }
            range.collapse();
            e.stopPropagation();
        });
    });
</script>


<div class="site-index">


    <div class="row">

        <div class="col-xs-12 col-md-8">

            <div class="row">
                <div class="col-xs-5 col-md-3">
                    <h3><?php
if (is_object($definition[0])) {
    $word = $definition[0]->word;
    echo '<span class="">' . $word . '</span>';
}
?>   

                    </h3>

                </div>
                <div class=" col-xs-1 col-md-1">
                    <?php
                    if (is_array($audio)) {
                        echo '<span id="audio_b"  >
                    <span class="glyphicon glyphicon-volume-up audio_icon" aria-hidden="true"></span>
                </span>';
                    }
                    ?>
                </div>


                <div class="col-xs-6 col-md-6"><span class="text-muted"><?php echo $textproun; ?></span></div>


            </div>

            <div class="row">

                <div class="col-md-4">



                    <span id="PartOfSpeach" class="text-muted">
                        <?php
                        if (is_object($definition[0])) {
                            $part_Of_Speech = $definition[0]->partOfSpeech;
                            echo $part_Of_Speech;
                        }
                        ?>
                    </span>

                </div>

            </div>

            <div class="row">


                <?php
                $imageHtml = <<<END
        
          <h3>Images</h3>
                                       <span>
            <small>
                <span class="text-muted">From <a href="http://pixabay.com/"  target="_blank" class="text-muted" >Pixabay</a> </span>
       
            </small>
            </span>
        </br>
END;


                if (!count($image['hits']) == 0) {

                    echo $imageHtml;

                    foreach ($image['hits'] as $photo) {
                        $Preview = $photo['previewURL'];

                        $page_url = $photo['pageURL'];

                        echo '<a target="_blank" href="' . $page_url . '"><img  src="' . $Preview . '"   '
                        . 'height="80" width="80" ></a>';
                    }
                }
                ?>



            </div>


            <div class="row">
                <?php if (is_object($definition[0])) echo '<h3>Definition</h3>
' ?>                <small>
                    <span class="text-muted"> <?php
            if (is_object($definition[0])) {

                echo $definition[0]->attributionText;
            }
                ?> </span>

                </small>              

                <ol>

                    <p class="lead">  

                        <?php
                        if (is_object($definition[0])) {
                            foreach ($definition as $value) {
                                echo '<li><p>' . $value->text . '</p></li>';
                            }
                        }
                        ?>

                    </p>




                </ol>



            </div>


            <div class="row">



                <?php
                if (is_object($definition[0])) {
                    if (count($example->examples) > 0) {

                        $example_att = $definition[0]->attributionText;

                        echo $imageHtml = <<<END
                   <h3>Examples</h3>
           <small>
                        <span class="text-muted"> $example_att  </span>
       
            </small>   
END;
                    }
                }
                ?>

                <ul>
                    <p class="lead"> 
                        <?php
                        if (is_object($definition[0])) {
                            if (count($example->examples) > 0) {
                                foreach ($example->examples as $object) {

                                    echo "<li><p>" . $object->text . "</p></li>";
                                }
                            }
                        }
                        ?>
                    </p>
                </ul>


                <p>


            </div>
            <div class="row" >



                <p>

                    <?php
                    if ($wiki_count = strlen($wiki) > 600) {
                        echo $wiki = <<<END
                           <div id='wiki' class="body-content">

                            <h3>Wikipedia</h3>
           <small>
                <span class="text-muted">From <a href="http://en.wikipedia.org/wiki/$word"  target="_blank" class="text-muted" >Wikipedia</a> </span>
       
            </small> 
                        
                   
                       $wiki 

            </div>
END;
                    }
                    ?>



                </p>
            </div> 

            <div class="row">

                <ul id="suggestions" class="list-unstyled">


                    <?php
                    if (count($suggestions) != 0) {
                        echo "<h2>More Suggestions:</h2>";
                    }

                    for ($i = 0; $i < count($suggestions); $i ++) {

                        echo "<li>" . Html::a(str_replace("'", "", $suggestions[$i]), ['/dictionary/index/', 'word' => str_replace("'", "", $suggestions[$i])]) . "</li>";
                    }
                    ?>

                </ul> 



            </div>
        </div>
        <div class="col-xs-6 col-md-4">

<!--            <script async src="//pagead2.googlesyndication.com/pagead/js/adsbygoogle.js"></script>
             d3000_main_page_index 
            <ins class="adsbygoogle"
                 style="display:block"
                 data-ad-client="ca-pub-2713579882698065"
                 data-ad-slot="1576865242"
                 data-ad-format="auto"></ins>
            <script>
    (adsbygoogle = window.adsbygoogle || []).push({});
            </script>-->

        </div>

    </div>  
    <audio id="audio">
        <source src="<?php if (is_array($audio)) echo $audio[0]->fileUrl; ?>" type="audio/mpeg">
        Your browser does not support the audio element.
    </audio>

</div>


<script>
    $(document).ready(function() {
        $.ajax({
            type: 'post',
            url: "<?php echo Url::to(['dictionary/audio']); ?>",
            success: function(result) {
                $("#audio").html(result);
            }
        });

        $("#wiki a").on('click', function(e)
        {
            e.preventDefault();
            var win = window.open('<?php echo 'http://en.wikipedia.org/wiki/' . $word ?>', '_blank');
            if (win) {
                //Browser has allowed it to be opened
                win.focus();
            } else {
                //Broswer has blocked it
                alert('Please allow popups for this site');
            }
        });

        $("#audio_b").on('click', function() {
            $("#audio").trigger('play');
        });




    });
</script>     
