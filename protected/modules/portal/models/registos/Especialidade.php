<?php

/**
 * This is the model class for table "especialidades".
 *
 * The followings are the available columns in table 'especialidades':
 * @property integer $ID_ESP
 * @property integer $ID_TIPO
 * @property string $NOME
 *
 * The followings are the available model relations:
 * @property Consultas[] $consultases
 * @property Equipamentos[] $equipamentoses
 * @property TiposEspecialidade $iDTIPO
 * @property Profissionais[] $profissionaises
 * @property Requisitos[] $requisitoses
 * @property Servicos[] $servicoses
 */
class Especialidade extends PortalActiveRecord
{
	/**
	 * Returns the static model of the specified AR class.
	 * @param string $className active record class name.
	 * @return Especialidade the static model class
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
		return 'especialidades';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('ID_TIPO, NOME', 'required'),
			array('ID_TIPO', 'numerical', 'integerOnly'=>true),
			array('NOME', 'length', 'max'=>50),
			// The following rule is used by search().
			// Please remove those attributes that should not be searched.
			array('ID_ESP, ID_TIPO, NOME', 'safe', 'on'=>'search'),
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
			'consultases' => array(self::HAS_MANY, 'Consultas', 'ID_ESP'),
			'equipamentoses' => array(self::MANY_MANY, 'Equipamentos', 'equipamento_especialidade(ID_ESP, ID_EQUIP)'),
			'TIPO' => array(self::BELONGS_TO, 'TipoEspecialidade', 'ID_TIPO'),
			'profissionaises' => array(self::MANY_MANY, 'Profissionais', 'pro_especialidade(ID_ESP, ID_USER)'),
			'requisitoses' => array(self::HAS_MANY, 'Requisitos', 'ID_ESP'),
			'servicoses' => array(self::HAS_MANY, 'Servicos', 'ID_ESP'),
		);
	}

	/**
	 * @return array customized attribute labels (name=>label)
	 */
	public function attributeLabels()
	{
		return array(
			'ID_ESP' => t('ID'),
			'ID_TIPO' => t('Area'),
			'NOME' => t('Nome'),
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
		$criteria->compare('ID_TIPO',$this->ID_TIPO);
		$criteria->compare('NOME',$this->NOME,true);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}
        
        public function isProfissional($ID_USER){
            
            $model= ProfissionalEspecialidade::model()->findByPk(array('ID_ESP'=>$this->ID_ESP,'ID_USER'=>$ID_USER));
            
            return ($model)?TRUE:FALSE;

        }
}