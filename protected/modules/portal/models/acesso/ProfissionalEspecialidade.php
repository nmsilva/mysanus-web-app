<?php

/**
 * This is the model class for table "pro_especialidade".
 *
 * The followings are the available columns in table 'pro_especialidade':
 * @property integer $ID_ESP
 * @property integer $ID_USER
 */
class ProfissionalEspecialidade extends PortalActiveRecord
{
	/**
	 * Returns the static model of the specified AR class.
	 * @param string $className active record class name.
	 * @return ProfissionalEspecialidade the static model class
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
		return 'pro_especialidade';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('ID_ESP, ID_USER', 'required'),
			array('ID_ESP, ID_USER', 'numerical', 'integerOnly'=>true),
			// The following rule is used by search().
			// Please remove those attributes that should not be searched.
			array('ID_ESP, ID_USER', 'safe', 'on'=>'search'),
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
                    'ESPECIALIDADE' => array(self::BELONGS_TO, 'Especialidade', 'ID_ESP'),
		);
	}

	/**
	 * @return array customized attribute labels (name=>label)
	 */
	public function attributeLabels()
	{
		return array(
			'ID_ESP' => 'Id Esp',
			'ID_USER' => 'Id User',
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

		$criteria->compare('ID_ESP',$this->ID_ESP);
		$criteria->compare('ID_USER',$this->ID_USER);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}
}