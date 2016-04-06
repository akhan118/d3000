<?php

namespace app\controllers;

use Yii;
use yii\filters\AccessControl;
use yii\web\Controller;
use yii\filters\VerbFilter;
use app\models\LoginForm;
use app\models\ContactForm;

class SiteController extends Controller {

    public function behaviors() {
        return [


            [
            'class' => 'yii\filters\PageCache',
            'only' => ['index'],
            'duration' => 12000,
        ],    


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

    public function actionIndex() {


            $model = new \app\models\Dictionary();

            $word_of_the_day = $model->get_word_of_the_day();

            $word_text = $word_of_the_day->word;
            $model->setInput($word_text);

            $text_pronun = $model->ink_get_getTextPronunciations();
            $audio = $model->ink_get_audio();
           // $image = $model->pixaAbayImage($word_text);
            
                              $image= $model->Fliker_search($model->input);
                    
                   // var_dump($flikr_image);
                 //   die();
                    
            $related_words = $model->ink_get_synonym();


            $model->meta_data_index();

        return $this->render('index', ['model' => $model,
                    'word_of_the_day' => $word_of_the_day,
                    'text_pronun' => $text_pronun,
                    'audio' => $audio,
                    'image' => $image,
                    'related_words' => $related_words,
        ]);
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
        if ($model->load(Yii::$app->request->post()) && $model->contact(Yii::$app->params['adminEmail'])) {
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
