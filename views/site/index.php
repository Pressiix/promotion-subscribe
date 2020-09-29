<?php

Use yii\helpers\Html;
Use yii\widgets\ActiveForm;

$this->registerMetaTag(['name' => 'exampleMeta','content' => 'This website is about funny raccoons.']);
$this->registerCss('
    .form-inline .form-control {
        width: 60%;
        margin-left: 2%;
    }

    @media (max-width: 768px)
    {
        .form-horizontal .form-group {
            width:60%;
        }
    }
', $options = [], $key = null);

/* @var $this yii\web\View */

$this->title = 'My Yii Application';
?>

        <h1>Subscribe now</h1>

        <?php $form=ActiveForm::begin(['method' => 'post', 'action' => 'site/register', 'id'=> 'login-form',   'options'=> ['class' => 'form-horizontal'],]); ?>
        <input type="hidden" name="_csrf" value="qdcSXsFE7EC7iwE2RNZdGvSgncdLyk00cBuzNxdfKa7GtGEJjRC2dNLKM143gDNytuGu9XyeeF0RTOBBfm1j2Q==">
        <!-- EMAIL -->
        <?= 
            $form->field($model, 'email', [
                'template' => '{label}{input}{error}{hint}',
                'options' => ['class' => 'form-group form-inline'],
            ])->input('email',[     //input type = email
                'pattern' => '[a-z0-9._%+-]+@[a-z0-9.-]+\.[a-z]{2,3}$',  //email pattern ex. example@example.com
                'oninvalid'=>"this.setCustomValidity('Invalid Email address')", //customize error text
                'onchange'=>"try{setCustomValidity('')}catch(e){}",
                'oninput'=>"setCustomValidity(' ')"
                ]) 
        ?>
        <p style="font-size:12px;">By subscribing, you accept the terms and conditions in our <a href="#">privacy policy.</a></p>

        <?= Html::submitButton('Submit', ['class' => 'btn btn-success']);?>

        <?php ActiveForm::end() ?>
     
   
