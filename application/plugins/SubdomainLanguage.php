<?php

class Application_Plugin_SubdomainLanguage extends Zend_Controller_Plugin_Abstract
{

    public function routeShutdown(Zend_Controller_Request_Abstract $request)
    {
        preg_match('/^(?P<lang>[a-z]{2})\./', $_SERVER['HTTP_HOST'], $matches);
        if (isset($matches[0])) {
            Zend_Registry::get("Zend_Translate")->setLocale($matches['lang']);
        }
    }


}
