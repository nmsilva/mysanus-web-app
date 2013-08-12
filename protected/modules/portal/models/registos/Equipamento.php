<?php

/**
 * This is the model class for table "equipamentos".
 *
 * The followings are the available columns in table 'equipamentos':
 * @property integer $ID_EQUIP
 * @property string $NOME
 * @property integer $ESTADO
 *
 * The followings are the available model relations:
 * @property Consultas[] $consultases
 * @property Especialidades[] $especialidades
 * @property Requisitos[] $requisitoses
 */
class Equipamento extends PortalActiveRecord
{
	/**
	 * Returns the static model of the specified AR class.
	 * @param string $className active record class name.
	 * @return Equipamento the static model class
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
		return 'equipamentos';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('NOME', 'required'),
			array('ESTADO', 'numerical', 'integerOnly'=>true),
			array('NOME', 'length', 'max'=>50),
			// The following rule is used by search().
			// Please remove those attributes that should not be searched.
			array('ID_EQUIP, NOME, ESTADO', 'safe', 'on'=>'search'),
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
			'consultases' => array(self::MANY_MANY, 'Consultas', 'equi_consulta(ID_EQUIP, ID_CON)'),
			'especialidades' => array(self::MANY_MANY, 'Especialidades', 'equipamento_especialidade(ID_EQUIP, ID_ESP)'),
			'requisitoses' => array(self::MANY_MANY, 'Requisitos', 'equipamento_requesito(ID_EQUIP, ID_REQ)'),
		);
	}

	/**
	 * @return array customized attribute labels (name=>label)
	 */
	public function attributeLabels()
	{
		return array(
			'ID_EQUIP' => 'Id Equip',
			'NOME' => 'Nome',
			'ESTADO' => 'Estado',
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

		$criteria->compare('ID_EQUIP',$this->ID_EQUIP);
		$criteria->compare('NOME',$this->NOME,true);
		$criteria->compare('ESTADO',$this->ESTADO);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}
}