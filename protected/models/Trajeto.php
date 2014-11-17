<?php

/**
 * This is the model class for table "trajeto".
 *
 * The followings are the available columns in table 'trajeto':
 * @property integer $id
 * @property string $descricao
 * @property integer $veiculo_id
 * @property string $hora_inicio
 * @property string $hora_fim
 * @property integer $bairro_origem_id
 * @property integer $bairro_destino_id
 * @property string $preco_mensalista
 * @property string $preco_avulso
 * @property string $ativo
 * @property string $created
 *
 * The followings are the available model relations:
 * @property Avulso[] $avulsos
 * @property Mensalista[] $mensalistas
 * @property Ponto[] $pontos
 * @property Bairro $bairroDestino
 * @property Bairro $bairroOrigem
 * @property Veiculo $veiculo
 */
class Trajeto extends CActiveRecord {

    /**
     * @return string the associated database table name
     */
    public function tableName() {
        return 'trajeto';
    }

    /**
     * @return array validation rules for model attributes.
     */
    public function rules() {
        // NOTE: you should only define rules for those attributes that
        // will receive user inputs.
        return array(
            array('veiculo_id, hora_inicio, hora_fim, bairro_origem_id, bairro_destino_id, preco_mensalista, preco_avulso, created', 'required'),
            array('veiculo_id, bairro_origem_id, bairro_destino_id', 'numerical', 'integerOnly' => true),
            array('descricao', 'length', 'max' => 4000),
            array('preco_mensalista, preco_avulso', 'length', 'max' => 15),
            array('ativo', 'length', 'max' => 1),
            // The following rule is used by search().
            // @todo Please remove those attributes that should not be searched.
            array('id, descricao, veiculo_id, hora_inicio, hora_fim, bairro_origem_id, bairro_destino_id, preco_mensalista, preco_avulso, ativo, created', 'safe', 'on' => 'search'),
        );
    }

    /**
     * @return array relational rules.
     */
    public function relations() {
        // NOTE: you may need to adjust the relation name and the related
        // class name for the relations automatically generated below.
        return array(
            'avulsos' => array(self::HAS_MANY, 'Avulso', 'trajeto_id'),
            'mensalistas' => array(self::HAS_MANY, 'Mensalista', 'trajeto_id'),
            'pontos' => array(self::HAS_MANY, 'Ponto', 'trajeto_id'),
            'bairroDestino' => array(self::BELONGS_TO, 'Bairro', 'bairro_destino_id'),
            'bairroOrigem' => array(self::BELONGS_TO, 'Bairro', 'bairro_origem_id'),
            'veiculo' => array(self::BELONGS_TO, 'Veiculo', 'veiculo_id'),
        );
    }

    /**
     * @return array customized attribute labels (name=>label)
     */
    public function attributeLabels() {
        return array(
            'id' => 'ID',
            'descricao' => 'Descrição',
            'veiculo_id' => 'Veiculo',
            'hora_inicio' => 'Hora Inicio',
            'hora_fim' => 'Hora Fim',
            'bairro_origem_id' => 'Bairro Origem',
            'bairro_destino_id' => 'Bairro Destino',
            'preco_mensalista' => 'Preco Mensalista',
            'preco_avulso' => 'Preco Avulso',
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
        $criteria->compare('veiculo_id', $this->veiculo_id);
        $criteria->compare('hora_inicio', $this->hora_inicio, true);
        $criteria->compare('hora_fim', $this->hora_fim, true);
        $criteria->compare('bairro_origem_id', $this->bairro_origem_id);
        $criteria->compare('bairro_destino_id', $this->bairro_destino_id);
        $criteria->compare('preco_mensalista', $this->preco_mensalista, true);
        $criteria->compare('preco_avulso', $this->preco_avulso, true);
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
     * @return Trajeto the static model class
     */
    public static function model($className = __CLASS__) {
        return parent::model($className);
    }

}
