<?php

/**
 * This is the model class for table "fornecedores".
 *
 * The followings are the available columns in table 'fornecedores':
 * @property integer $ID_FORN
 * @property string $IDENTIFICACAO
 * @property string $NOME_CONTATO
 * @property string $SITE
 * @property string $EMAIL
 * @property string $TELEFONE
 * @property string $TELEMOVEL
 * @property string $OBSERVACOES
 * @property string $CIDADE
 * @property string $CODIGO_POSTAL
 * @property string $RUA
 * @property string $LOCALIDADE
 *
 * The followings are the available model relations:
 * @property Consumiveis[] $consumiveises
 */
class Fornecedor extends PortalActiveRecord
{
	/**
	 * Returns the static model of the specified AR class.
	 * @param string $className active record class name.
	 * @return Fornecedor the static model class
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
		return 'fornecedores';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('IDENTIFICACAO, NOME_CONTATO, EMAIL, TELEMOVEL', 'required'),
			array('IDENTIFICACAO, NOME_CONTATO, SITE, EMAIL, CIDADE, RUA, LOCALIDADE', 'length', 'max'=>50),
			array('TELEFONE, TELEMOVEL', 'length', 'max'=>9),
			array('CODIGO_POSTAL', 'length', 'max'=>10),
			array('OBSERVACOES', 'safe'),
			// The following rule is used by search().
			// Please remove those attributes that should not be searched.
			array('ID_FORN, IDENTIFICACAO, NOME_CONTATO, SITE, EMAIL, TELEFONE, TELEMOVEL, OBSERVACOES, CIDADE, CODIGO_POSTAL, RUA, LOCALIDADE', 'safe', 'on'=>'search'),
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
			'consumiveises' => array(self::HAS_MANY, 'Consumiveis', 'ID_FORN'),
		);
	}

	/**
	 * @return array customized attribute labels (name=>label)
	 */
	public function attributeLabels()
	{
		return array(
			'ID_FORN' => t('ID'),
			'IDENTIFICACAO' => t('Nome'),
			'NOME_CONTATO' => t('Pessoa Contato'),
			'SITE' => t('Site'),
			'EMAIL' => t('Email'),
			'TELEFONE' => t('Telefone'),
			'TELEMOVEL' => t('Telemovel'),
			'OBSERVACOES' => t('Observações'),
			'CIDADE' => t('Cidade'),
			'CODIGO_POSTAL' => t('Codigo Postal'),
			'RUA' => t('Rua'),
			'LOCALIDADE' => t('Localidade'),
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

		$criteria->compare('ID_FORN',$this->ID_FORN);
		$criteria->compare('IDENTIFICACAO',$this->IDENTIFICACAO,true);
		$criteria->compare('NOME_CONTATO',$this->NOME_CONTATO,true);
		$criteria->compare('SITE',$this->SITE,true);
		$criteria->compare('EMAIL',$this->EMAIL,true);
		$criteria->compare('TELEFONE',$this->TELEFONE,true);
		$criteria->compare('TELEMOVEL',$this->TELEMOVEL,true);
		$criteria->compare('OBSERVACOES',$this->OBSERVACOES,true);
		$criteria->compare('CIDADE',$this->CIDADE,true);
		$criteria->compare('CODIGO_POSTAL',$this->CODIGO_POSTAL,true);
		$criteria->compare('RUA',$this->RUA,true);
		$criteria->compare('LOCALIDADE',$this->LOCALIDADE,true);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}
}