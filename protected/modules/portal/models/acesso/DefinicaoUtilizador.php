<?php

/**
 * This is the model class for table "def_user".
 *
 * The followings are the available columns in table 'def_user':
 * @property integer $ID_DEF
 * @property integer $ID_USER
 * @property string $VALUE
 */
class DefinicaoUtilizador extends PortalActiveRecord
{
	/**
	 * Returns the static model of the specified AR class.
	 * @param string $className active record class name.
	 * @return DefinicaoUtilizador the static model class
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
		return 'def_user';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('ID_DEF, ID_USER, VALUE', 'required'),
			array('ID_DEF, ID_USER', 'numerical', 'integerOnly'=>true),
			array('VALUE', 'length', 'max'=>255),
			// The following rule is used by search().
			// Please remove those attributes that should not be searched.
			array('ID_DEF, ID_USER, VALUE', 'safe', 'on'=>'search'),
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
                        'DEFINICAO' => array(self::BELONGS_TO, 'Definicao', 'ID_DEF'),
			'USER' => array(self::BELONGS_TO, 'Utilizador', 'ID_USER'),
		);
	}

	/**
	 * @return array customized attribute labels (name=>label)
	 */
	public function attributeLabels()
	{
		return array(
			'ID_DEF' => 'Id Def',
			'ID_USER' => 'Id User',
			'VALUE' => 'Value',
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

		$criteria->compare('ID_DEF',$this->ID_DEF);
		$criteria->compare('ID_USER',$this->ID_USER);
		$criteria->compare('VALUE',$this->VALUE,true);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}
}