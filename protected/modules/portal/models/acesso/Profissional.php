<?php

/**
 * This is the model class for table "profissionais".
 *
 * The followings are the available columns in table 'profissionais':
 * @property integer $ID_USER
 * @property integer $ID_TIPO
 * @property string $FORMACAO
 * @property string $EXPERIENCIA_PROFISSIONAL
 * @property string $AREAS_COMPETENCIA
 * @property string $PREMIOS
 * @property string $VALOR
 * @property string $UNIDADE
 *
 * The followings are the available model relations:
 * @property Agendas[] $agendases
 * @property Consultas[] $consultases
 * @property TipoEspecialidade $TIPO
 * @property ProfissionalEspecialidade $ESPECIALIDADE
 * @property Utilizadores $iDUSER
 */
class Profissional extends PortalActiveRecord
{
        public $NOME;
        public $EMAIL;
        public $DATA_REGISTO;
        
        public $TIPO_ESPECIALIDADE;
	/**
	 * Returns the static model of the specified AR class.
	 * @param string $className active record class name.
	 * @return Profissional the static model class
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
		return 'profissionais';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('ID_TIPO, VALOR', 'required'),
			array('ID_TIPO', 'numerical', 'integerOnly'=>true),
			array('VALOR', 'length', 'max'=>8),
			array('UNIDADE', 'length', 'max'=>25),
			array('FORMACAO, EXPERIENCIA_PROFISSIONAL, AREAS_COMPETENCIA, PREMIOS, UNIDADE', 'safe'),
			// The following rule is used by search().
			// Please remove those attributes that should not be searched.
			array('ID_USER, ID_TIPO, DATA_NASC, FORMACAO, EXPERIENCIA_PROFISSIONAL, AREAS_COMPETENCIA, PREMIOS, VALOR, UNIDADE,NOME', 'safe', 'on'=>'search'),
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
			'AGENDA' => array(self::HAS_MANY, 'Agendas', 'ID_USER'),
			'CONSULTAS' => array(self::MANY_MANY, 'Consultas', 'prof_consulta(ID_USER, ID_CON)'),
                        'TIPO' => array(self::BELONGS_TO, 'TipoProfissional', 'ID_TIPO'),
			'ESPECIALIDADES' => array(self::BELONGS_TO, 'ProfissionalEspecialidade', 'ID_USER'),
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
			'ID_TIPO' => t('Tipo de Profissional'),
			'FORMACAO' => t('Formação'),
			'EXPERIENCIA_PROFISSIONAL' => t('Experiencia Profissional'),
			'AREAS_COMPETENCIA' => t('Areas Competencia'),
			'PREMIOS' => t('Premios'),
			'VALOR' => t('Valor'),
			'UNIDADE' => t('Unidade'),
                        'TIPO_ESPECIALIDADE'=>t('Área'),
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
		$criteria->compare('ID_TIPO',$this->ID_TIPO);
		$criteria->compare('FORMACAO',$this->FORMACAO,true);
		$criteria->compare('EXPERIENCIA_PROFISSIONAL',$this->EXPERIENCIA_PROFISSIONAL,true);
		$criteria->compare('AREAS_COMPETENCIA',$this->AREAS_COMPETENCIA,true);
		$criteria->compare('PREMIOS',$this->PREMIOS,true);
		$criteria->compare('VALOR',$this->VALOR,true);
		$criteria->compare('UNIDADE',$this->UNIDADE,true);
                
                $criteria->with=array('USER');
                
                $criteria->compare('USER.NOME',$this->NOME,true);
                
		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}
}