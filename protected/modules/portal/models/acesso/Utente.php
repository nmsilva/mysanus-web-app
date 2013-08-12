<?php

/**
 * This is the model class for table "utentes".
 *
 * The followings are the available columns in table 'utentes':
 * @property integer $ID_USER
 * @property string $SEXO
 * @property integer $VALIDACAO
 * @property string $ESTADO_CIVIL
 * @property string $NCONTRIBUINTE
 * @property string $NBENEFICIARIO
 * @property string $NIF
 * @property string $TELEFONE_FIXO
 * @property string $TELEMOVEL2
 * @property string $TELEMOVEL3
 *
 * The followings are the available model relations:
 * @property Agregado[] $agregados
 * @property Agregado[] $agregados1
 * @property Consultas[] $consultases
 * @property Documentos[] $documentoses
 * @property RespondeQuest[] $respondeQuests
 * @property Entidades[] $entidades
 * @property Utilizador $USER
 */
class Utente extends PortalActiveRecord
{
        public $NOME;
        public $EMAIL;
        public $DATA_REGISTO;

        /**
	 * Returns the static model of the specified AR class.
	 * @param string $className active record class name.
	 * @return Utente the static model class
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
		return 'utentes';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('SEXO', 'required'),
			array('VALIDACAO', 'numerical', 'integerOnly'=>true),
			array('ESTADO_CIVIL', 'length', 'max'=>20),
			array('NCONTRIBUINTE, NBENEFICIARIO', 'length', 'max'=>10),
			array('NIF', 'length', 'max'=>16),
                                            
			array('TELEFONE_FIXO, TELEMOVEL2, TELEMOVEL3', 'length', 'max'=>9),
			// The following rule is used by search().
			// Please remove those attributes that should not be searched.
			array('ID_USER, SEXO, VALIDACAO, ESTADO_CIVIL, NCONTRIBUINTE, NBENEFICIARIO, NIF, TELEFONE_FIXO, TELEMOVEL2, TELEMOVEL3,NOME', 'safe', 'on'=>'search'),
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
			'agregados' => array(self::HAS_MANY, 'Agregado', 'ID_USER'),
			'consultases' => array(self::HAS_MANY, 'Consultas', 'ID_USER'),
			'documentoses' => array(self::HAS_MANY, 'Documentos', 'ID_USER'),
			'respondeQuests' => array(self::HAS_MANY, 'RespondeQuest', 'ID_USER'),
			'entidades' => array(self::MANY_MANY, 'Entidades', 'utente_entidade(ID_USER, ID_ENT)'),
			'USER' => array(self::BELONGS_TO, 'Utilizador', 'ID_USER'),
		);
	}

	/**
	 * @return array customized attribute labels (name=>label)
	 */
	public function attributeLabels()
	{
		return array(
			'ID_USER' => t('ID'),
			'SEXO' => t('Sexo'),
			'VALIDACAO' => t('Validação'),
			'ESTADO_CIVIL' => t('Estado Civil'),
			'NCONTRIBUINTE' => t('Nº Contribuinte'),
			'NBENEFICIARIO' => t('Nº Beneficiario'),
			'NIF' => t('NIF'),
			'TELEFONE_FIXO' => t('Telefone Fixo'),
			'TELEMOVEL2' => t('Telemovel 2'),
			'TELEMOVEL3' => t('Telemovel 3'),
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

		$criteria->compare('t.ID_USER',$this->ID_USER);
		$criteria->compare('t.SEXO',$this->SEXO,true);
		$criteria->compare('t.VALIDACAO',$this->VALIDACAO);
		$criteria->compare('t.ESTADO_CIVIL',$this->ESTADO_CIVIL);
		$criteria->compare('t.NCONTRIBUINTE',$this->NCONTRIBUINTE);
		$criteria->compare('t.NBENEFICIARIO',$this->NBENEFICIARIO);
		$criteria->compare('t.NIF',$this->NIF);
		$criteria->compare('t.TELEFONE_FIXO',$this->TELEFONE_FIXO);
		$criteria->compare('t.TELEMOVEL2',$this->TELEMOVEL2);
		$criteria->compare('t.TELEMOVEL3',$this->TELEMOVEL3);
                
                $criteria->with=array('USER');
                
                $criteria->compare('USER.NOME',$this->NOME,true);
                
		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}
        
        public function radioValidate($attribute,$params)
	{
	    if($this->$attribute == null)
	    {
	        $this->addError($attribute,$this->getAttributeLabel($attribute).t(' não pode ser Vazio.'));
	    }
	}
        
      
}