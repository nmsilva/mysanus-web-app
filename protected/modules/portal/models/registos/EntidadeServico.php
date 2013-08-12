<?php

/**
 * This is the model class for table "entidade_servico".
 *
 * The followings are the available columns in table 'entidade_servico':
 * @property integer $ID_ENT
 * @property integer $ID_SERV
 * @property string $VALOR
 * @property string $COD_SERVICO
 * @property string $DESIG_SERVICO
 * @property string $TAXA
 * @property integer $EUR_TAXA
 * @property string $TAXA_URGENT
 * @property integer $EUR_TAXA_URGENT
 */
class EntidadeServico extends PortalActiveRecord
{
	/**
	 * Returns the static model of the specified AR class.
	 * @param string $className active record class name.
	 * @return EntidadeServico the static model class
	 */
	public static function model($className=__CLASS__)
	{
		return parent::model($className);
	}

	/**
	 * @return string the associated database table name
	 */
	public function tableName()
	{
		return 'entidade_servico';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('ID_ENT, ID_SERV, VALOR, COD_SERVICO, DESIG_SERVICO, TAXA', 'required'),
			array('ID_ENT, ID_SERV, EUR_TAXA, EUR_TAXA_URGENT', 'numerical', 'integerOnly'=>true),
			array('VALOR', 'length', 'max'=>8),
			array('COD_SERVICO', 'length', 'max'=>12),
			array('TAXA, TAXA_URGENT', 'length', 'max'=>20),
			// The following rule is used by search().
			// Please remove those attributes that should not be searched.
			array('ID_ENT, ID_SERV, VALOR, COD_SERVICO, DESIG_SERVICO, TAXA, EUR_TAXA, TAXA_URGENT, EUR_TAXA_URGENT', 'safe', 'on'=>'search'),
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
		);
	}

	/**
	 * @return array customized attribute labels (name=>label)
	 */
	public function attributeLabels()
	{
		return array(
			'ID_ENT' => 'Id Ent',
			'ID_SERV' => 'Id Serv',
			'VALOR' => 'Valor',
			'COD_SERVICO' => 'Cod Servico',
			'DESIG_SERVICO' => 'Desig Servico',
			'TAXA' => 'Taxa',
			'EUR_TAXA' => 'Eur Taxa',
			'TAXA_URGENT' => 'Taxa Urgent',
			'EUR_TAXA_URGENT' => 'Eur Taxa Urgent',
		);
	}

	/**
	 * Retrieves a list of models based on the current search/filter conditions.
	 * @return CActiveDataProvider the data provider that can return the models based on the search/filter conditions.
	 */
	public function search()
	{
		// Warning: Please modify the following code to remove attributes that
		// should not be searched.

		$criteria=new CDbCriteria;

		$criteria->compare('ID_ENT',$this->ID_ENT);
		$criteria->compare('ID_SERV',$this->ID_SERV);
		$criteria->compare('VALOR',$this->VALOR,true);
		$criteria->compare('COD_SERVICO',$this->COD_SERVICO,true);
		$criteria->compare('DESIG_SERVICO',$this->DESIG_SERVICO,true);
		$criteria->compare('TAXA',$this->TAXA,true);
		$criteria->compare('EUR_TAXA',$this->EUR_TAXA);
		$criteria->compare('TAXA_URGENT',$this->TAXA_URGENT,true);
		$criteria->compare('EUR_TAXA_URGENT',$this->EUR_TAXA_URGENT);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}
}