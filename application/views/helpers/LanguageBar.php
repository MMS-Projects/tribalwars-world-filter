<?php

class Zend_View_Helper_LanguageBar extends Zend_View_Helper_Placeholder_Container_Standalone
{

    public function languageBar(array $countries)
    {
        preg_match(
            '/^((?P<country>[a-z]{2})\.)?(?P<domain>.*)$/', $_SERVER['HTTP_HOST'],
            $matches
        );
        list($domain, $country) = array($matches['domain'], $matches['country']);
        
        $html = '<ul class="language-bar">';
        foreach ($countries as $country) {
            $url = sprintf(
                'http://%s.%s%s', $country, $domain, $this->view->url()
            );
            $flag = sprintf(
                'http://%s/flags/%s.gif', $domain, $country
            );
            $html .= sprintf(
                '<li><a href="%s"><img src="%s"> %s</a></li>', $url, $flag,
                $country
            );
        }
        $html .= '</ul>';
        return $html;
        
        //if (isset($matches[0])) {
    }
    
}
