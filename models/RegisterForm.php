<?php 
namespace app\models;

use Yii;
use yii\base\Model;


class RegisterForm extends Model {


	public $email;


	public function rules() {

		return [
			    ['email', 'required'],
		       ];

	}


}