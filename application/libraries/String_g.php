<?php
if(!defined("BASEPATH")) exit("No direct script acces allowed");

class String_g
{
    function aprintf($array)
    {
        echo("<pre>");
        print_r($array);
        echo("</pre>");
    }
    function popupmsg($msg)
    {
        print<<<HTML
    <script>
        alert('{$msg}');
    </script>
HTML;

    }
    function popupmsg_exit($msg)
    {
        print<<<HTML
    <script>
        alert('{$msg}');
    </script>
HTML;
        exit;
    }
    function popupmsg_redirect($msg, $redirect)
    {
        print<<<HTML
    <script>
        alert('{$msg}');
        window.location='{$redirect}';
    </script>
HTML;
        exit;
    }
    function redirecty($redirect)
    {
        print<<<HTML
    <script>
        window.location='{$redirect}';
    </script>
HTML;
        exit;
    }
}

