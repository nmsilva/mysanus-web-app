<?php

// uncomment the following to define a path alias
// Yii::setPathOfAlias('local','path/to/local-folder');

// This is the main Web application configuration. Any writable
// CWebApplication properties can be configured here.
return array(
	'basePath'=>dirname(__FILE__).DIRECTORY_SEPARATOR.'..',
	'name'=>'MySanus',
	'sourceLanguage'=>'pt',

	// preloading 'log' component
	'preload'=>array(
		'log',
		'bootstrap', // preload the bootstrap component
                'translate',
	),
    
	'aliases' => array(
		'xupload' => 'ext.xupload'
	),
    
	// autoloading model and component classes
	'import'=>array(
		'application.models.*',
                'application.models.forms.*',
                'application.models.cms.*',
		'application.components.*',
		//Translate Module
                'application.modules.translate.TranslateModule',
                'application.modules.translate.controllers.*',
                'application.modules.translate.models.*',
                // Extensions
                'ext.Randomness.Randomness',
                'ext.helpers.XHtml',
	),

	'modules'=>array(
		'translate'=>array(
                        'class'=>'application.modules.translate.TranslateModule',
                ),
		'cms'=> array(),
		'portal'=> array(
                    'defaultController' => 'home',
                ),
		'site'=> array(
                    'defaultController' => 'front',
                ),
		// uncomment the following to enable the Gii tool
		'gii'=>array(
			'class'=>'system.gii.GiiModule',
			'password'=>'12345',
			// If removed, Gii defaults to localhost only. Edit carefully to taste.
			'ipFilters'=>array('127.0.0.1','::1'),
			'generatorPaths'=>array(
                            'bootstrap.gii',
                        ),
		),
	),

	// application components
	'components'=>array(
            'image'=>array(    
                'class'=>'application.extensions.image.CImageComponent',           
                'driver'=>'GD',
            ),

            'user'=>array(
                // enable cookie-based authentication
                'allowAutoLogin'=>true,
                // this is actually the default value
                'loginUrl'=>array('/site'),
                'authTimeout'=>3600
            ),
            
            // UserCounter
            'counter' => array(
                'class' => 'ext.usercounter.UserCounter',
            ),
            
            // uncomment the following to enable URLs in path-format
            'urlManager'=>array(
                    'class'=>'application.components.UrlManager',
                    'urlFormat'=>'path',
                    'showScriptName'=>false,
                    'rules'=>array(
                            '<lang:(pt|en|fr|es)>/' => 'site/front',
                            '<lang:(pt|en|fr|es)>/<module:\w+>/<controller:\w+>/<id:\d+>'=>'<module>/<controller>/view',
                            '<lang:(pt|en|fr|es)>/<module:\w+>/<controller:\w+>/<action:\w+>/<id:\d+>'=>'<module>/<controller>/<action>',
                            '<lang:(pt|en|fr|es)>/<module:\w+>/<controller:\w+>/<action:\w+>/*'=>'<module>/<controller>/<action>',
                    ),
            ),

            'bootstrap'=>array(
                'class'=>'ext.bootstrap.components.Bootstrap', // assuming you extracted bootstrap under extensions
	    ),
            	    
            // uncomment the following to use a MySQL database

//            'db_cms'=>array(
//                    'class' => 'CDbConnection',
//                    'connectionString' => 'mysql:host=mysanus.pt;dbname=s001442_mysanus_content',
//                    'emulatePrepare' => true,
//                    'username' => 's001442_mysanus',
//                    'password' => 'c6HDG5=EEvQ(',
//                    'charset' => 'utf8',
//            ),
//            
//            'db_portal'=>array(
//                    'class' => 'CDbConnection',
//                    'connectionString' => 'mysql:host=mysanus.pt;dbname=s001442_mysanus_portal',
//                    'emulatePrepare' => true,
//                    'username' => 's001442_mysanus',
//                    'password' => 'c6HDG5=EEvQ(',
//                    'charset' => 'utf8',
//            ),
//            
//            'db'=>array(
//                    'connectionString' => 'mysql:host=mysanus.pt;dbname=s001442_mysanus_portal_content',
//                    'emulatePrepare' => true,
//                    'username' => 's001442_mysanus',
//                    'password' => 'c6HDG5=EEvQ(',
//                    'charset' => 'utf8',
//            ),

            'db_cms'=>array(
                    'class' => 'CDbConnection',
                    'connectionString' => 'mysql:host=localhost;dbname=mysanus_cms',
                    'emulatePrepare' => true,
                    'username' => 'root',
                    'password' => '',
                    'charset' => 'utf8',
            ),
            
            'db_portal'=>array(
                    'class' => 'CDbConnection',
                    'connectionString' => 'mysql:host=localhost;dbname=mysanus_portal',
                    'emulatePrepare' => true,
                    'username' => 'root',
                    'password' => '',
                    'charset' => 'utf8',
            ),
            
            'db'=>array(
                    'connectionString' => 'mysql:host=localhost;dbname=mysanus_translate',
                    'emulatePrepare' => true,
                    'username' => 'root',
                    'password' => '',
                    'charset' => 'utf8',
            ),
            
            'errorHandler'=>array(
                    // use 'site/error' action to display errors
                    'errorAction'=>'app/error',
            ),
            'log'=>array(
                    'class'=>'CLogRouter',
                    'routes'=>array(
                            array(
                                    'class'=>'CFileLogRoute',
                                    'levels'=>'error, warning',
                                    'enabled'=>true,
                            ),
                            // uncomment the following to show log messages on web pages
                            /*
                            array(
                                    'class'=>'CWebLogRoute',
                            ),
                            */
                    ),
            ),

            // Use Message in Database and Translate Components
            'messages'=>array(
                'class'=>'CDbMessageSource',
                'connectionID'=>'db',
                'sourceMessageTable'=>'sourcemessage',
                'translatedMessageTable'=>'message',
                'onMissingTranslation' => array('TranslateModule', 'missingTranslation'),
            ),
            
            'translate'=>array(//if you name your component something else change TranslateModule
                'class'=>'translate.components.MPTranslate',
                //any avaliable options here
                'acceptedLanguages'=>array(
                      'pt'=>'Português',
                      'en'=>'English',
                      'es'=>'Español'
                ),
            ),
	),

	// application-level parameters that can be accessed
	// using Yii::app()->params['paramName']
	'params'=>array(
		// this is used in contact page
		'adminEmail'=>'webmaster@example.com',
	),
);