<?php foreach ($entidades as $key => $entidade_servico): ?>

    <tr>
        <td><?php echo Entidade::model()->findByPk($entidade_servico->ID_ENT)->NOME; ?></td>
        <td><?php echo $entidade_servico->VALOR; ?></td>
        <td><?php echo $entidade_servico->COD_SERVICO; ?></td>
        <td><?php echo $entidade_servico->DESIG_SERVICO; ?></td>
        <td><?php echo $entidade_servico->TAXA; ?></td>
        <td><?php echo $entidade_servico->TAXA_URGENT; ?></td>
        <td>
            <?php echo CHtml::button('E', array('class'=>'btn btn-small','onclick'=>'editItem(this,'.$entidade_servico->ID_ENT.','.$entidade_servico->ID_SERV.');')); ?>
            <?php echo CHtml::button('D', array('class'=>'btn btn-small btn-danger','onclick'=>'delItem('.$entidade_servico->ID_ENT.','.$entidade_servico->ID_SERV.');')); ?>
        </td>
    </tr>
        
<?php endforeach; ?>
