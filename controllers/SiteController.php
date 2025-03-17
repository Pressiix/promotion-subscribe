<?php

namespace app\controllers;

use Yii;
use yii\filters\AccessControl;
use yii\web\Controller;
use yii\web\Response;
use yii\filters\VerbFilter;
use app\models\RegisterForm;
use yii\web\Cookie;
use yii\helpers\Url;
use linslin\yii2\curl;

class SiteController extends Controller
{

    /**
     * {@inheritdoc}
     */
    public function actions()
    {
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

    /**
     * Displays homepage.
     *
     * @return string
     */
    public function actionIndex()
    {
        $model = new RegisterForm();
        return $this->render('index',[
            'model'=>$model
        ]);
    }

    /**
     * Email Sending.
     */
    public function actionRegister()
    {
        $request = (object) Yii::$app->request->post('RegisterForm');  //บันทึกค่าทั้งหมดที่ post มาจากฟอร์ม โดยผ่าน model ชื่อ RegisterForm
        $email = $request->email;   //รับค่าemail จากฟอร์ม
        if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {  //ตรวจสอบค่า email
            echo "Invalid email format";
        }else{
            $this->sendMail($email);
            //Process Here!
            /*
            $curl = new curl\Curl();

            //get http://example.com/
            //$response = $curl->get('http://example.com/');

            */

            //render html views and pass variable to this 
            /*return $this->render('thankyou',[
                'email'=>$email
            ]);*/

            //redirect to external link
            //return $this->redirect("https://www.example.com/");
        }
    }

    public function actionSetCookie()
    {
        $cookie = new Cookie([
            'name' => 'cookie_monster',
            'value' => 'Me want cookie!',
            'expire' => time() + 86400 * 365,
        ]);
        \Yii::$app->getResponse()->getCookies()->add($cookie);
    }

    public function actionGetCookie()
    {
        $cookies = Yii::$app->request->cookies;
        echo "<pre/>"; print_r($cookies['cookie_monster']);
    }

    private function sendMail($email)
    {
        Yii::$app->mailer->compose('@app/mail/layouts/html'/*,[
            'fullname'=>'สาธิต สีถาพล'
        ]*/)
        ->setFrom(['bpinventory.test@gmail.com'=>'Inter Edu Test'])
        ->setTo($email)
        ->setSubject('ทดสอบส่ง email')
        ->send();
    }

    public function actionTest()
    {
        $curl = new curl\Curl();

        $a = $curl->setPostParams([
            'key' => 'value',
            'secondKey' => 'secondValue'
        ])/*->post('http://example.com/')*/;

        echo "<pre/>";print_r($a);
        
    }

}
