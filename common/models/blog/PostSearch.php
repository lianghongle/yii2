<?php

namespace common\models\blog;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use common\models\blog\Post;

/**
 * PostsSearch represents the model behind the search form of `common\models\blog\Posts`.
 */
class PostSearch extends Post
{
    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['id', 'created_at', 'updated_at', 'status', 'created_by'], 'integer'],
            [['title', 'content'], 'safe'],
        ];
    }

    /**
     * @inheritdoc
     */
    public function scenarios()
    {
        // bypass scenarios() implementation in the parent class
        return Model::scenarios();
    }

    /**
     * Creates data provider instance with search query applied
     *
     * @param array $params
     *
     * @return ActiveDataProvider
     */
    public function search($params)
    {
        $query = Post::find();

        // add conditions that should always apply here

        //ActiveDataProvider / SqlDataProvider / ArrayDataProvider
        $dataProvider = new ActiveDataProvider([
            'query' => $query,
            'pagination' => [
                'pageSize' => 5
            ],
//            'sort' => [
//                'defaultOrder' => [
//                    'id' => SORT_DESC
//                ],
//                'attribute' => [
//                    'id', 'title'
//                ]
//            ]
        ]);

//        $dataProvider->getPagination();
//        $dataProvider->getCount();
//        $dataProvider->getTotalCount();
//        $dataProvider->getSort();
//        $dataProvider->getModels();

        $this->load($params);

        if (!$this->validate()) {
            // uncomment the following line if you do not want to return any records when validation fails
            // $query->where('0=1');
            return $dataProvider;
        }

        // grid filtering conditions
        $query->andFilterWhere([
            'id' => $this->id,
            'created_at' => $this->created_at,
            'updated_at' => $this->updated_at,
            'status' => $this->status,
            'created_by' => $this->created_by,
        ]);

        $query->andFilterWhere(['like', 'title', $this->title])
            ->andFilterWhere(['like', 'content', $this->content]);

        $dataProvider->sort->attributes['created_at'] = [
            'asc' => [
                'created_at' => SORT_ASC
            ],
            'desc' => [
                'created_at' => SORT_ASC
            ],
        ];

        return $dataProvider;
    }
}
