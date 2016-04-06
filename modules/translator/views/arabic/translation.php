<?php

use yii\web\Controller;
use yii\helpers\Url;
use yii\jui\AutoComplete;
use yii\helpers\Html;
use yii\widgets\ActiveForm;
use app\assets\arabic2_assets;
/* @var $this yii\web\View */

arabic2_assets::register($this);
 $language= $this->params['lang'];

$this->title = 'Definition of '.$definition[0]->word.' | '.$translation;
$this->params['breadcrumbs'][] = ['label' => 'Translators', 'url' => ['/translator']];
$this->params['breadcrumbs'][] = ['label' => $language.' English Dictionary', 'url' => ['/translator/'.strtolower($language)]];
?>



<script src="//code.jquery.com/jquery-1.11.2.min.js"></script>
<script src="//code.jquery.com/jquery-migrate-1.2.1.min.js"></script>

<div class="site-index">
    <div class="body-content ">
        <div class="container-fluid">
            <div class="row">
                 <div class="row">  
        
     <div class="col-sm-offset-4 col-md-offset-4 col-lg-offset-4 col-sm-5 col-md-4 col-lg-5 form-inline">

       <form id="w0" class="" action="<?php echo Url::to(['/translator/'.  strtolower($lang).'/translation']) ?>" method="get" role="search"><div class="form-group field-dictionary-input">
<label class="control-label" for="dictionary-input"></label>
<input type="text" id="dictionary-input" class="form-control keyboardInput" name="Dictionary[input]">

<div class="help-block"></div>
</div><button type="submit" class="btn btn-primary pull-right" name="search_button">Search</button></form>

         


     </div>  
                
                
                <div class="col-xs-12 col-sm-8 col-md-8">


                    <div class="col-xs-12 col-sm-11 col-md-12">
                        <h2 class="h2_border">

                            <?php
                            
                            
                            if (is_object($definition[0])) {
                                echo $word = $definition[0]->word;
                            }
                            ?>
                        </h2>
                        
              <h4> <?php echo  $translation;?></h4>
                    </div>

                    <div class="col-xs-4 col-sm-4 col-md-4">
                        <p class="text-muted"><?php
                            if ($definition[0]->partOfSpeech != null) {
                                echo '[' . $definition[0]->partOfSpeech . ']';
                            }
                            ?>
                        </p>
                    </div>


                    <div class=" col-xs-1 col-sm-1 col-md-6">
                        <?php
                        if (is_array($audio)) {
                            echo '<span id="audio_b"  >
                    <button class="glyphicon glyphicon-volume-up audio_icon" aria-hidden="true"></button>
                </span>';
                        }
                        ?>
                    </div>
                    <div class="col-xs-12 col-sm-12 col-md-12">
                        <p class="text-muted"> <?php echo $textproun ?></p>
                    </div>
                    

<div class="col-xs-12 col-sm-12 col-md-12">


                            <div class="col-xs-12 col-sm-12 clickable ">
                                <?php
                                if (is_object($definition[0])) {
                                    foreach ($definition as $value) {                                        
                                        echo '<blockquote cite="http://www.wordnik.com/words/'.$definition[0]->word.'">';
                                        echo '<p>'.$value->text.'</p>';
                                        echo '<footer> <cite title="'.$definition[0]->word.'">'.$value->attributionText.'</cite> </footer>';
                                        echo '</blockquote>';
                                        
                                        
                                        
                                        
                                    }
                                }
                                ?>
                            </div>
                        <p class="text-muted"><small><?php

                                ?> </small></p>
                    </div>
                </div>

<!--Ad-->
               <div class="col-xs-12 col-sm-4 col-md-4">
<script async src="//pagead2.googlesyndication.com/pagead/js/adsbygoogle.js"></script>
<ins class="adsbygoogle"
     style="display:block"
     data-ad-client="ca-pub-2713579882698065"
     data-ad-slot="3418889240"
     data-ad-format="auto"></ins>
<script>
(adsbygoogle = window.adsbygoogle || []).push({});
</script>
                </div>




            </div>
            <div class="row">
     <div class="col-xs-12 col-sm-10 col-md-8  ">

                <div class="col-xs-12 col-sm-10 col-md-12  ">
                    <?php
                    if (!count($image['hits']) == 0) {
                        $word = $definition[0]->word;
                        echo '<h4>Visuals for ' . $word . '</h4>';

                        echo '<ul>';
                        foreach ($image['hits'] as $photo) {
                            $Preview = $photo['previewURL'];

                            $page_url = $photo['pageURL'];

                            echo '<a target="_blank" href="' . $page_url . '"><img  src="' . $Preview . '"   '
                            . 'height="80" width="80" ></a>';
                        }
                    }
                    echo '</ul>';
                    ?>

                </div>
                
                
           
                
                
                <div class="col-xs-12 col-sm-10 col-md-12 ">
                    <h4>Examples For <?php echo $word = $definition[0]->word; ?></h4>

                    <span class="clickable">
                            <?php
                            if (is_object($definition[0])) {
                                if (count($example->examples) > 0) {

                                    foreach ($example->examples as $object) {
                                        
                                        echo '<blockquote cite="'.$object->url.'">';
                                        echo '<p>'.$object->text .'</p>';
                                        echo '<footer> <cite title="'.$object->title.'">'.Html::a($object->title ,$object->url,array('target'=>'blank')).'</cite> </footer>';
                                        echo '</blockquote>';

                                        
                                    }
                                }
                            }
                            
                            ?>
                            
                            
                            
                      
                            
                            
                            
                    </span>

                    

                </div>
                <div class="col-xs-12 col-sm-10 col-md-12 "> 
                    <?php
                    if ($wiki_count = strlen($wiki) > 600) {
                        echo $wiki = <<<END
                                <blockquote cite="http://en.wikipedia.org/wiki/$word">
                           <div id='wiki' class="body-content">
                            <h4>Wikipedia</h3>
           <small>
                <span class="text-muted">From <a href="http://en.wikipedia.org/wiki/$word"  target="_blank" class="text-muted" >Wikipedia</a> </span>
        </small>
                           <p>$wiki </p>
    </div>
                                </blockquote>
END;
                    }
                    ?>
                </div>
                <div class="col-xs-12 col-sm-10 col-md-12 ">
                    <?php
                    if (count($suggestions) != 0) {
                        echo "<h2>More Suggestions:</h2>";
                    }
                    for ($i = 0; $i < count($suggestions); $i ++) {
                        echo "<li>" . Html::a(str_replace("'", "", $suggestions[$i]), ['/translator/arabic/translation', 'word' => str_replace("'", "", $suggestions[$i])]) . "</li>";
                    }
                    ?>
                </div>
                

                <div class="col-xs-12 col-sm-10 col-md-12 ">
                    <?php
                    if ($related_words != NULL) {
                        echo '<h4>Related Words For ' . $word = $definition[0]->word . '</h4>';
                    }
                    ?>
                    <dl class=" dl-horizontal">
                        <?php
                        for ($i = 0; $i < count($related_words); $i ++) {
                            echo '<dt>' . $related_words[$i]->relationshipType . '</dt>';
                            for ($j = 0; $j < count($related_words[$i]->words); $j ++) {
                                echo '<dd>' . Html::a(str_replace("'", "", $related_words[$i]->words[$j]), ['/translator/arabic/translation', 'word' => str_replace("'", "", $related_words[$i]->words[$j])]) . '</dd>';
                            }
                        }
                        ?>
                    </dl>
                    </p>
                </div>
                

            </div>
                
                                

            </div>
            <a  href="http://www.wordnik.com/words/<?php echo $word = $definition[0]->word ?>"> <img src="/wordnik_badge_a2.png"  alt="Power by Wordnik" > </a>


        </div>
    </div>
</div>
</div>
<audio id="audio">
    <source src="<?php if (is_array($audio)) echo $audio[0]->fileUrl; ?>" type="audio/mpeg">
    Your browser does not support the audio element.
</audio>
<script>
    $(document).ready(function() {


        $("#wiki a").on('click', function(e)
        {
            e.preventDefault();
            var win = window.open('<?php echo 'http://en.wikipedia.org/wiki/' . $word = $definition[0]->word; ?>', '_blank');
            if (win) {
                //Browser has allowed it to be opened
                win.focus();
            } else {
                //Broswer has blocked it
                alert('Please allow popups for this site');
            }
        });

    });
</script>
<script>
    $(document).ready(function() {


        $("#audio_b").on('click', function() {
            $("#audio").trigger('play');
        });


        var p = $('.row p');
        p.css({cursor: 'pointer'});
        p.dblclick(function(e) {
            var range = window.getSelection() || document.getSelection() || document.selection.createRange();
            var word = $.trim(range.toString());
            if (word !== '') {
                window.location = ' http://dictionary3000.com/translator/<?php echo strtolower($lang) ?>/translation?word=' + word;
                //window.location = '/d3000c/web/dictionary/index?word=' + word;

            }
            range.collapse();
            e.stopPropagation();
        });
    });
</script>