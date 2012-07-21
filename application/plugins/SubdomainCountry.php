<?php

class Application_Plugin_SubdomainCountry extends Zend_Controller_Plugin_Abstract
{

    public function routeShutdown(Zend_Controller_Request_Abstract $request)
    {
        preg_match(
            '/^(?P<country>[a-z]{2})\./', $_SERVER['HTTP_HOST'], $matches
        );
        if (isset($matches[0])) {
            // Detect country
            $country = $matches['country'];
            // Detect the locale based on the country
            $locale = Zend_Locale::getLocaleToTerritory(strtoupper($country));
            // Set the locale based on the country
            Zend_Registry::get("Zend_Locale")->setLocale($locale);
            // Detect the language of the current locale
            $language = Zend_Registry::get("Zend_Locale")->getLanguage();
            // Set the language to the current locale
            Zend_Registry::get("Zend_Translate")->setLocale($language);
            
            Zend_Locale_Format::setOptions(array(
                'locale' => Zend_Registry::get("Zend_Locale")
            ));
        }
    }


}
