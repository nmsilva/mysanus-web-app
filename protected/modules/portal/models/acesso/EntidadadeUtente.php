<?php

/**
 * This is the model class for table "utente_entidade".
 *
 * The followings are the available columns in table 'utente_entidade':
 * @property integer $ID_USER
 * @property integer $ID_ENT
 * @property string $NBENEFECIARIO
 * @property string $DATA_VALIDADE
 */
class EntidadadeUtente extends PortalActiveRecord
{
	/**
	 * Returns the static model of the specified AR class.
	 * @param string $className active record class name.
	 * @return EntidadadeUtente the static model class
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
		return 'utente_entidade';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('ID_USER, ID_ENT', 'required'),
			array('ID_USER, ID_ENT', 'numerical', 'integerOnly'=>true),
			array('NBENEFECIARIO', 'length', 'max'=>12),
			array('DATA_VALIDADE', 'safe'),
			// The following rule is used by search().
			// Please remove those attributes that should not be searched.
			array('ID_USER, ID_ENT, NBENEFECIARIO, DATA_VALIDADE', 'safe', 'on'=>'search'),
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
			'ID_USER' => 'Id User',
			'ID_ENT' => 'Id Ent',
			'NBENEFECIARIO' => 'Nbenefeciario',
			'DATA_VALIDADE' => 'Data Validade',
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
		$criteria->compare('ID_ENT',$this->ID_ENT);
		$criteria->compare('NBENEFECIARIO',$this->NBENEFECIARIO,true);
		$criteria->compare('DATA_VALIDADE',$this->DATA_VALIDADE,true);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}
}