<?php

/**
 * This is the model class for table "agregado".
 *
 * The followings are the available columns in table 'agregado':
 * @property integer $ID_USER
 * @property integer $UTE_ID_USER
 * @property integer $TIPO
 *
 * The followings are the available model relations:
 * @property Utentes $iDUSER
 * @property Utentes $uTEIDUSER
 */
class Agregado extends PortalActiveRecord
{
	/**
	 * Returns the static model of the specified AR class.
	 * @param string $className active record class name.
	 * @return Agregado the static model class
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
		return 'agregado';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('ID_USER, UTE_ID_USER', 'required'),
			array('ID_USER, UTE_ID_USER, TIPO', 'numerical', 'integerOnly'=>true),
			// The following rule is used by search().
			// Please remove those attributes that should not be searched.
			array('ID_USER, UTE_ID_USER, TIPO', 'safe', 'on'=>'search'),
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
			'iDUSER' => array(self::BELONGS_TO, 'Utentes', 'ID_USER'),
			'uTEIDUSER' => array(self::BELONGS_TO, 'Utentes', 'UTE_ID_USER'),
		);
	}

	/**
	 * @return array customized attribute labels (name=>label)
	 */
	public function attributeLabels()
	{
		return array(
			'ID_USER' => 'Id User',
			'UTE_ID_USER' => 'Ute Id User',
			'TIPO' => 'Tipo',
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

		$criteria->compare('ID_USER',$this->ID_USER);
		$criteria->compare('UTE_ID_USER',$this->UTE_ID_USER);
		$criteria->compare('TIPO',$this->TIPO);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}
}