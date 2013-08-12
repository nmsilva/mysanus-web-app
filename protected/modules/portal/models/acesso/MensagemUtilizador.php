<?php

/**
 * This is the model class for table "msg_user".
 *
 * The followings are the available columns in table 'msg_user':
 * @property integer $ID_MSG
 * @property integer $ID_USER
 * @property string $DATA_VISUALI
 * @property integer $VISTA
 * @property string $APAGADA
 *
 * The followings are the available model relations:
 * @property Mensagens $iDMSG
 * @property Utilizadores $iDUSER
 * @property Utilizadores $uTIIDUSER
 */
class MensagemUtilizador extends PortalActiveRecord
{
	/**
	 * Returns the static model of the specified AR class.
	 * @param string $className active record class name.
	 * @return MensagemUtilizador the static model class
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
		return 'msg_user';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('ID_MSG, ID_USER', 'required'),
			array('ID_MSG, ID_USER, VISTA', 'numerical', 'integerOnly'=>true),
			// The following rule is used by search().
			// Please remove those attributes that should not be searched.
			array('ID_MSG, ID_USER, DATA_VISUALI, VISTA', 'safe', 'on'=>'search'),
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
			'MENSAGEM' => array(self::BELONGS_TO, 'Mensagem', 'ID_MSG'),
			'DESTINATARIO' => array(self::BELONGS_TO, 'Utilizador', 'ID_USER'),
		);
	}

	/**
	 * @return array customized attribute labels (name=>label)
	 */
	public function attributeLabels()
	{
		return array(
			'ID_MSG' => 'ID',
			'ID_USER' => 'Destinatário',
			'DATA_VISUALI' => 'Data Visualização',
			'VISTA' => 'Vista',
                        'DESTINATARIO'=>'Destinatário'
		);
	}

	/**
	 * Retrieves a list of models based on the current search/filter conditions.
	 * @return CActiveDataProvider the data provider that can return the models based on the search/filter conditions.
	 */
	public function search($id_user,$view=true)
	{
		// Warning: Please modify the following code to remove attributes that
		// should not be searched.

		$criteria=new CDbCriteria;

		$criteria->compare('ID_MSG',$this->ID_MSG);
                
                if($id_user)
                    $criteria->compare('t.ID_USER',$id_user);
                else
                    $criteria->compare('t.ID_USER',$this->ID_USER);
                
		$criteria->compare('DATA_VISUALI',$this->DATA_VISUALI,true);
                
                $criteria->with=array('MENSAGEM');
                
                if($view){
                    $criteria->compare('t.APAGADA','0');
                    $criteria->compare('MENSAGEM.ENVIADA','1');
                      
                }
                
                $criteria->order = 'MENSAGEM.DATA_ENVIO DESC';
                
		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}
        
        
}