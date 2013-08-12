<?php

/**
 * This is the model class for table "entidades".
 *
 * The followings are the available columns in table 'entidades':
 * @property integer $ID_ENT
 * @property integer $ID_TIPO
 * @property string $NOME
 * @property string $SIGLA
 * @property string $TELEFONE
 * @property string $NIF
 * @property string $PORTA
 * @property string $_VALOR_C_
 * @property string $VALOR_K
 * @property string $VALOR_COLHEITA
 * @property string $URB_TAXA_
 * @property string $NURB_TAXA
 * @property string $NURB_KM
 * @property string $CTT_TAXA
 * @property string $CIDADE
 * @property string $CODIGO_POSTAL
 * @property string $RUA
 * @property string $LOCALIDADE
 *
 * The followings are the available model relations:
 * @property Consultas[] $consultases
 * @property Servicos[] $servicoses
 * @property TiposEntidade $iDTIPO
 * @property Locais[] $locaises
 * @property Utentes[] $utentes
 */
class Entidade extends PortalActiveRecord
{
	/**
	 * Returns the static model of the specified AR class.
	 * @param string $className active record class name.
	 * @return Entidade the static model class
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
		return 'entidades';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('ID_TIPO, NOME, SIGLA, TELEFONE, NIF, _VALOR_C_, VALOR_K, VALOR_COLHEITA', 'required'),
			array('ID_TIPO', 'numerical', 'integerOnly'=>true),
			array('NOME, PORTA, CIDADE, RUA, LOCALIDADE', 'length', 'max'=>50),
			array('SIGLA, NIF', 'length', 'max'=>12),
			array('TELEFONE', 'length', 'max'=>9),
			array('_VALOR_C_, VALOR_K, VALOR_COLHEITA, URB_TAXA_, NURB_TAXA, NURB_KM, CTT_TAXA', 'length', 'max'=>8),
			array('CODIGO_POSTAL', 'length', 'max'=>10),
			// The following rule is used by search().
			// Please remove those attributes that should not be searched.
			array('ID_ENT, ID_TIPO, NOME, SIGLA, TELEFONE, NIF, PORTA, _VALOR_C_, VALOR_K, VALOR_COLHEITA, URB_TAXA_, NURB_TAXA, NURB_KM, CTT_TAXA, CIDADE, CODIGO_POSTAL, RUA, LOCALIDADE', 'safe', 'on'=>'search'),
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
			'consultases' => array(self::HAS_MANY, 'Consultas', 'ID_ENT'),
			'servicoses' => array(self::MANY_MANY, 'Servicos', 'entidade_servico(ID_ENT, ID_SERV)'),
			'TIPO' => array(self::BELONGS_TO, 'TipoEntidade', 'ID_TIPO'),
			'locaises' => array(self::MANY_MANY, 'Locais', 'local_entidade(ID_ENT, ID_LOC)'),
			'utentes' => array(self::MANY_MANY, 'Utentes', 'utente_entidade(ID_ENT, ID_USER)'),
		);
	}

	/**
	 * @return array customized attribute labels (name=>label)
	 */
	public function attributeLabels()
	{
		return array(
			'ID_ENT' => 'Id Ent',
			'ID_TIPO' => 'Id Tipo',
			'NOME' => 'Nome',
			'SIGLA' => 'Sigla',
			'TELEFONE' => 'Telefone',
			'NIF' => 'Nif',
			'PORTA' => 'Porta',
			'_VALOR_C_' => 'Valor C',
			'VALOR_K' => 'Valor K',
			'VALOR_COLHEITA' => 'Valor Colheita',
			'URB_TAXA_' => 'Urb Taxa',
			'NURB_TAXA' => 'Nurb Taxa',
			'NURB_KM' => 'Nurb Km',
			'CTT_TAXA' => 'Ctt Taxa',
			'CIDADE' => 'Cidade',
			'CODIGO_POSTAL' => 'Codigo Postal',
			'RUA' => 'Rua',
			'LOCALIDADE' => 'Localidade',
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

		$criteria->compare('ID_ENT',$this->ID_ENT);
		$criteria->compare('ID_TIPO',$this->ID_TIPO);
		$criteria->compare('NOME',$this->NOME,true);
		$criteria->compare('SIGLA',$this->SIGLA,true);
		$criteria->compare('TELEFONE',$this->TELEFONE,true);
		$criteria->compare('NIF',$this->NIF,true);
		$criteria->compare('PORTA',$this->PORTA,true);
		$criteria->compare('_VALOR_C_',$this->_VALOR_C_,true);
		$criteria->compare('VALOR_K',$this->VALOR_K,true);
		$criteria->compare('VALOR_COLHEITA',$this->VALOR_COLHEITA,true);
		$criteria->compare('URB_TAXA_',$this->URB_TAXA_,true);
		$criteria->compare('NURB_TAXA',$this->NURB_TAXA,true);
		$criteria->compare('NURB_KM',$this->NURB_KM,true);
		$criteria->compare('CTT_TAXA',$this->CTT_TAXA,true);
		$criteria->compare('CIDADE',$this->CIDADE,true);
		$criteria->compare('CODIGO_POSTAL',$this->CODIGO_POSTAL,true);
		$criteria->compare('RUA',$this->RUA,true);
		$criteria->compare('LOCALIDADE',$this->LOCALIDADE,true);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}
}