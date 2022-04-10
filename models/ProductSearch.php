<?php

namespace app\models;

use yii\base\Model;
use yii\data\ActiveDataProvider;
use app\models\Product;

/**
 * ProductSearch represents the model behind the search form of `app\models\Product`.
 */
class ProductSearch extends Product
{
    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['id', 'sub_category_id', 'voluem_type', 'is_new'], 'integer'],
            [['title', 'description', 'created_at', 'updated_at'], 'safe'],
            [['price', 'price_old', 'price_from', 'price_to', 'voluem', 'voluem_from', 'voluem_to'], 'number'],
        ];
    }

    /**
     * {@inheritdoc}
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
        $query = Product::find()->with(['subCategory', 'ingredients']);

        // add conditions that should always apply here

        $dataProvider = new ActiveDataProvider([
            'query' => $query,
        ]);

        $this->load($params);

        if (!$this->validate()) {
            // uncomment the following line if you do not want to return any records when validation fails
            // $query->where('0=1');
            return $dataProvider;
        }

        // grid filtering conditions
        $query->andFilterWhere([
            'id' => $this->id,
            'sub_category_id' => $this->sub_category_id,
            'price' => $this->price,
            'price_old' => $this->price_old,
            'price_from' => $this->price_from,
            'price_to' => $this->price_to,
            'voluem' => $this->voluem,
            'voluem_from' => $this->voluem_from,
            'voluem_to' => $this->voluem_to,
            'voluem_type' => $this->voluem_type,
            'is_new' => $this->is_new,
            'created_at' => $this->created_at,
            'updated_at' => $this->updated_at,
        ]);

        $query->andFilterWhere(['like', 'title', $this->title])
            ->andFilterWhere(['like', 'description', $this->description]);

        return $dataProvider;
    }
}
