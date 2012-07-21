<?php

class Bootstrap extends Zend_Application_Bootstrap_Bootstrap
{


    public function _initTranslations()
    {
        $adapter = new Zend_Translate(
            array(
                'adapter' => 'csv',
                'content' => '../languages',
                'scan'    => Zend_Translate::LOCALE_FILENAME,
                'locale'  => 'nl'
            )
        );
        Zend_Registry::set('Zend_Translate', $adapter);
    }

}

