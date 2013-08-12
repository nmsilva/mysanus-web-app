<?php

/**
 * This is the model class for table "notificacoes".
 *
 * The followings are the available columns in table 'notificacoes':
 * @property integer $ID_NOTF
 * @property string $CONTEUDO
 * @property string $DATA_ENVIO
 *
 * The followings are the available model relations:
 * @property Utilizadores[] $utilizadores
 */
class Notificacao extends PortalActiveRecord
{
	/**
	 * Returns the static model of the specified AR class.
	 * @param string $className active record class name.
	 * @return Notificacao the static model class
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
		return 'notificacoes';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('CONTEUDO, DATA_ENVIO', 'required'),
			// The following rule is used by search().
			// Please remove those attributes that should not be searched.
			array('ID_NOTF, CONTEUDO, DATA_ENVIO', 'safe', 'on'=>'search'),
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
			'NOTIF_USER' => array(self::MANY_MANY, 'NotificacaoUtilizador', 'notif_user(ID_NOTF, ID_USER)'),
		);
	}

	/**
	 * @return array customized attribute labels (name=>label)
	 */
	public function attributeLabels()
	{
		return array(
			'ID_NOTF' => t('ID'),
			'CONTEUDO' => t('Conteudo'),
			'DATA_ENVIO' => t('Data'),
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

		$criteria->compare('ID_NOTF',$this->ID_NOTF);
		$criteria->compare('CONTEUDO',$this->CONTEUDO,true);
		$criteria->compare('DATA_ENVIO',$this->DATA_ENVIO,true);
                                
		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}
}