<?php

/**
 * This is the model class for table "avulso".
 *
 * The followings are the available columns in table 'avulso':
 * @property integer $id
 * @property integer $user_id
 * @property integer $trajeto_id
 * @property integer $ponto_id
 * @property string $data
 * @property double $valor
 *
 * The followings are the available model relations:
 * @property Ponto $ponto
 * @property Trajeto $trajeto
 * @property Users $user
 */
class Avulso extends CActiveRecord
{
	/**
	 * @return string the associated database table name
	 */
	public function tableName()
	{
		return 'avulso';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('user_id, trajeto_id, ponto_id, data, valor', 'required'),
			array('user_id, trajeto_id, ponto_id', 'numerical', 'integerOnly'=>true),
			array('valor', 'numerical'),
			// The following rule is used by search().
			// @todo Please remove those attributes that should not be searched.
			array('id, user_id, trajeto_id, ponto_id, data, valor', 'safe', 'on'=>'search'),
		);
	}

	/**
	 * @return array relational rules.
	 */
	public function relations()
	{
		// NOTE: you may need to adjust the relation name and the related
		// class name for the relations automatically generated below.
		return array(
			'ponto' => array(self::BELONGS_TO, 'Ponto', 'ponto_id'),
			'trajeto' => array(self::BELONGS_TO, 'Trajeto', 'trajeto_id'),
			'user' => array(self::BELONGS_TO, 'Users', 'user_id'),
		);
	}

	/**
	 * @return array customized attribute labels (name=>label)
	 */
	public function attributeLabels()
	{
		return array(
			'id' => 'ID',
			'user_id' => 'User',
			'trajeto_id' => 'Trajeto',
			'ponto_id' => 'Ponto',
			'data' => 'Data',
			'valor' => 'Valor',
		);
	}

	/**
	 * Retrieves a list of models based on the current search/filter conditions.
	 *
	 * Typical usecase:
	 * - Initialize the model fields with values from filter form.
	 * - Execute this method to get CActiveDataProvider instance which will filter
	 * models according to data in model fields.
	 * - Pass data provider to CGridView, CListView or any similar widget.
	 *
	 * @return CActiveDataProvider the data provider that can return the models
	 * based on the search/filter conditions.
	 */
	public function search()
	{
		// @todo Please modify the following code to remove attributes that should not be searched.

		$criteria=new CDbCriteria;

		$criteria->compare('id',$this->id);
		$criteria->compare('user_id',$this->user_id);
		$criteria->compare('trajeto_id',$this->trajeto_id);
		$criteria->compare('ponto_id',$this->ponto_id);
		$criteria->compare('data',$this->data,true);
		$criteria->compare('valor',$this->valor);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}

	/**
	 * Returns the static model of the specified AR class.
	 * Please note that you should have this exact method in all your CActiveRecord descendants!
	 * @param string $className active record class name.
	 * @return Avulso the static model class
	 */
	public static function model($className=__CLASS__)
	{
		return parent::model($className);
	}
}
