<?php
namespace common\models\admin;

/**
 * Signup form
 */
class UserSignupForm extends \yii\base\Model
{
    public $username;
//    public $mobile;
    public $email;
    public $password;
    protected $register_from;

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            ['username', 'trim'],
            ['username', 'required'],
            ['username', 'unique', 'targetClass' => '\common\models\User', 'message' => 'This username has already been taken.'],
            ['username', 'string', 'min' => 2, 'max' => 255],

//            ['email', 'trim'],
//            ['email', 'required'],
//            ['email', 'email'],
//            ['email', 'string', 'max' => 255],
//            ['email', 'unique', 'targetClass' => '\common\models\User', 'message' => 'This email address has already been taken.'],

            ['password', 'required'],
            ['password', 'string', 'min' => 6],
        ];
    }



    public function signup()
    {
        throw new \Exception('method not implement');
    }

    /**
     * Signs user up.
     *
     * @return User|null the saved model or null if saving fails
     */
    private function _signup()
    {
        if (!$this->validate()) {
            return null;
        }
        
        $user = new User();
        $user->username = $this->username;
        $user->email = $this->email;
        $user->mobile = $this->mobile;
        $user->setPassword($this->password);
        $user->generateAuthKey();
        
        return $user->save() ? $user : null;
    }

    /**
     * 后台添加
     *
     * @return User|null
     */
    public function signupFromAdmin()
    {
        $this->register_from = User::REGISTER_FROM_ADMIN;
        return $this->_signup();
    }

    /**
     * 用户网页注册
     *
     * @return User|null
     */
    public function signupFromWeb()
    {
        $this->register_from = User::REGISTER_FROM_WEB;
        return $this->_signup();
    }

    /**
     * 用户app注册
     *
     * @return User|null
     */
    public function signupFromApp()
    {
        $this->register_from = User::REGISTER_FROM_APP;
        return $this->_signup();
    }
}
