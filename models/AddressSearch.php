<?php

namespace app\models;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use app\models\Address;

/**
 * AddressSearch represents the model behind the search form about `app\models\Address`.
 */
class AddressSearch extends Address
{
    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['id'], 'integer'],
            [['country', 'city', 'street', 'zipcode', 'created_at', 'updated_at', 'house'], 'safe'],
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
        $query = Address::find();

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
            //'house' => $this->house,
        
    //'created_at' => $this->created_at,
    //'updated_at' => $this->updated_at,


        ]);

        $query->andFilterWhere(['like', 'country', $this->country])
            ->andFilterWhere(['like', 'city', $this->city])
            ->andFilterWhere(['like', 'street', $this->street])
            ->andFilterWhere(['like', 'zipcode', $this->zipcode]);

	if(!empty($this->created_at)) {

	    $dates = explode(" - ", $this->created_at, 2) ;

	    $from = strtotime($dates[0]) ;

            $to = strtotime($dates[1]) ;

            if($from > 0) {

                $query->andFilterWhere([">=", "created_at", $from]) ;

	    } 

            if($to > 0) {

                $query->andFilterWhere(["<=", "created_at", $to]) ;

            }         

        }

	if(!empty($this->house)) {

	    $houses = explode("-", $this->house, 2) ;

	    $from = trim($houses[0]) ;

            $to = isset($houses[1]) ? trim($houses[1]) : 0 ;

            if($from > 0) {

                $query->andFilterWhere([">=", "house", $from]) ;

	    } 

            if($to > 0) {

                $query->andFilterWhere(["<=", "house", $to]) ;

            }         

        }

        return $dataProvider;
    }
}
