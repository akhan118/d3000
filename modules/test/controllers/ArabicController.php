<?php

namespace app\modules\test\controllers;

use yii\web\Controller;
use Yii;

class ArabicController extends Controller {
    
    public $layout='transmain';

    public function actionIndex() {
        return $this->render('index');
    }

    public static function getAudio() {
        $model = new \app\models\Dictionary();

        if ($model->load(Yii::$app->request->get())) {
            if ($model->validate()) {

                $input = $model->input;
                if ($input == '') {
                    $model->input = 'whitespace';
                }

                $definition = $model->ink_get_def();
                if (is_array($definition)) {
                    
                    $example = $model->ink_get_example();
                    $audio = $model->ink_get_audio();
                    //  $flikr_image= $model->Fliker_search($model->input);
                    $pix_image = $model->pixaAbayImage($model->input);
                    $wikipedia = $model->wikipediaCurl($model->input);
                } else {

                    return $this->render('index');
                }
            }
            return $audio[0]->fileUrl;
        }
    }

    public function actionAudio() {
        $sound = Yii::$app->session->get('audio');
        echo ' <source src="' . $sound . '"  type="audio/mpeg" >';
    }
    
    /**
     *  Function word translation.
     * 
     * @return type view
     */

    public function actionTranslation() {


        //@Var Holder  
        $definition = '';
        //@Var Holder
        $example = '';


        /**
         *  Get the Model
         */
        $model = new \app\models\Dictionary();

        /**
         * @Word - can come from the Form, or from the list of suggested words 
         * @$SuggestionsTerm- are words avaiable as a link in the view 
         *Check to see if the request is from the Form or if the Vaiable $SuggestionsTerm=$_get[word] from the suggestion link
         * are valid.
         */
        if ($model->load(Yii::$app->request->get()) || $SuggestionsTerm=$_GET["word"]) {
            if ($model->validate()) {


                if (isset($_GET["word"])) {
                    $model->setInput($_GET["word"]);
                }
                /**
                 * if form input is empty, set model->input = whitespace.
                 * so the results from will be data for the term whitepsace.
                 */
                if ($model->input== '') {
                    $model->input = 'whitespace';
                }

                
               /**
                *  check if the word is arabic
                */
                    
                if ($model->is_arabic())
                {   
                    $input=$model->input;
                 $transword= $model->translations($model->input,'ar','en');
                 if(!is_string($transword))
                     $transword='';
                 $model->setInput($transword);
                 $transword=$input;
          
                }else {
                
                       $transword= $model->translations($model->input,'en','ar');
                 if(!is_string($transword))
                     $transword='';
                 
                }



                /**
                 *  Get the definition from the model. 
                 */
                $definition = $model->ink_get_def();


                /**
                 *  if the definition is an array (valid)- then get the ,example
                 * audio,images and wikipedia data from the model.
                 */
                if (is_array($definition)) {

                    $example = $model->ink_get_example();
                    $audio = $model->ink_get_audio();
                    $pix_image = $model->pixaAbayImage($model->input);
                    $wikipedia = $model->wikipediaCurl($model->input);
                }

                /**
                 * if there is no definition for the word, then check if it has a wikipeida page.
                 * if it does has a wiki page, then get the images and also possible suggestions
                 * and return the view.
                 *  @return Null values- are values that will not show in the view.
                 */ elseif ($wikipedia = $model->wikipediaCurl($model->input)) {

                    $pix_image = $model->pixaAbayImage($model->input);

                    $suggestions = $model->spelling_suggestions();

                    return $this->render('translation', ['model' => $model,
                                'definition' => Null,
                                'example' => $example,
                                'audio' => NULL,
                                'image' => $pix_image,
                                'wiki' => $wikipedia,
                                'word' => $model->input,
                                'suggestions' => $suggestions]
                    );
                } else {

                    /**
                     * if the dictionary has no def, check for word suggestions and spelling
                     */
                    $suggestions = $model->spelling_suggestions();

                    return $this->render('suggestions', ['suggestions' => $suggestions,
                                'word' => $model->input]);
                }
            }

            /**
             *  make suggestions as an empty array when definition is found
             */
            $suggestions = array();

            /**
             *  This is whatis  return to the view when every API is responding .  
             */
            
            return $this->render('translation', ['model' => $model,
                        'definition' => $definition,
                        'example' => $example,
                        'audio' => $audio,
                        'image' => $pix_image,
                        'translation'=>$transword,
                        'wiki' => $wikipedia,
                        'suggestions' => $suggestions]);
        } else {


            return $this->render('translation');
        }
    }

}
