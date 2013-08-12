<?php

/**
 * This is the model class for table "consumiveis".
 *
 * The followings are the available columns in table 'consumiveis':
 * @property integer $ID_CONSU
 * @property integer $ID_FORN
 * @property string $NOME
 *
 * The followings are the available model relations:
 * @property Consultas[] $consultases
 * @property Fornecedores $iDFORN
 */
class Consumivel extends PortalActiveRecord
{
	/**
	 * Returns the static model of the specified AR class.
	 * @param string $className active record class name.
	 * @return Consumivel the static model class
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
		return 'consumiveis';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('ID_FORN, NOME', 'required'),
			array('ID_FORN', 'numerical', 'integerOnly'=>true),
			array('NOME', 'length', 'max'=>100),
			// The following rule is used by search().
			// Please remove those attributes that should not be searched.
			array('ID_CONSU, ID_FORN, NOME', 'safe', 'on'=>'search'),
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
			'consultases' => array(self::MANY_MANY, 'Consultas', 'consum_consulta(ID_CONSU, ID_CON)'),
			'iDFORN' => array(self::BELONGS_TO, 'Fornecedores', 'ID_FORN'),
		);
	}

	/**
	 * @return array customized attribute labels (name=>label)
	 */
	public function attributeLabels()
	{
		return array(
			'ID_CONSU' => 'Id Consu',
			'ID_FORN' => 'Id Forn',
			'NOME' => 'Nome',
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

		$criteria->compare('ID_CONSU',$this->ID_CONSU);
		$criteria->compare('ID_FORN',$this->ID_FORN);
		$criteria->compare('NOME',$this->NOME,true);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}
}