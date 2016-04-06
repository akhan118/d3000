<?php
use yii\web\Controller;
use yii\helpers\Url;
use yii\jui\AutoComplete;
use yii\helpers\Html;

/* @var $this yii\web\View */
$this->title = 'About';
//$this->params['breadcrumbs'][] = $this->title;
?>
<div class="site-about">
    <h4>We couldn't find a match for <?php echo "<span class='alert-danger' >". $word."</span>"?>  </h4>


    <ul id="suggestions" class="list-unstyled">


<?php 

if (count($suggestions)!=0)
{
    echo "<h2>More Suggestions:</h2>";

}

for($i=0; $i < count($suggestions); $i ++)
{
   
 echo  "<li>".Html::a(str_replace("'", "", $suggestions[$i]), ['/dictionary/index/','word' =>str_replace("'", "", $suggestions[$i])])."</li>";
  
}

?>
  
  </ul>

</div>
