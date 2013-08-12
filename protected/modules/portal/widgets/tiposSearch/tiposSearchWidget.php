<?php

class tiposSearchWidget extends CWidget
{
    public $form;
    public $model;
    public $field;
    
    public $items;
    public $ajaxUrl;
    
    public function init()
    {
        // this method is called by CController::beginWidget()

    }
 
    public function run()
    {
        // this method is called by CController::endWidget()
        
        $this->render('index');
    }
}
