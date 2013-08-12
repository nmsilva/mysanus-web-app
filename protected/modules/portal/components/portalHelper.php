<?php

function get_messages_number($id_user)
{
    
    $command = Yii::app()->db_portal->createCommand();
    
    $result= $command->select('count(*) as num')
                     ->from('msg_user as mu, mensagens as m')
                     ->where('mu.ID_USER='.$id_user.' and mu.ID_MSG=m.ID_MSG and m.ENVIADA=1 and mu.APAGADA=0 and mu.VISTA=0')
                     ->queryRow();
    
    return $result['num'];
}

function get_notifications_number($id_user)
{
    $command = Yii::app()->db_portal->createCommand();
    
    $result= $command->select('count(*) as num')
                     ->from('notif_user')
                     ->where('ID_USER='.$id_user.' and APAGADA=0 and VISTA=0')
                     ->queryRow();
    
    return $result['num'];
}

function get_admin_menu($controller)
{
    echo '<ul style="display: block;">
                <li><a href="#" onclick="openWin({c:\''.$controller->createAbsoluteUrl('/portal/utentes/admin/id/'.user()->getId()).'\',i:\'people\', r:this})">'.("Ficha Pessoal").'</a></li>
                <li><a href="#" onclick="openWin({c:\''.$controller->createAbsoluteUrl('/portal/notificacoes').'\',i:\'people\', r:this})">'.t("Notificações").'</a></li>
                <li><a href="#" onclick="openWin({c:\''.$controller->createAbsoluteUrl('/portal/mensagens').'\',i:\'people\', r:this})">'.t("Mensagens").'</a></li>
            </ul>
            <ul>
                <li><a href="#" onclick="openWin({c:\''.$controller->createAbsoluteUrl('/portal/utentes').'\',i:\'people\', r:this})">'.t("Utentes").'</a></li>
                <li><a href="#" onclick="openWin({c:\''.$controller->createAbsoluteUrl('/portal/profissionais').'\',i:\'people\', r:this})">'.t("Profissionais").'</a></li>
                <li><a href="#" onclick="openWin({c:\''.$controller->createAbsoluteUrl('/portal/fornecedores').'\',i:\'people\', r:this})">'.t("Fornecedores").'</a></li>
                <li><a href="#" onclick="openWin({c:\''.$controller->createAbsoluteUrl('/portal/locais').'\',i:\'people\', r:this})">'.t("Locais").'</a></li>
                <li><a href="#" onclick="openWin({c:\''.$controller->createAbsoluteUrl('/portal/especialidades').'\',i:\'people\', r:this})">'.t("Especialidades").'</a></li>
                <li><a href="#" onclick="openWin({c:\''.$controller->createAbsoluteUrl('/portal/servicos').'\',i:\'people\', r:this})">'.t("Serviços").'</a></li>
                <li><a href="#" onclick="openWin({c:\''.$controller->createAbsoluteUrl('/portal/entidades').'\',i:\'people\', r:this})">'.t("Entidades").'</a></li>
                <li><a href="#" onclick="openWin({c:\''.$controller->createAbsoluteUrl('/portal/questionarios').'\',i:\'people\', r:this})">'.t("Questionarios").'</a></li>
            </ul>
            <ul>
                <li><a href="">'.t("Listar Serviços").'</a></li>
                <li><a href="#" onclick="openWin({c:\''.$controller->createAbsoluteUrl('/portal/consumiveis').'\',i:\'people\', r:this})">'.t("Consumiveis").'</a></li>
                <li><a href="#" onclick="openWin({c:\''.$controller->createAbsoluteUrl('/portal/equipamentos').'\',i:\'people\', r:this})">'.t("Equipamentos").'</a></li>
            </ul>
            <ul>
                <li><a href="#" onclick="openWin({c:\''.$controller->createAbsoluteUrl('/portal/definicoes').'\',i:\'people\', r:this})">'.t("Definições").'</a></li>
                <li><a href="">'.t("Gráficos").'</a></li>
                <li><a href="">'.t("Relatórios").'</a></li>
            </ul>
        ';
}

function get_utentes_menu($controller)
{
    echo '<ul style="display: block;">
                <li><a href="#" onclick="openWin({c:\''.$controller->createAbsoluteUrl('/portal/utentes/view/id/'.user()->getId()).'\',i:\'people\', r:this})">'.("Ficha Pessoal").'</a></li>
                <li><a href="#" onclick="openWin({c:\''.$controller->createAbsoluteUrl('/portal/notificacoes').'\',i:\'people\', r:this})">'.t("Notificações").'</a></li>
                <li><a href="#" onclick="openWin({c:\''.$controller->createAbsoluteUrl('/portal/mensagens').'\',i:\'people\', r:this})">'.t("Mensagens").'</a></li>
                <li><a href="#" onclick="openWin({c:\''.$controller->createAbsoluteUrl('/portal/documentos').'\',i:\'people\', r:this})">'.t("Documentos").'</a></li>
            </ul>
            <ul>
                <li><a href="">'.t("Listar").'</a></li>
                <li><a href="">'.t("Pedido de Serviço").'</a></li>
            </ul>
            <ul>
                <li><a href="#" onclick="openWin({c:\''.$controller->createAbsoluteUrl('/portal/definicoes').'\',i:\'people\', r:this})">'.t("Definições").'</a></li>
                <li><a href="">'.t("Gráficos").'</a></li>
                <li><a href="">'.t("Relatórios").'</a></li>
            </ul>
        ';
}

function get_medicos_menu($controller)
{
    echo '<ul style="display: block;">
                <li><a href="#" onclick="openWin({c:\''.$controller->createAbsoluteUrl('/portal/profissionais/view/id/'.user()->getId()).'\',i:\'people\', r:this})">'.("Ficha Pessoal").'</a></li>
                <li><a href="#" onclick="openWin({c:\''.$controller->createAbsoluteUrl('/portal/notificacoes').'\',i:\'people\', r:this})">'.t("Notificações").'</a></li>
                <li><a href="#" onclick="openWin({c:\''.$controller->createAbsoluteUrl('/portal/mensagens').'\',i:\'people\', r:this})">'.t("Mensagens").'</a></li>
            </ul>
            <ul>
                <li><a href="">'.t("Minha Agenda").'</a></li>
                <li><a href="">'.t("Serviços").'</a></li>
                <li><a href="">'.t("Meus Utentes").'</a></li>
            </ul>
            <ul>
                <li><a href="#" onclick="openWin({c:\''.$controller->createAbsoluteUrl('/portal/definicoes').'\',i:\'people\', r:this})">'.t("Definições").'</a></li>
                <li><a href="">'.t("Gráficos").'</a></li>
                <li><a href="">'.t("Relatórios").'</a></li>
            </ul>
        ';
}

function get_enfermeiros_menu($controller)
{
    
}

function get_tecnicos_menu($controller)
{
    
}

function get_language_user()
{
    $id_user=user()->getId();
    
    $def=Definicao::model()->find('TAG=:tag', array('tag'=>'LINGUA'));
    
    if($def)
    {
        $def_user=DefinicaoUtilizador::model()->findByPk(array('ID_DEF'=>$def->ID_DEF,'ID_USER'=>$id_user));
        
        if($def_user)
            return $def_user->VALUE;
    }

    return Yii::app()->language;
}

function get_num_new_messages()
{
    $user=user()->getId();
    $mensagens=MensagemUtilizador::model()->findAll('ID_USER=:user and VISTA=0 and APAGADA=0', array('user'=>$user));
    
    $result=count($mensagens);
    return $result;
}