<?php

class Zend_View_Helper_CommunityBar extends Zend_View_Helper_Placeholder_Container_Standalone
{

    public function communityBar(array $communities)
    {
        preg_match(
            '/^((?P<community>[a-z]{2,3})\.)?(?P<domain>.*)$/', $_SERVER['HTTP_HOST'],
            $matches
        );
        list($domain, $country) = array($matches['domain'], $matches['community']);
        
        $html = '<ul class="language-bar">';
        foreach ($communities as $community) {
            $url = sprintf(
                'http://%s.%s%s', $community->tag, $domain, $this->view->url()
            );
            $paddingLeft = 16 + (($community->spritePlace - 1) * 32);
            $html .= sprintf(
                '<li style="background:url(http://gamebar.innogames.de/sprite.png) no-repeat 0px -%dpx; padding-left: 20px;"><a href="%s">%s</a></li>', $paddingLeft, $url,
                $community->tag
            );
        }
        $html .= '</ul>';
        return $html;
    }
    
}
