<?php

namespace backend\models\admin;

/**
 * Signup form
 */
class UserSignupForm extends \common\models\admin\UserSignupForm
{
    public $username;
    public $password;
    public $email = '';
    public $mobile;

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            ['username', 'trim'],
            ['username', 'required'],
            [
                'username',
                'unique',
                'targetClass' => '\common\models\user\User',
                'message'     => 'This username has already been taken.'
            ],
            ['username', 'string', 'min' => 2, 'max' => 255],

            ['password', 'required'],
            ['password', 'string', 'min' => 6],

            ['mobile', 'trim'],
            ['mobile', 'required'],
        ];
    }

    /**
     * Signs user up.
     *
     * @return User|null the saved model or null if saving fails
     */
    public function signup()
    {
        return $this->signupFromAdmin();
    }
}
