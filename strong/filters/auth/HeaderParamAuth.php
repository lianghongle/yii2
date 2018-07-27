<?php

namespace strong\filters\auth;

use backend\consts\ErrorCode;
use yii\filters\auth\AuthMethod;
use yii\web\UnauthorizedHttpException;

/**
 *
 *
 * Class HeaderParamAuth
 * @package yii\filters\auth
 */
class HeaderParamAuth extends AuthMethod
{
    /**
     * @var string the parameter name for passing the access token
     */
    public $tokenParam = 'access-token';

    /**
     * {@inheritdoc}
     */
    public function authenticate($user, $request, $response)
    {
        $accessToken = $request->getHeaders()->get($this->tokenParam);
        if (is_string($accessToken)) {
            $identity = $user->loginByAccessToken($accessToken, get_class($this));
            if ($identity !== null) {
                return $identity;
            }
        }
        if ($accessToken !== null) {
            $this->handleFailure($response);
        }

        return null;
    }

    public function handleFailure($response)
    {
        throw new UnauthorizedHttpException('登陆信息无效', ErrorCode::INVALID_CREDENTIALS);
    }
}
