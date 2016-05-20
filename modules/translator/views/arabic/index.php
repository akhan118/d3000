<?php
use yii\widgets\ActiveForm;
use yii\helpers\Html;
use app\assets\localAssets;
use yii\helpers\Url;

/* @var $this yii\web\View */
localAssets::register($this);



$this->title = 'Arabic English Dictionary |قاموس عربي انجليز  ';


?>



    <div class="site-index">
        <div class="body-content ">
            <div class="container-fluid">
                <div class="row">

                       <div class="row">  
        

                    <div class="col-xs-12 col-sm-8 col-md-8">
                 
                        <div class="col-xs-12 col-sm-11 col-md-6 clickable">
                            <h1 class="h2_border">
                                <?php
                                $definitions = $word_of_the_day->definitions;
                                echo Html::a(str_replace("'", "", $word_of_the_day->word), ['/translator/arabic/translation', 'word' => str_replace("'", "", $word_of_the_day->word)]);
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
                                <ul>
                              <?php     
                                    for ($i = 0; $i < count($definitions); $i++) {
                                        echo '<li>';
                                       
                                        echo '<p>'.$definitions[$i]->text.'</p>';
                                       // echo '<footer> <cite title="'.$definitions[$i]->source.'">'.$definitions[$i]->source.'</cite> </footer>';
                                        echo '</li>';
                                        
                                    }
                                    ?>
                                </ul>
                            </div> 
                        </div>
                    </div>


                <div class="col-xs-12 col-sm-4 col-md-4">

                </div>


                </div>
                <div class="row">
                    <div class="col-xs-12 col-sm-10 col-md-8  ">
                       <?php
                        
                                           echo '<h4>Visuals for ' . $word_of_the_day->word . '</h4>';

                        echo '<ul>';      
                        
                        foreach($image['photos']['photo'] as $image) { 
	// the image URL becomes somthing like 
	// http://farm{farm-id}.static.flickr.com/{server-id}/{id}_{secret}.jpg  
$page_url= 'http://farm' . $image["farm"] . '.static.flickr.com/' . $image["server"] . '/' . $image["id"] . '_' . $image["secret"] . '_b.jpg '; 
$Preview= 'http://farm' . $image["farm"] . '.static.flickr.com/' . $image["server"] . '/' . $image["id"] . '_' . $image["secret"] . '_q.jpg '; 

                                      echo '<a target="_blank" href="' . $page_url . '"><img  src="' . $Preview . '"   '
                               . 'height="80" width="80" ></a>';
        
        
        
                        } 
                        
                                                                       echo '</ul>';
     

                        ?>
                        <span class="clickable">
                        </span>
                    </div>
                    <div class="col-xs-12 col-sm-10 col-md-8 ">
                        <h4 class="">Examples For <?php echo $word_of_the_day->word ?></h4>
                        <span class="clickable">
                            <ul>
                                <?php
                                $examples = $word_of_the_day->examples;
                               /// var_dump($examples);
                                for ($i = 0; $i < count($examples); $i++) {

                                                                            echo '<li>';

                                    
                                       // echo '<blockquote cite="'.$examples[$i]->url.'">';
                                        echo '<p>'.$examples[$i]->text .'</p>';
                                     //   echo '<footer> <cite title="'.$examples[$i]->title.'">'.Html::a($examples[$i]->title ,$examples[$i]->url,array('target'=>'blank')).'</cite> </footer>';
                                    //    echo '</blockquote>';

                                      echo '<small>  <p class="text-muted">'.Html::a($examples[$i]->title ,$examples[$i]->url,array('target'=>'blank')).'</p> </small>';
                                        echo '</li>';

                                        }
                                ?>
                            </ul>
                        </span>
                    </div>
                    <div class="col-xs-12 col-sm-10 col-md-8 ">
                        <h4 class="">Notes For <?php echo $word_of_the_day->word ?></h4>
                        <span class="clickable">
                                <?php
                                   
                                        echo '<p>'.$word_of_the_day->note.'</p>';
                            
                                        
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



                                    echo '<dd>' . Html::a(str_replace("'", "", $related_words[$i]->words[$j]), ['/translator/arabic/translation', 'word' => str_replace("'", "", $related_words[$i]->words[$j])]) . '</dd>';
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
                    window.location = ' http://dictionary3000.com/translator/arabic/translation?word=' + word;
                    //window.location = '/d3000c/web/dictionary/index?word=' + word;

                }
                range.collapse();
                e.stopPropagation();
            });
        });
    </script>


