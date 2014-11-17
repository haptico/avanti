<?php

/**
 * This is the model class for table "veiculo".
 *
 * The followings are the available columns in table 'veiculo':
 * @property integer $id
 * @property string $descricao
 * @property string $placa
 * @property integer $vagas
 * @property integer $tipo_veiculo_id
 * @property integer $user_id
 * @property string $ativo
 * @property string $created
 *
 * The followings are the available model relations:
 * @property Trajeto[] $trajetos
 * @property TipoVeiculo $tipoVeiculo
 * @property Users $user
 */
class Veiculo extends CActiveRecord {

    /**
     * @return string the associated database table name
     */
    public function tableName() {
        return 'veiculo';
    }

    /**
     * @return array validation rules for model attributes.
     */
    public function rules() {
        // NOTE: you should only define rules for those attributes that
        // will receive user inputs.
        return array(
            array('placa, vagas, tipo_veiculo_id, user_id, created', 'required'),
            array('vagas, tipo_veiculo_id, user_id', 'numerical', 'integerOnly' => true),
            array('descricao', 'length', 'max' => 4000),
            array('placa', 'length', 'max' => 8),
            array('ativo', 'length', 'max' => 1),
            // The following rule is used by search().
            // @todo Please remove those attributes that should not be searched.
            array('id, descricao, placa, vagas, tipo_veiculo_id, user_id, ativo, created', 'safe', 'on' => 'search'),
        );
    }

    /**
     * @return array relational rules.
     */
    public function relations() {
        // NOTE: you may need to adjust the relation name and the related
        // class name for the relations automatically generated below.
        return array(
            'trajetos' => array(self::HAS_MANY, 'Trajeto', 'veiculo_id'),
            'tipoVeiculo' => array(self::BELONGS_TO, 'TipoVeiculo', 'tipo_veiculo_id'),
            'user' => array(self::BELONGS_TO, 'Users', 'user_id'),
        );
    }

    /**
     * @return array customized attribute labels (name=>label)
     */
    public function attributeLabels() {
        return array(
            'id' => 'ID',
            'descricao' => 'Descricao',
            'placa' => 'Placa',
            'vagas' => 'Vagas',
            'tipo_veiculo_id' => 'Tipo Veiculo',
            'user_id' => 'User',
            'ativo' => 'Ativo',
            'created' => 'Created',
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
    public function search() {
        // @todo Please modify the following code to remove attributes that should not be searched.

        $criteria = new CDbCriteria;

        $criteria->compare('id', $this->id);
        $criteria->compare('descricao', $this->descricao, true);
        $criteria->compare('placa', $this->placa, true);
        $criteria->compare('vagas', $this->vagas);
        $criteria->compare('tipo_veiculo_id', $this->tipo_veiculo_id);
        $criteria->compare('user_id', $this->user_id);
        $criteria->compare('ativo', $this->ativo, true);
        $criteria->compare('created', $this->created, true);

        return new CActiveDataProvider($this, array(
            'criteria' => $criteria,
        ));
    }

    /**
     * Returns the static model of the specified AR class.
     * Please note that you should have this exact method in all your CActiveRecord descendants!
     * @param string $className active record class name.
     * @return Veiculo the static model class
     */
    public static function model($className = __CLASS__) {
        return parent::model($className);
    }

}
