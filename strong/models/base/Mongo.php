<?php

namespace strong\models\base;

class Mongo extends Model
{
    public static function getDb()
    {
        return \Yii::$app->mongodb;
    }
}