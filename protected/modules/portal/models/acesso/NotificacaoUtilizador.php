<?php

/**
 * This is the model class for table "notif_user".
 *
 * The followings are the available columns in table 'notif_user':
 * @property integer $ID_USER
 * @property integer $ID_NOTF
 * @property string $DATA_VISUALI
 * @property integer $VISTA
 * @property integer $APAGADA
 */
class NotificacaoUtilizador extends PortalActiveRecord
{
	/**
	 * Returns the static model of the specified AR class.
	 * @param string $className active record class name.
	 * @return NotificacaoUtilizador the static model class
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
		return 'notif_user';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('ID_USER, ID_NOTF', 'required'),
			array('ID_USER, ID_NOTF, VISTA', 'numerical', 'integerOnly'=>true),
			// The following rule is used by search().
			// Please remove those attributes that should not be searched.
			array('ID_USER, ID_NOTF, DATA_VISUALI, VISTA', 'safe', 'on'=>'search'),
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
                    'NOTIFICACAO' => array(self::BELONGS_TO, 'Notificacao', 'ID_NOTF'),
                    'UTILIZADOR' => array(self::BELONGS_TO, 'Utilizador', 'ID_USER'),
		);
	}

	/**
	 * @return array customized attribute labels (name=>label)
	 */
	public function attributeLabels()
	{
		return array(
			'ID_USER' => t('Utilizador'),
			'ID_NOTF' => t('ID'),
			'DATA_VISUALI' => t('Data Visuali'),
			'VISTA' => t('Vista'),
		);
	}

	/**
	 * Retrieves a list of models based on the current search/filter conditions.
	 * @return CActiveDataProvider the data provider that can return the models based on the search/filter conditions.
	 */
	public function search($id_user,$view=TRUE)
	{
		// Warning: Please modify the following code to remove attributes that
		// should not be searched.

		$criteria=new CDbCriteria;

		if($id_user)
                    $criteria->compare('ID_USER',$id_user,true);
                else
                    $criteria->compare('ID_USER',$this->ID_USER);
                
		$criteria->compare('ID_NOTF',$this->ID_NOTF);
		$criteria->compare('DATA_VISUALI',$this->DATA_VISUALI,true);
                
                if($view)
                    $criteria->compare('APAGADA','0');
                
                $criteria->with=array('NOTIFICACAO');
                $criteria->order = 'NOTIFICACAO.DATA_ENVIO DESC';
                
                
		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}
}