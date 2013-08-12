<?php
class LanguageMenuWidget extends CWidget {
 
 
    public function run() {
        
        $idiomas= Idioma::model()->findAll();
        
        $this->render('language_menu_widget',array('idiomas'=>$idiomas));
    }
 
}
