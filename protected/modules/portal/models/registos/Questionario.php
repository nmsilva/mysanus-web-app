<?php

/**
 * This is the model class for table "questionarios".
 *
 * The followings are the available columns in table 'questionarios':
 * @property integer $ID_QUEST
 * @property string $NOME
 * @property string $DATA_CRIACAO
 *
 * The followings are the available model relations:
 * @property Perguntas[] $perguntases
 */
class Questionario extends PortalActiveRecord
{
	/**
	 * Returns the static model of the specified AR class.
	 * @param string $className active record class name.
	 * @return Questionario the static model class
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
		return 'questionarios';
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
			array('NOME', 'length', 'max'=>50),
			// The following rule is used by search().
			// Please remove those attributes that should not be searched.
			array('ID_QUEST, NOME, DATA_CRIACAO', 'safe', 'on'=>'search'),
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
			'perguntases' => array(self::HAS_MANY, 'Perguntas', 'ID_QUEST'),
		);
	}

	/**
	 * @return array customized attribute labels (name=>label)
	 */
	public function attributeLabels()
	{
		return array(
			'ID_QUEST' => t('ID'),
			'NOME' => t('Nome'),
			'DATA_CRIACAO' => t('Data Criação'),
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

		$criteria->compare('ID_QUEST',$this->ID_QUEST);
		$criteria->compare('NOME',$this->NOME,true);
		$criteria->compare('DATA_CRIACAO',$this->DATA_CRIACAO,true);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}
        
        public function beforeSave()
        {   
            if ($this->isNewRecord){
                $this->DATA_CRIACAO = new CDbExpression('NOW()');
            }

            return true;
        }
}