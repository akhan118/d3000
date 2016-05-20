<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $name string */
/* @var $message string */
/* @var $exception Exception */

$this->title = $name;
?>
<div class="site-error">

    <h1><?= Html::encode($this->title) ?></h1>

    <div class="alert alert-danger">
        <?= nl2br(Html::encode($message)) ?>
    </div>

    <p>
        The above error occurred while the Web server was processing your request.
    </p>
    <p>
        Please contact us if you think this is a server error. Thank you.
    </p>

      <div class="alert alert-info">
          <p>
              Oh Snap Homeslice ! </p>
    </div>
    <p>If you landed here looking for Arabic English Dictionary please check us out at</p>
    <a href="http://www.arabicenglishdictionary.org" target="_blank">Arabic English Dictionary</a>
</div>


