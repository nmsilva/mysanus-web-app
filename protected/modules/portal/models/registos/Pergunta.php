<?php

/**
 * This is the model class for table "perguntas".
 *
 * The followings are the available columns in table 'perguntas':
 * @property integer $ID_PERG
 * @property integer $ID_QUEST
 * @property string $PERGUNTA
 *
 * The followings are the available model relations:
 * @property Questionarios $iDQUEST
 * @property RespondeQuest[] $respondeQuests
 * @property Respostas[] $respostases
 */
class Pergunta extends PortalActiveRecord
{
	/**
	 * Returns the static model of the specified AR class.
	 * @param string $className active record class name.
	 * @return Pergunta the static model class
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
		return 'perguntas';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('ID_QUEST, PERGUNTA', 'required'),
			array('ID_QUEST', 'numerical', 'integerOnly'=>true),
			// The following rule is used by search().
			// Please remove those attributes that should not be searched.
			array('ID_PERG, ID_QUEST, PERGUNTA', 'safe', 'on'=>'search'),
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
			'iDQUEST' => array(self::BELONGS_TO, 'Questionarios', 'ID_QUEST'),
			'respondeQuests' => array(self::HAS_MANY, 'RespondeQuest', 'ID_PERG'),
			'respostases' => array(self::HAS_MANY, 'Respostas', 'ID_PERG'),
		);
	}

	/**
	 * @return array customized attribute labels (name=>label)
	 */
	public function attributeLabels()
	{
		return array(
			'ID_PERG' => 'Id Perg',
			'ID_QUEST' => 'Id Quest',
			'PERGUNTA' => 'Pergunta',
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

		$criteria->compare('ID_PERG',$this->ID_PERG);
		$criteria->compare('ID_QUEST',$this->ID_QUEST);
		$criteria->compare('PERGUNTA',$this->PERGUNTA,true);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}
        
        public function getRespostas()
        {
            return Resposta::model()->findAll('ID_PERG=:perg', array('perg'=>$this->ID_PERG));
        }
}