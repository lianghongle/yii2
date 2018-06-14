<?php
namespace test\controllers;

use common\models\blog\Post;
use Yii;
use yii\web\Controller;

/**
 * db(mysql) test
 *
 * Site controller
 */
class DbMysqlController extends Controller
{
//    public $layout = false;

    public function actionIndex()
    {
//        不使用布局
//        $this->layout = false;

        return $this->render('index');
    }

    /**
     * 直接执行 sql
     */
    public function actionSql()
    {
        $this->layout = false;

        $sql = 'select * from yii2_posts';
//        Yii::$app->db->createCommand($sql)->queryOne();
        $result = Yii::$app->db->createCommand($sql)->queryAll();
        var_dump($result);// 返回数组
    }

    /**
     *
     *
     * where:
     * ['and', 'id=1', 'id=2']
     * ['or', 'id=1', 'id=2']
     * ['in', 'id', [1,2,3]]
     * ['between', 'id', 1, 10]
     * ['like', 'name', ['test', 'sample']]  //like '%test%' and like '%sample%'
     * ['>=', 'id', 10]
     *
     */
    public function actionActiveRecord()
    {
        //根据主键查询一条
        $one = Post::find()->where(['id' => 1])->one();
//        Post::findOne(['id' => 1]);
        var_dump($one);

        //根据条件查询所有
        $all = Post::find()->where(['status'=>1])->all();
        Post::findAll(['status'=>1]);
        var_dump($all);
        $result = Post::find()->where('and',
            ['status' => 1],
            ['created_by' => 1],
            ['like', 'title', 'yii']
        )->orderBy('id desc')->all();
        var_dump($result);

        $sql= 'select * from yii2_posts';
        $sqlResult = Post::findBySql($sql)->all();
        var_dump($sqlResult);//返回对象
    }

    public function actionCurd()
    {
        //create
        $post = new Post();
        $post->title = 'test insert';
        $post->content = 'test';
        $post->save();

        //read 参考 actionActiveRecord

        //update
        $post = Post::findOne(['id' => 1]);
        $post->title = 'test update';
        $post->save();

        //delete
        $post = Post::findOne(['id' => 1]);
        $post->delete();
    }

    public function actionQueryBuilder()
    {
        $query= new \yii\db\Query();

        $rows = (new \yii\db\Query())
            ->select(['id'])
            ->from('yii2_post')
            ->where(['title' => '测试 post'])
            ->orderBy('id')
            ->offset(1)
            ->limit(10)
            ->indexBy('id')
            ->all();
//        ->one();
//        ->column();

        var_dump($rows);


        //from
//        $query->from(['yii2.users u', 'yii2.post p']);
//        $query->from('yii2.users u, yii2.post p');

        //select子查询
//        $subQuery = (new \yii\db\Query())->select('count(*)')->from('user');
//        $query = (new \yii\db\Query())->select(['id', 'count'=> $subQuery])->from('post');

        //from 子查询
//        $subQuery = (new \yii\db\Query())->select('count(*)')->from('user');
//        $query = (new \yii\db\Query())->select(['id', 'count'=> $subQuery])->from(['u' => $subQuery]);

        //where
//        $query->where('id=1');
//        $query->where(['id'=>1]);
//        $query->where(['like', 'title', 'test']);

        //orderBy
//        $query->orderBy([
//            'id' => SORT_ASC,
//            'title' => SORT_DESC
//        ]);
//        $query->orderBy('id asc, title desc');

//        $query->groupBy(['id','title']);

//        $query->having(['id'=>1]);

//        $query->join('LEFT JOIN', 'post', 'post.id = user.id');

//        $query1 = $query->from('user1');
//        $query2 = $query->from('user2');
//        $queryUnion = $query1->union($query2);

    }
}
