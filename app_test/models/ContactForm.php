<?php

namespace test\models;

use Yii;
use yii\base\Model;

/**
 * 表单模型 demo
 *
 * ContactForm is the model behind the contact form.
 */
class ContactForm extends Model
{
    //表单属性
    public $name;
    public $email;
    public $subject;
    public $body;
    public $verifyCode;

    /**
     * 数据验证
     *
     * 验证 demo
     * http://www.yiichina.com/tutorial/635
     *
     * @inheritdoc
     */
    public function rules()
    {
        return [
            // name, email, subject and body are required
            [['name', 'email', 'subject', 'body'], 'required'],
            // email has to be a valid email address
            ['email', 'email'],
            // verifyCode needs to be entered correctly
            ['verifyCode', 'captcha'],
        ];
    }

    /**
     * 属性在页面显示的 label（别名）
     *
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'verifyCode' => 'Verification Code',
            'name' => '姓名',
        ];
    }

    /**
     * Sends an email to the specified email address using the information collected by this model.
     *
     * @param string $email the target email address
     * @return bool whether the email was sent
     */
    public function sendEmail($email)
    {
        return Yii::$app->mailer->compose()
            ->setTo($email)
            ->setFrom([$this->email => $this->name])
            ->setSubject($this->subject)
            ->setTextBody($this->body)
            ->send();
    }
}
