<?php
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


?>
<?php $this->beginPage() ?>
<!DOCTYPE html>
<html lang="<?= Yii::$app->language ?>">
    <head>
        
        
<meta name="robots" content="index, follow" />
<meta name="keywords" content="arabic english dictionary,arabic english dictionary online,arabic english online dictionary,arabic to english dictionary,free arabic english dictionary" />
<meta name="description" content="A unique Arabic -English , English-Arabic  Dictionary and translator (قاموس عربي انجليزي )
That offer related, images, definitions,translations and wikipedia pages for the translated term."/>

 <meta property="og:type" content="website"/>
 <meta property="og:url" content="http://www.dictionary3000.com/translator/arabic"/>
 <meta property="og:image" content="http://www.Arabicenglishdictionary.org/images/parrot.png"/>
 <meta property="og:site_name" content="Dictionary3000.com Arabic English Dictionary"/>
 <meta property="109518715733173" content="USER_ID"/>
 <meta property="fb:page_id" content="109518715733173" />
        <script>
  (function(i,s,o,g,r,a,m){i['GoogleAnalyticsObject']=r;i[r]=i[r]||function(){
  (i[r].q=i[r].q||[]).push(arguments)},i[r].l=1*new Date();a=s.createElement(o),
  m=s.getElementsByTagName(o)[0];a.async=1;a.src=g;m.parentNode.insertBefore(a,m)
  })(window,document,'script','//www.google-analytics.com/analytics.js','ga');

  ga('create', 'UA-9747512-24', 'auto');
  ga('send', 'pageview');

</script>
        <link href="//maxcdn.bootstrapcdn.com/font-awesome/4.2.0/css/font-awesome.min.css" rel="stylesheet">
        <meta charset="<?= Yii::$app->charset ?>"/>
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <?= Html::csrfMetaTags() ?>
        <title><?= Html::encode('Arabic English - Dictionary-قاموس عربي انجليزي') ?></title>
<?php $this->head() ?>
    </head>
    <body>

            <?php $this->beginBody() ?>
        <div class="wrap">
            <?php
            NavBar::begin([
                'brandLabel' => '<i class="fa fa-flag fa-lg"> Dictionary3000</i>     ',
                'brandUrl' => Yii::$app->homeUrl,
                'options' => [
                    'class' => 'navbar-inverse navbar-fixed-top',
                ],
            ]);






            echo Nav::widget([
                'options' => ['class' => 'navbar-nav navbar-right'],
                'items' => [
                    ['label' => 'Translator', 'url' => ['/translator']],
//                    ['label' => 'About', 'url' => ['/site/about']],
                    ['label' => 'Contact', 'url' => ['/site/contact']],
//                    Yii::$app->user->isGuest ?
//                            ['label' => 'Login', 'url' => ['/site/login']] :
//                            ['label' => 'Logout (' . Yii::$app->user->identity->username . ')',
//                        'url' => ['/site/logout'],
//                        'linkOptions' => ['data-method' => 'post']],
                ],
            ]);
            
            
            
            NavBar::end();
            ?>

   

            <div class="container">
                <?=
                Breadcrumbs::widget([
                    'links' => isset($this->params['breadcrumbs']) ? $this->params['breadcrumbs'] : [],
                ])
                ?>
            

         
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

