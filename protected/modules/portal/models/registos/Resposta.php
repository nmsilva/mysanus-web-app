<?php

/**
 * This is the model class for table "respostas".
 *
 * The followings are the available columns in table 'respostas':
 * @property integer $ID_RESP
 * @property integer $ID_PERG
 * @property string $RESPOSTA
 * @property string $TIPO
 *
 * The followings are the available model relations:
 * @property RespondeQuest[] $respondeQuests
 * @property Perguntas $iDPERG
 */
class Resposta extends PortalActiveRecord
{
	/**
	 * Returns the static model of the specified AR class.
	 * @param string $className active record class name.
	 * @return Resposta the static model class
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
		return 'respostas';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('ID_PERG, RESPOSTA', 'required'),
			array('ID_PERG', 'numerical', 'integerOnly'=>true),
			array('TIPO', 'length', 'max'=>50),
			// The following rule is used by search().
			// Please remove those attributes that should not be searched.
			array('ID_RESP, ID_PERG, RESPOSTA, TIPO', 'safe', 'on'=>'search'),
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
			'respondeQuests' => array(self::HAS_MANY, 'RespondeQuest', 'ID_RESP'),
			'iDPERG' => array(self::BELONGS_TO, 'Perguntas', 'ID_PERG'),
		);
	}

	/**
	 * @return array customized attribute labels (name=>label)
	 */
	public function attributeLabels()
	{
		return array(
			'ID_RESP' => 'Id Resp',
			'ID_PERG' => 'Id Perg',
			'RESPOSTA' => 'Resposta',
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

		$criteria->compare('ID_RESP',$this->ID_RESP);
		$criteria->compare('ID_PERG',$this->ID_PERG);
		$criteria->compare('RESPOSTA',$this->RESPOSTA,true);
		$criteria->compare('TIPO',$this->TIPO,true);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}
}