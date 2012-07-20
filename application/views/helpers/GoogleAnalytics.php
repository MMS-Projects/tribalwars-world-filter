<?php

class Zend_View_Helper_GoogleAnalytics extends Zend_View_Helper_Abstract
{

    public function googleAnalytics($trackingId = 'UA-33529918-2')
    {
        /*$html = "<script type=\"text/javascript\">";
        $html .= "var _gaq = _gaq || [];";
        $html .= "_gaq.push(['_setAccount', '" . $trackingId . "'])";
        $html .= "_gaq.push(['_trackPageview']);";
        $html .= "(function() {";
        $html .= "var ga = document.createElement('script'); ga.type = 'text/javascript'; ga.async = true;";
        $html .= "ga.src = ('https:' == document.location.protocol ? 'https://ssl' : 'http://www') + '.google-analytics.com/ga.js';";
        $html .= "var s = document.getElementsByTagName('script')[0]; s.parentNode.insertBefore(ga, s);";
        $html .= "})();";
        $html .= "</script>";*/
        $html =  <<<EOT
<script type="text/javascript">

  var _gaq = _gaq || [];
  _gaq.push(['_setAccount', '{$trackingId}']);
  _gaq.push(['_trackPageview']);

  (function() {
    var ga = document.createElement('script'); ga.type = 'text/javascript'; ga.async = true;
    ga.src = ('https:' == document.location.protocol ? 'https://ssl' : 'http://www') + '.google-analytics.com/ga.js';
    var s = document.getElementsByTagName('script')[0]; s.parentNode.insertBefore(ga, s);
  })();

</script>
EOT;
        return $html;
    }
    
}
