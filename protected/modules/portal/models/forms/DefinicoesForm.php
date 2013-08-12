<?php

class DefinicoesForm extends CFormModel
{
        public $LINGUA;
        public $PAIS;

        public function rules()
        {
            return array(
                array('LINGUA, PAIS', 'required'),
            );
        }

        public function save()
        {
            $id_user=user()->getId();
            foreach ($this->attributes as $key=>$value) {
                
                $def=Definicao::model()->find('TAG=:tag', array('tag'=>$key));
                if(!$def)
                {
                    $def=new Definicao;
                    $def->TAG=$key;
                    $def->save();
                }
                
                $def_user=DefinicaoUtilizador::model()->findByPk(array('ID_DEF'=>$def->ID_DEF,'ID_USER'=>$id_user));
                if(!$def_user){
                   $def_user=new DefinicaoUtilizador;
                   $def_user->ID_DEF=$def->ID_DEF;
                   $def_user->ID_USER=$id_user;
                }
                
                $def_user->VALUE=$value;
                $def_user->save();
                
            }
            
        }
        
        
        public function getValuesDefinicoes()
        {
            $id_user=user()->getId();
            foreach ($this->attributes as $key=>$value) {
                
                $def=Definicao::model()->find('TAG=:tag', array('tag'=>$key));
                if($def)
                {
                    $def_user=DefinicaoUtilizador::model()->findByPk(array('ID_DEF'=>$def->ID_DEF,'ID_USER'=>$id_user));
                    
                    if($def_user)
                        $this->$key=$def_user->VALUE;
                }
                
            }
        }

        /**
        * @return array customized attribute labels (name=>label)
        */
        public function attributeLabels()
        {
                return array(
                        'LINGUA' => t('Língua do Portal'),
                        'PAIS' => t('País'),
                );
        }
        
        
}