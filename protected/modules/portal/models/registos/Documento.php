<?php

/**
 * This is the model class for table "documentos".
 *
 * The followings are the available columns in table 'documentos':
 * @property integer $ID_DOC
 * @property integer $ID_CON
 * @property integer $ID_USER
 * @property integer $TIPO
 * @property string $DATA_EMISSAO
 * @property integer $ESTADO
 * @property string $NUMERO
 * @property string $IDENTIFICACAO
 * @property string $PATH
 *
 * The followings are the available model relations:
 * @property Consultas $iDCON
 * @property Utentes $iDUSER
 */
class Documento extends PortalActiveRecord
{
	/**
	 * Returns the static model of the specified AR class.
	 * @param string $className active record class name.
	 * @return Documento the static model class
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
		return 'documentos';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('ID_USER, IDENTIFICACAO, PATH', 'required'),
			array('ID_CON, ID_USER, ESTADO', 'numerical', 'integerOnly'=>true),
			array('NUMERO, IDENTIFICACAO', 'length', 'max'=>50),
			// The following rule is used by search().
			// Please remove those attributes that should not be searched.
			array('ID_DOC, ID_CON, ID_USER, TIPO, DATA_EMISSAO, ESTADO, NUMERO, IDENTIFICACAO', 'safe', 'on'=>'search'),
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
			'iDCON' => array(self::BELONGS_TO, 'Consultas', 'ID_CON'),
			'iDUSER' => array(self::BELONGS_TO, 'Utentes', 'ID_USER'),
		);
	}

	/**
	 * @return array customized attribute labels (name=>label)
	 */
	public function attributeLabels()
	{
		return array(
			'ID_DOC' => 'ID',
			'ID_CON' => 'Id Con',
			'ID_USER' => 'Id User',
			'TIPO' => 'Tipo',
			'DATA_EMISSAO' => 'Data Emissao',
			'ESTADO' => 'Estado',
			'NUMERO' => 'Numero',
			'IDENTIFICACAO' => 'Identificação',
			'PATH' => 'Documento',
		);
	}

	/**
	 * Retrieves a list of models based on the current search/filter conditions.
	 * @return CActiveDataProvider the data provider that can return the models based on the search/filter conditions.
	 */
	public function search($id_user)
	{
		// Warning: Please modify the following code to remove attributes that
		// should not be searched.

		$criteria=new CDbCriteria;

		$criteria->compare('ID_DOC',$this->ID_DOC);
		$criteria->compare('ID_CON',$this->ID_CON);
                
                if($id_user)
                    $criteria->compare('ID_USER',$id_user,true);
                else
                    $criteria->compare('ID_USER',$this->ID_USER);
                
		$criteria->compare('TIPO',$this->TIPO);
		$criteria->compare('DATA_EMISSAO',$this->DATA_EMISSAO,true);
		$criteria->compare('ESTADO',$this->ESTADO);
		$criteria->compare('NUMERO',$this->NUMERO,true);
		$criteria->compare('IDENTIFICACAO',$this->IDENTIFICACAO,true);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}
        
        public function beforeSave()
        {   

                if ($this->isNewRecord){
                    $this->DATA_EMISSAO = new CDbExpression('NOW()');
                }
            
                return true;
        }
        
        public static function getDocumentosPath()
        {
            return Yii::app()-> getBasePath()."/../docs";
        }
        
        public function getPublicUrl(){
            return Yii::app()->getBaseUrl()."/docs/".$this->PATH;
        }
}