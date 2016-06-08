<?php

namespace app\controllers;

use yii\web\Session as Session;
use Yii;
use yii\filters\AccessControl;
use yii\web\Controller;
use yii\filters\VerbFilter;
use app\models\LoginForm;
use app\models\ContactForm;
use linslin\yii2\curl;

class DictionaryController extends Controller {

    public function __construct($id, $module, $config = array()) {
        parent::__construct($id, $module, $config);
    }

    public $enableCsrfValidation = false;
    private $Sound_url = '';

    public function behaviors() {
        return [
            
            
//                        [
//            'class' => 'yii\filters\PageCache',
//            'only' => ['definition'],
//            'duration' => 36000,
//        ],  
//            
            'access' => [
                'class' => AccessControl::className(),
                'only' => ['logout'],
                'rules' => [
                    [
                        'actions' => ['logout'],
                        'allow' => true,
                        'roles' => ['@'],
                    ],
                ],
            ],
            'verbs' => [
                'class' => VerbFilter::className(),
                'actions' => [
                    'logout' => ['post'],
                ],
            ],
        ];
    }

    public function actions() {
        return [
            'error' => [
                'class' => 'yii\web\ErrorAction',
            ],
            'captcha' => [
                'class' => 'yii\captcha\CaptchaAction',
                'fixedVerifyCode' => YII_ENV_TEST ? 'testme' : null,
            ],
        ];
    }

    public function actionTest($suggestion) {
        echo 'good';
        
       // var_dump($_GET);
        
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

    public function actionIndex() {
        
     
        $definition = '';
        $example = '';
        $model = new \app\models\Dictionary();
        

        if ($model->load(Yii::$app->request->get()) || $_GET["word"] ) {
            if ($model->validate()) {
                
                
                if (isset($_GET["word"]))
                {
                    $model->input=$_GET["word"];
                    
                }

                $input = $model->input;
                if ($input == '') {
                    $model->input = 'whitespace';
                }

                

                
                // $test=$model->ink_get_synonym();
                
                        
   
                
                                   $definition = $model->ink_get_def();
                if (is_array($definition)) {
                    //  $twitter=$model->twitter();
                    
                                            $model->meta_data_results();

                    // Get Text Pronouncesation 
                   $text_pronun=$model->ink_get_getTextPronunciations();
                   $related_words = $model->ink_get_synonym();

                    // get def examples
                    $example = $model->ink_get_example();
                    /// gets audio
                    $audio = $model->ink_get_audio();
                    // get images
                    $pix_image= $model->Fliker_search($model->input);

                   // $pix_image = $model->pixaAbayImage($model->input);
                    // get wikipedia
                    $wikipedia = $model->wikipediaCurl($model->input);

        }
             
                
       elseif ( $wikipedia = $model->wikipediaCurl($model->input)) {
               
                                  // $pix_image = $model->pixaAbayImage($model->input);
                                    $pix_image= $model->Fliker_search($model->input);
      
                        $suggestions=$model->spelling_suggestions();
                                
       return $this->render('definition', ['model' => $model,
                        'definition' => Null,
                        'example' => $example, 
                        'audio' => NULL,
                        'image' => $pix_image, 
                         'wiki' => $wikipedia,
                         'word'=>$model->input,
                        'suggestions'=>$suggestions]
                         );

            }
                
                
                else {
                    
        /// if the dictionary has no def, check for word suggestions and spelling
                    
           $suggestions=$model->spelling_suggestions();

                    return $this->render('suggestions',['suggestions'=>$suggestions,
                                                         'word'=>$model->input]);
                }
            }


            /// making suggestions as an empty array when definition if ound
             
            $suggestions=array();
            return $this->render('definition', ['model' => $model,
                        'definition' => $definition,
                        'textproun'=>$text_pronun,
                        'example' => $example, 
                        'audio' => $audio,
                        'image' => $pix_image, 
                         'wiki' => $wikipedia,
                       'suggestions'=>$suggestions,
                         'related_words' => $related_words,
]);
        } else {


            return $this->render('index');
        }
    }

    public function actionAudio() {
        $sound = Yii::$app->session->get('audio');
        echo ' <source src="' . $sound . '"  type="audio/mpeg" >';
    }

    public function actionLogin() {
        if (!\Yii::$app->user->isGuest) {
            return $this->goHome();
        }

        $model = new LoginForm();
        if ($model->load(Yii::$app->request->post()) && $model->login()) {
            return $this->goBack();
        } else {
            return $this->render('login', [
                        'model' => $model,
            ]);
        }
    }

    public function actionLogout() {
        Yii::$app->user->logout();

        return $this->goHome();
    }

    public function actionContact() {
        $model = new ContactForm();
        if ($model->load(Yii::$app->request->post()) && $model->contact('akhan118@hotmail.com')) {
            Yii::$app->session->setFlash('contactFormSubmitted');

            return $this->refresh();
        } else {
            return $this->render('contact', [
                        'model' => $model,
            ]);
        }
    }

    public function actionAbout() {
        return $this->render('about');
    }

}
