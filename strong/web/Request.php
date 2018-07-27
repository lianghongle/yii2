<?php

namespace strong\web;

class Request extends \yii\web\Request
{
    public function getParams($name = null, $defaultValue = null)
    {
        if ($name === null) {
            return array_merge($this->get(), $this->post());
        }

        return $this->post($name, $defaultValue) | $this->get($name, $defaultValue);
    }
}