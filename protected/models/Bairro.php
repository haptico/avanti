<?php

/**
 * This is the model class for table "bairro".
 *
 * The followings are the available columns in table 'bairro':
 * @property integer $id
 * @property string $nome
 * @property integer $cidade_id
 *
 * The followings are the available model relations:
 * @property Cidade $cidade
 * @property Ponto[] $pontos
 * @property Trajeto[] $trajetos
 * @property Trajeto[] $trajetos1
 */
class Bairro extends CActiveRecord
{
	/**
	 * @return string the associated database table name
	 */
	public function tableName()
	{
		return 'bairro';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('nome, cidade_id', 'required'),
			array('cidade_id', 'numerical', 'integerOnly'=>true),
			array('nome', 'length', 'max'=>256),
			// The following rule is used by search().
			// @todo Please remove those attributes that should not be searched.
			array('id, nome, cidade_id', 'safe', 'on'=>'search'),
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
			'cidade' => array(self::BELONGS_TO, 'Cidade', 'cidade_id'),
			'pontos' => array(self::HAS_MANY, 'Ponto', 'bairro_id'),
			'trajetos' => array(self::HAS_MANY, 'Trajeto', 'bairro_destino_id'),
			'trajetos1' => array(self::HAS_MANY, 'Trajeto', 'bairro_origem_id'),
		);
	}

	/**
	 * @return array customized attribute labels (name=>label)
	 */
	public function attributeLabels()
	{
		return array(
			'id' => 'ID',
			'nome' => 'Nome',
			'cidade_id' => 'Cidade',
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
		$criteria->compare('nome',$this->nome,true);
		$criteria->compare('cidade_id',$this->cidade_id);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}

	/**
	 * Returns the static model of the specified AR class.
	 * Please note that you should have this exact method in all your CActiveRecord descendants!
	 * @param string $className active record class name.
	 * @return Bairro the static model class
	 */
	public static function model($className=__CLASS__)
	{
		return parent::model($className);
	}
}
