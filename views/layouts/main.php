<?php
/* @var $this \yii\web\View */
/* @var $content string */

use yii\helpers\Url;
use yii\helpers\Html;
use yii\bootstrap\Nav;
use yii\bootstrap\NavBar;
use yii\widgets\Breadcrumbs;
use app\assets\AppAsset;
use yii\widgets\ActiveForm;

AppAsset::register($this);
?>
<?php $this->beginPage() ?>
<!DOCTYPE html>
<html lang="<?= Yii::$app->language ?>">
    <head>
        <meta charset="<?= Yii::$app->charset ?>">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <?= Html::csrfMetaTags() ?>
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
            <nav id="myNavbar" class="navbar navbar-default navbar-inverse navbar-fixed-top custom_nav" role="navigation">
                <div class="container">
                    <div class="navbar-header">
                        <button type="button" class="navbar-toggle search_button_mobile" data-toggle="collapse" data-target="#navbarCollapse">
                            <span class="sr-only">Toggle navigation</span>
                            <span class="icon-bar"></span>
                            <span class="icon-bar"></span>
                            <span class="icon-bar"></span>
                        </button>
                        <a class="navbar-brand" href="<?= Yii::$app->homeUrl ?>"><p class="glyphicon glyphicon-knight glyphicon_horse"> <span class="custom_brand_collaps">Dictionary3000</span></p></a>
                        <form class="navbar-form custom_nav_form " role="search" method="get" action="<?php echo Url::to(['dictionary/index']) ?>">
                            <div class="input-group">
                                <input type="text" name="Dictionary[input]" class="form-control" id="dictionary-input">            <div class="input-group-btn">
                                    <button class="btn btn-default trans_submit_button" type="submit"><span class="glyphicon glyphicon-search"></span></button>
                                </div>
                            </div>
                        </form>
                    </div>

                    <div class="collapse navbar-collapse" id="navbarCollapse">
                        <ul class="nav navbar-nav custom_links_nav">

<li><a href="/d3000c/web/site/login">Login</a></li>
                        </ul>
                    </div>
                </div>
            </nav>

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
                <p class="pull-left">&copy; Dictionary3000.com  <?= date('Y') ?></p>

            
              <div class="col-xs-4 col-sm-8 col-md-8  ">
                  <a class="text-muted" href="<?php echo Url::to(['/site/contact']) ?>">contact us</a>

              </div>
            
            </div>
        </footer>

<?php $this->endBody() ?>
    </body>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.3/jquery.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.5/js/bootstrap.min.js"></script>
</html>
<?php $this->endPage() ?>

