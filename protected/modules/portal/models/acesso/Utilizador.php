<?php

/**
 * This is the model class for table "utilizadores".
 *
 * The followings are the available columns in table 'utilizadores':
 * @property integer $ID_USER
 * @property string $NOME
 * @property string $EMAIL
 * @property string $PASSWORD
 * @property string $SALT
 * @property integer $ESTADO
 * @property string $DATA_REGISTO
 * @property string $DATA_REVISAO
 * @property integer $VERSAO
 * @property integer $ADMIN
 * @property string $DATA_NASC
 * @property string $TELEMOVEL
 * @property string $FOTO
 * @property string $CIDADE
 * @property string $CODIGO_POSTAL
 * @property string $RUA
 * @property string $LOCALIDADE
 * @property string $BI
 *
 * The followings are the available model relations:
 * @property MsgUser[] $msgUsers
 * @property MsgUser[] $msgUsers1
 * @property Notificacoes[] $notificacoes
 * @property Profissionais $profissionais
 * @property Utentes $utentes
 * @property CodigosPostais $cPO
 */
class Utilizador extends PortalActiveRecord
{
        public $CONFIRM_PASSWORD;
        public $TERMOS;
        
	/**
	 * Returns the static model of the specified AR class.
	 * @param string $className active record class name.
	 * @return Utilizador the static model class
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
		return 'utilizadores';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('NOME, DATA_NASC, EMAIL, PASSWORD, CONFIRM_PASSWORD, TERMOS', 'required'),
                        // when in register scenario, password must match password2
                        array('PASSWORD', 'compare', 'compareAttribute'=>'CONFIRM_PASSWORD'),
                    
			array('ESTADO, VERSAO, ADMIN', 'numerical', 'integerOnly'=>true),
			array('NOME', 'length', 'max'=>50),
                        array('BI', 'length', 'max'=>9),
                        array('TERMOS', 'required', 'requiredValue'=>true,'message' => t('You must agree to the terms and conditions') ),
			array('EMAIL, SALT', 'length', 'max'=>100),
			array('DATA_REVISAO,CIDADE,LOCALIDADE,CODIGO_POSTAL,RUA,TELEMOVEL,FOTO,DATA_NASC', 'safe'),
                        array('EMAIL', 'email'),
                        array('EMAIL', 'unique'),
                                            
			// The following rule is used by search().
			// Please remove those attributes that should not be searched.
			array('ID_USER, CPO_ID, NOME, EMAIL, PASSWORD, SALT, ESTADO, DATA_REGISTO, DATA_REVISAO, VERSAO, ADMIN, BI', 'safe', 'on'=>'search'),
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
			'MENSAGENS' => array(self::HAS_MANY, 'MensagemUtilizador', 'ID_USER'),
			'NOTIFICACOES' => array(self::MANY_MANY, 'Notificacao', 'notif_user(ID_USER, ID_NOTF)'),
			'PROFISSIONAL' => array(self::HAS_ONE, 'Profissional', 'ID_USER'),
			'UTENTE' => array(self::HAS_ONE, 'Utente', 'ID_USER'),
		);
	}

	/**
	 * @return array customized attribute labels (name=>label)
	 */
	public function attributeLabels()
	{
		return array(
			'ID_USER' => t('ID'),
			'NOME' => t('Nome'),
			'EMAIL' => t('Email'),
			'PASSWORD' => t('Password'),
			'SALT' => t('Salt'),
			'ESTADO' => t('Estado'),
			'DATA_REGISTO' => t('Data Registo'),
			'DATA_REVISAO' => t('Data Revisao'),
			'VERSAO' => t('Versao'),
			'ADMIN' => t('Admin'),
			'BI' => t('BI'),
			'DATA_NASC' => t('Data de Nascimento'),
			'TELEMOVEL' => t('Telemóvel'),
			'CIDADE' => t('Cidade'),
			'CODIGO_POSTAL' => t('Código Postal'),
			'LOCALIDADE' => t('Localidade'),
			'RUA' => t('Rua'),
                        'FOTO' => t('Foto'),
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
		$criteria->compare('CPO_ID',$this->CPO_ID);
		$criteria->compare('NOME',$this->NOME,true);
		$criteria->compare('EMAIL',$this->EMAIL,true);
		$criteria->compare('PASSWORD',$this->PASSWORD,true);
		$criteria->compare('SALT',$this->SALT,true);
		$criteria->compare('ESTADO',$this->ESTADO);
		$criteria->compare('DATA_REGISTO',$this->DATA_REGISTO,true);
		$criteria->compare('DATA_REVISAO',$this->DATA_REVISAO,true);
		$criteria->compare('VERSAO',$this->VERSAO);
		$criteria->compare('ADMIN',$this->ADMIN);
		$criteria->compare('BI',$this->BI,true);
		$criteria->compare('DATA_NASC',$this->DATA_NASC,true);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}
        
        public function beforeSave()
        {   

                if ($this->isNewRecord){
                    $this->getHashPassword();
                }
                else{
                    $this->DATA_REVISAO = new CDbExpression('NOW()');
                }
            
                return true;
        }
        
        public function getHashPassword()
        {
            $record2=new Utilizador;  
                
            while ($record2 != null){
                    $salt = Randomness::randomString(32);
                    $record2 = Utilizador::model()->findByAttributes(array('SALT'=>$salt));
            }

            $pass = hash('sha512', $this->PASSWORD.$salt);   
            $this->SALT = $salt;
            $this->PASSWORD = $pass;

            $this->DATA_REGISTO = new CDbExpression('NOW()');
        }
}