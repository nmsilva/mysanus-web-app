<?php

/**
 * This is the model class for table "servicos".
 *
 * The followings are the available columns in table 'servicos':
 * @property integer $ID_SERV
 * @property integer $ID_ESP
 * @property string $NOME
 *
 * The followings are the available model relations:
 * @property Entidades[] $entidades
 * @property Especialidades $iDESP
 * @property Consultas[] $consultases
 */
class Servico extends PortalActiveRecord
{
	/**
	 * Returns the static model of the specified AR class.
	 * @param string $className active record class name.
	 * @return Servico the static model class
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
		return 'servicos';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('ID_ESP, NOME', 'required'),
			array('ID_ESP', 'numerical', 'integerOnly'=>true),
			array('NOME', 'length', 'max'=>50),
			// The following rule is used by search().
			// Please remove those attributes that should not be searched.
			array('ID_SERV, ID_ESP, NOME', 'safe', 'on'=>'search'),
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
			'entidades' => array(self::MANY_MANY, 'Entidades', 'entidade_servico(ID_SERV, ID_ENT)'),
			'ESPECIALIDADE' => array(self::BELONGS_TO, 'Especialidade', 'ID_ESP'),
			'consultases' => array(self::MANY_MANY, 'Consultas', 'servicos_adicionais(ID_SERV, ID_CON)'),
		);
	}

	/**
	 * @return array customized attribute labels (name=>label)
	 */
	public function attributeLabels()
	{
		return array(
			'ID_SERV' => t('ID'),
			'ID_ESP' => t('Especialidade'),
			'NOME' => t('Nome'),
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

		$criteria->compare('ID_SERV',$this->ID_SERV);
		$criteria->compare('ID_ESP',$this->ID_ESP);
		$criteria->compare('NOME',$this->NOME,true);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}
}