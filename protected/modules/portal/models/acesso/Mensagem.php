<?php

/**
 * This is the model class for table "mensagens".
 *
 * The followings are the available columns in table 'mensagens':
 * @property integer $ID_MSG
 * @property integer $ID_USER
 * @property string $CONTEUDO
 * @property string $DATA_ENVIO
 * @property string $ASSUNTO
 * @property string $ENVIADA
 * @property string $DATA_CRIACAO
 * @property string $APAGADA
 * 
 * The followings are the available model relations:
 * @property MsgUser[] $msgUsers
 */
class Mensagem extends PortalActiveRecord
{
        public $DESTINATARIOS;
        
	/**
	 * Returns the static model of the specified AR class.
	 * @param string $className active record class name.
	 * @return Mensagem the static model class
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
		return 'mensagens';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('ID_USER,CONTEUDO,ASSUNTO,DESTINATARIOS', 'required'),
			// The following rule is used by search().
			// Please remove those attributes that should not be searched.
			array('ID_MSG, CONTEUDO, DATA_ENVIO,ASSUNTO,ENVIADA', 'safe', 'on'=>'search'),
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
			'MSG_USER' => array(self::HAS_MANY, 'MensagemUtilizador', 'ID_MSG'),
                        'REMETENTE' => array(self::BELONGS_TO, 'Utilizador', 'ID_USER'),
		);
	}

	/**
	 * @return array customized attribute labels (name=>label)
	 */
	public function attributeLabels()
	{
		return array(
			'ID_MSG' => 'ID',
			'ID_USER' => 'Remetente',
			'CONTEUDO' => 'Mensagem',
			'DATA_ENVIO' => 'Data Envio',
                        'DESTINATARIOS' => 'Para',
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

		$criteria->compare('ID_MSG',$this->ID_MSG);
		$criteria->compare('CONTEUDO',$this->CONTEUDO,true);
                
                if($id_user)
                    $criteria->compare('ID_USER',$id_user,true);
                else
                    $criteria->compare('ID_USER',$this->ID_USER);
                
                if($view)
                    $criteria->compare('APAGADA','0');
                
		$criteria->compare('DATA_ENVIO',$this->DATA_ENVIO,true);
                $criteria->order = 'DATA_ENVIO DESC';
                
		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}
        
        public function beforeSave()
        {   
                if ($this->isNewRecord){
                    $this->DATA_CRIACAO = new CDbExpression('NOW()');
                }
            
                return true;
        }

        public static function getDestinatarios($id_msg)
        {
            $destinatarios=  MensagemUtilizador::model()->findAll('ID_MSG=:id', array('id'=>$id_msg));
            
            $result="";
            foreach ($destinatarios as $value) {
                if(end($destinatarios)!=$value)
                    $result.=$value->DESTINATARIO->NOME.", ";
                else
                    $result.=$value->DESTINATARIO->NOME;
            }
            
            return $result;
        }

}