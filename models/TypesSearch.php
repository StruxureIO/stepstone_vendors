<?php

namespace humhub\modules\stepstone_vendors\models;

use yii\base\Model;
use yii\data\ActiveDataProvider;
use humhub\modules\stepstone_vendors\models\VendorTypes;

//include "protected/modules/vendors/models/VendorTypes.php";

class TypesSearch extends VendorTypes
{
    public function rules()
    {
        return [
            [['type_name'], 'safe'],
        ];
    }

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
        $query = VendorTypes::find();

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

        $query->andFilterWhere(['like', 'type_name', $this->type_name]);
                
        return $dataProvider;
    }
}
