<?php

/**
 * This is the model class for table "ponto".
 *
 * The followings are the available columns in table 'ponto':
 * @property integer $id
 * @property string $nome
 * @property string $descricao
 * @property integer $bairro_id
 * @property string $ativo
 * @property string $created
 * @property integer $trajeto_id
 *
 * The followings are the available model relations:
 * @property Avulso[] $avulsos
 * @property Mensalista[] $mensalistas
 * @property Bairro $bairro
 * @property Trajeto $trajeto
 */
class Ponto extends CActiveRecord
{
	/**
	 * @return string the associated database table name
	 */
	public function tableName()
	{
		return 'ponto';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('nome, descricao, bairro_id, created, trajeto_id', 'required'),
			array('bairro_id, trajeto_id', 'numerical', 'integerOnly'=>true),
			array('nome', 'length', 'max'=>64),
			array('descricao', 'length', 'max'=>4000),
			array('ativo', 'length', 'max'=>1),
			// The following rule is used by search().
			// @todo Please remove those attributes that should not be searched.
			array('id, nome, descricao, bairro_id, ativo, created, trajeto_id', 'safe', 'on'=>'search'),
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
			'avulsos' => array(self::HAS_MANY, 'Avulso', 'ponto_id'),
			'mensalistas' => array(self::HAS_MANY, 'Mensalista', 'ponto_id'),
			'bairro' => array(self::BELONGS_TO, 'Bairro', 'bairro_id'),
			'trajeto' => array(self::BELONGS_TO, 'Trajeto', 'trajeto_id'),
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
			'descricao' => 'Descricao',
			'bairro_id' => 'Bairro',
			'ativo' => 'Ativo',
			'created' => 'Created',
			'trajeto_id' => 'Trajeto',
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
		$criteria->compare('descricao',$this->descricao,true);
		$criteria->compare('bairro_id',$this->bairro_id);
		$criteria->compare('ativo',$this->ativo,true);
		$criteria->compare('created',$this->created,true);
		$criteria->compare('trajeto_id',$this->trajeto_id);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}

	/**
	 * Returns the static model of the specified AR class.
	 * Please note that you should have this exact method in all your CActiveRecord descendants!
	 * @param string $className active record class name.
	 * @return Ponto the static model class
	 */
	public static function model($className=__CLASS__)
	{
		return parent::model($className);
	}
}
