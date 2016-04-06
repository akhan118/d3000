<?php
use yii\widgets\ActiveForm;
use yii\helpers\Html;
use app\assets\localAssets;
use yii\helpers\Url;

/* @var $this yii\web\View */
localAssets::register($this);


if($lang =='Arabic'){
$this->title = $lang.' English Dictionary |قاموس عربي انجليز  ';

}
else{
   $this->title = $lang.' English Dictionary';
 
}

$this->params['breadcrumbs'][] = ['label' => 'Translators', 'url' => ['/translator']];
$this->params['breadcrumbs'][] = $lang.' English Dictionary';

?>



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
                        <div class="col-xs-12 col-sm-8 col-md-8 margin_top_wfd">
                            <div class="col-xs-1 col-sm-1 col-md-1">
                                <span class="glyphicon glyphicon-calendar fa-lg"> </span>
                            </div>
                            <div class="col-xs-8 col-sm-5 col-md-4 ">
                                <p class="badge">Word Of The Day</p>
                            </div>
                        </div>
                        <div class="col-xs-12 col-sm-11 col-md-6 clickable">
                            <h1 class="h2_border">
                                <?php
                                $definitions = $word_of_the_day->definitions;
                                echo Html::a(str_replace("'", "", $word_of_the_day->word), ['/translator/'.strtolower($lang).'/translation', 'word' => str_replace("'", "", $word_of_the_day->word)]);
                                ?>
                            </h1>
                                          <h4> <?php echo  $translation;?></h4>

                        </div>  
                        <div class="col-xs-12 col-sm-12 col-md-12">
                            <p class="text-muted"><?php 
                            if ($definitions[0]->partOfSpeech !=null){
                            echo '[' . $definitions[0]->partOfSpeech . ']';}
                                ?>
                            </p>
                        </div>  
                        <div class="col-xs-12 col-sm-12 col-md-12">
                            <p class="text-muted"> <?php  echo $text_pronun; ?></p>
                            <div class="col-xs-12 col-sm-12 clickable ">

                              <?php     
                                    for ($i = 0; $i < count($definitions); $i++) {
                                        echo '<blockquote cite="'.$definitions[$i]->source.'">';
                                        echo '<p>'.$definitions[$i]->text.'</p>';
                                        echo '<footer> <cite title="'.$definitions[$i]->source.'">'.$definitions[$i]->source.'</cite> </footer>';
                                        echo '</blockquote>';
                                    }
                                    ?>
                            </div> 
                        </div>
                    </div>


                <div class="col-xs-12 col-sm-4 col-md-4">
<script async src="//pagead2.googlesyndication.com/pagead/js/adsbygoogle.js"></script>
<!-- d3000_trans_index_336x280 -->
<ins class="adsbygoogle"
     style="display:block"
     data-ad-client="ca-pub-2713579882698065"
     data-ad-slot="5035223247"
     data-ad-format="auto"></ins>
<script>
(adsbygoogle = window.adsbygoogle || []).push({});
</script>
                </div>


                </div>
                <div class="row">
                    <div class="col-xs-12 col-sm-10 col-md-8  ">
                        <?php
                        
                        if (!count($image['hits']) == 0) {
                            
                  echo '<h4 class="text-muted lead">Visuals for '.$word_of_the_day->word.'</h4>';


                            foreach ($image['hits'] as $photo) {
                                $Preview = $photo['previewURL'];

                                $page_url = $photo['pageURL'];

                                echo '<a target="_blank" href="' . $page_url . '"><img  src="' . $Preview . '"   '
                                . 'height="80" width="80" ></a>';
                            }
                        }
                        ?>
                        <span class="clickable">
                        </span>
                    </div>
                    <div class="col-xs-12 col-sm-10 col-md-8 ">
                        <h4 class="text-muted lead
                            ">Examples For <?php echo $word_of_the_day->word ?></h4>
                        <span class="clickable">

                                <?php
                                $examples = $word_of_the_day->examples;
                               /// var_dump($examples);
                                for ($i = 0; $i < count($examples); $i++) {

                                    
                                    
                                        echo '<blockquote cite="'.$examples[$i]->url.'">';
                                        echo '<p>'.$examples[$i]->text .'</p>';
                                        echo '<footer> <cite title="'.$examples[$i]->title.'">'.Html::a($examples[$i]->title ,$examples[$i]->url,array('target'=>'blank')).'</cite> </footer>';
                                        echo '</blockquote>';

                                }
                                ?>
                            
                        </span>
                    </div>
                    <div class="col-xs-12 col-sm-10 col-md-8 ">
                        <h4 class="text-muted lead
                            ">Notes For <?php echo $word_of_the_day->word ?></h4>
                        <span class="clickable">
                                <?php
                                   
                                        echo '<blockquote cite="www.wordnik.com">';
                                        echo '<p>'.$word_of_the_day->note.'</p>';
                            
                                        echo '</blockquote>';
                                        
                                ?>
                        </span>
                    </div>
                    <div class="col-xs-12 col-sm-10 col-md-8 ">
                     <?php                            if ($related_words !=NULL)
                            {
                               echo '<h4>Related Words For '.$word_of_the_day->word.'</h4>';

                            } ?>
                        <p> 
                        <dl class=" dl-horizontal">
                            <?php
                            for ($i = 0; $i < count($related_words); $i ++) {
                                echo '<dt>' . $related_words[$i]->relationshipType . '</dt>';

                                for ($j = 0; $j < count($related_words[$i]->words); $j ++) {



                                    echo '<dd>' . Html::a(str_replace("'", "", $related_words[$i]->words[$j]), ['/translator/'.strtolower($lang).'/translation', 'word' => str_replace("'", "", $related_words[$i]->words[$j])]) . '</dd>';
                                }
                            }
                            ?>
                        </dl>
                        </p>
                    </div>
                </div>
            </div>
        </div>
        
            <a  href="http://www.wordnik.com/words/<?php echo $word_of_the_day->word ?>"> <img src="/d3000c/web/wordnik_badge_a2.png"  alt="Power by Wordnik" > </a>

    </div>
    <audio id="audio">
        <source src="<?php if (is_array($audio)) echo $audio[0]->fileUrl; ?>" type="audio/mpeg">
        Your browser does not support the audio element.
    </audio>
       <audio id="audio">
        <source src="<?php if (is_array($audio)) echo $audio[0]->fileUrl; ?>" type="audio/mpeg">
        Your browser does not support the audio element.
    </audio>
    <script>
        $(document).ready(function() {
            var p = $('.clickable p');
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


