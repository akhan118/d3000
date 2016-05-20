<?php

use yii\helpers\Url;
use yii\helpers\Html;
use yii\bootstrap\Nav;
use yii\bootstrap\NavBar;
use yii\widgets\Breadcrumbs;
use app\assets\AppAsset;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model app\models\Dictionary */
/* @var $form ActiveForm */

/* @var $this \yii\web\View */
/* @var $content string */
AppAsset::register($this);

//$this->registerCssFile(Yii::$app->request->baseUrl.'/css/wiki.css'); 
?>
<?php $this->beginPage() ?>
<!DOCTYPE html>
<html lang="<?= Yii::$app->language ?>">
    <head>
        <?= Html::csrfMetaTags() ?>

            <meta property="og:type" content="website"/>
            <meta property="og:url" content="http://www.dictionary3000.com/translator/arabic"/>
            <meta property="og:image" content="http://www.Arabicenglishdictionary.org/images/parrot.png"/>
            <meta property="og:site_name" content="Dictionary3000.com Arabic English Dictionary"/>
            <meta property="109518715733173" content="USER_ID"/>
            <meta property="fb:page_id" content="109518715733173" />

        <link href="//maxcdn.bootstrapcdn.com/font-awesome/4.2.0/css/font-awesome.min.css" rel="stylesheet">
        <meta charset="<?= Yii::$app->charset ?>"/>
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <title><?= Html::encode($this->title) ?></title>
        
 <?php $this->head() ?>
 <script src="//code.jquery.com/jquery-1.11.2.min.js"></script>
<script src="//code.jquery.com/jquery-migrate-1.2.1.min.js"></script>       
<script>
  (function(i,s,o,g,r,a,m){i['GoogleAnalyticsObject']=r;i[r]=i[r]||function(){
  (i[r].q=i[r].q||[]).push(arguments)},i[r].l=1*new Date();a=s.createElement(o),
  m=s.getElementsByTagName(o)[0];a.async=1;a.src=g;m.parentNode.insertBefore(a,m)
  })(window,document,'script','//www.google-analytics.com/analytics.js','ga');

  ga('create', 'UA-9747512-24', 'auto');
  ga('send', 'pageview');

</script>

    </head>
    <body>

        <?php $this->beginBody() ?>
        <div class="wrap">
            
                       <?php
//            NavBar::begin([
//                'brandLabel' => '<i class="fa fa-flag fa-lg"> Dictionary3000</i>     ',
//                'brandUrl' => Yii::$app->homeUrl,
//                'options' => [
//                    'class' => 'navbar-inverse navbar-fixed-top',
//                ],
//            ]);
//
//
//
//
//
//
//            echo Nav::widget([
//                'options' => ['class' => 'navbar-nav navbar-right'],
//                'items' => [
//                    ['label' => 'Translator', 'url' => ['/translator']],
////                    ['label' => 'About', 'url' => ['/site/about']],
//                    ['label' => 'Contact', 'url' => ['/site/contact']],
////                    Yii::$app->user->isGuest ?
////                            ['label' => 'Login', 'url' => ['/site/login']] :
////                            ['label' => 'Logout (' . Yii::$app->user->identity->username . ')',
////                        'url' => ['/site/logout'],
////                        'linkOptions' => ['data-method' => 'post']],
//                ],
//            ]);
//            
//            
//            
//            NavBar::end();
//            ?>
            

            <nav id="myNavbar" class="navbar navbar-default navbar-inverse navbar-fixed-top custom_nav" role="navigation">
                <div class="container">
                    <div class="navbar-header">

                        <a class="navbar-brand" href="<?= Yii::$app->homeUrl ?>"><p class="glyphicon glyphicon-knight glyphicon_horse"> <span class="custom_brand_collaps">Dictionary3000</span></p></a>
                        <form class="navbar-form custom_nav_form " role="search" method="get" action="<?php echo Url::to(['/translator/arabic/translation']) ?>">
                            <div class="input-group">
                                <input type="text" name="Dictionary[input]" class="keyboardInputCenter form-control " id="dictionary_input_trans">            <div class="input-group-btn">
                                    <button class="btn btn-default" id="trans_submit_button" type="submit"><span class="glyphicon glyphicon-search"></span></button>
                                </div>
                            </div>
                        </form>
                        
      
                        
                        
                        
                    </div>


                </div>
            </nav><!--
-->






            <div class="container">




                <?= $content ?>
            </div>
        </div>

        <footer class="footer">
            <div class="container">
                <p class="pull-left">&copy; Dictionary3000 <?= date('Y') ?></p>
                <p class="pull-right"></p>
            </div>
        </footer>

        <?php $this->endBody() ?>
    </body>
</html>
<?php $this->endPage() ?>

