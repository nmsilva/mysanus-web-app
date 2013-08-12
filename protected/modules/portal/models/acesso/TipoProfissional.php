<?php

/**
 * This is the model class for table "tipos_profissional".
 *
 * The followings are the available columns in table 'tipos_profissional':
 * @property integer $ID_TIPO
 * @property string $DESCRICAO
 * @property string $TAG
 * 
 * The followings are the available model relations:
 * @property Profissionais[] $profissionaises
 */
class TipoProfissional extends PortalActiveRecord
{
	/**
	 * Returns the static model of the specified AR class.
	 * @param string $className active record class name.
	 * @return TipoProfissional the static model class
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
		return 'tipos_profissional';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('ID_TIPO, DESCRICAO', 'required'),
			array('ID_TIPO', 'numerical', 'integerOnly'=>true),
			array('DESCRICAO', 'length', 'max'=>150),
			// The following rule is used by search().
			// Please remove those attributes that should not be searched.
			array('ID_TIPO, DESCRICAO', 'safe', 'on'=>'search'),
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
			'PROFISSIONAIS' => array(self::HAS_MANY, 'Profissional', 'ID_TIPO'),
		);
	}

	/**
	 * @return array customized attribute labels (name=>label)
	 */
	public function attributeLabels()
	{
		return array(
			'ID_TIPO' => 'Id Tipo',
			'DESCRICAO' => 'Descricao',
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

		$criteria->compare('ID_TIPO',$this->ID_TIPO);
		$criteria->compare('DESCRICAO',$this->DESCRICAO,true);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}
}