<?php

/**
 * This is the model class for table "definicoes".
 *
 * The followings are the available columns in table 'definicoes':
 * @property integer $ID_DEF
 * @property string $TAG
 *
 * The followings are the available model relations:
 * @property Utilizadores[] $utilizadores
 */
class Definicao extends PortalActiveRecord
{
	/**
	 * Returns the static model of the specified AR class.
	 * @param string $className active record class name.
	 * @return Definicao the static model class
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
		return 'definicoes';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('TAG', 'required'),
			array('TAG', 'length', 'max'=>100),
			// The following rule is used by search().
			// Please remove those attributes that should not be searched.
			array('ID_DEF, TAG', 'safe', 'on'=>'search'),
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
                        'DEF_USER' => array(self::HAS_MANY, 'DefinicaoUtilizador', 'ID_DEF'),
		);
	}

	/**
	 * @return array customized attribute labels (name=>label)
	 */
	public function attributeLabels()
	{
		return array(
			'ID_DEF' => 'Id Def',
			'TAG' => 'Tag',
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
		$criteria->compare('TAG',$this->TAG,true);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}
}