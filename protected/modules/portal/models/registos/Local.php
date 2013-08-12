<?php

/**
 * This is the model class for table "locais".
 *
 * The followings are the available columns in table 'locais':
 * @property integer $ID_LOC
 * @property string $NOME
 * @property string $CIDADE
 * @property string $CODIGO_POSTAL
 * @property string $RUA
 * @property string $LOCALIDADE
 *
 * The followings are the available model relations:
 * @property Consultas[] $consultases
 * @property Entidades[] $entidades
 */
class Local extends PortalActiveRecord
{
	/**
	 * Returns the static model of the specified AR class.
	 * @param string $className active record class name.
	 * @return Local the static model class
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
		return 'locais';
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
			array('NOME, CIDADE, RUA, LOCALIDADE', 'length', 'max'=>50),
			array('CODIGO_POSTAL', 'length', 'max'=>10),
			// The following rule is used by search().
			// Please remove those attributes that should not be searched.
			array('ID_LOC, NOME, CIDADE, CODIGO_POSTAL, RUA, LOCALIDADE', 'safe', 'on'=>'search'),
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
			'consultases' => array(self::HAS_MANY, 'Consultas', 'ID_LOC'),
			'ENTIDADE' => array(self::MANY_MANY, 'LocalEntidade', 'local_entidade(ID_LOC, ID_ENT)'),
		);
	}

	/**
	 * @return array customized attribute labels (name=>label)
	 */
	public function attributeLabels()
	{
		return array(
			'ID_LOC' => t('ID'),
			'NOME' => t('Nome'),
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

		$criteria->compare('ID_LOC',$this->ID_LOC);
		$criteria->compare('NOME',$this->NOME,true);
		$criteria->compare('CIDADE',$this->CIDADE,true);
		$criteria->compare('CODIGO_POSTAL',$this->CODIGO_POSTAL,true);
		$criteria->compare('RUA',$this->RUA,true);
		$criteria->compare('LOCALIDADE',$this->LOCALIDADE,true);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}
        
        public function isEntidade($id_ent)
        {
            $model=LocalEntidade::model()->findByPk(array('ID_LOC'=>$this->ID_LOC,'ID_ENT'=>$id_ent));
            
            return ($model)?TRUE:FALSE;
        }
}