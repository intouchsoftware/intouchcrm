<?php
// *************************************************************************
// *                                                                       *
// * InTouch Software CRM                              *
// * Copyright (c) InTouch Software (Pty) Ltd. All Rights Reserved                      *
// *                                                                       *
// *************************************************************************
// *                                                                       *
// * Email: info@intouchsoft.co.za                                                *
// * Website: https://www.intouchsoft.co.za                                  *
// *                                                                       *
// *************************************************************************
// *                                                                       *
// * This software is furnished under a license and may be used and copied *
// * only  in  accordance  with  the  terms  of such  license and with the *
// * inclusion of the above copyright notice.                       *
// *                                                                       *
// *************************************************************************
class Fsubmit
{

    public static function form($url = '', $params = array())
    {


        $append = '';

        foreach ($params as $param) {
            $append .= '<input type="hidden" name="' . $param['name'] . '" value="' . $param['value'] . '">';
        }


        $x = '<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01//EN" "http://www.w3.org/TR/html4/strict.dtd"><html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8">
<title>Please wait while you\'re redirected</title>
<style type="text/css">

          .heading{height:15px}
          #sysfrm-container{background:#f1f1f1;font-family:Helvetica,Arial,sans-serif}
          #sysfrm-container-container{width:411px;margin:130px auto 0;background:#fff;border:1px solid #b5b5b5;-moz-border-radius:0;-webkit-border-radius:0;border-radius:0;text-align:center}
          #sysfrm-container-container h1{font-size:22px;color:#5f5f5f;font-weight:normal;margin:22px 0 26px 0;padding:0}#sysfrm-container-container p{font-size:13px;color:#454545;margin:0 0 12px 0;padding:0}
          #sysfrm-container-container img{margin:0 0 35px 0;padding:0}.ajaxLoader{margin:80px 153px}.stick-footer .system-footer{position:absolute;bottom:0;width:100%}.login-container .error-msg{margin:0 0 15px 0}
            </style ><script type = "text/javascript" >

function timedText()
{
    setTimeout(\'msg1()\', 2000);
    setTimeout(\'msg2()\', 4000);
  //  setTimeout(\'document.MetaRefreshForm.submit()\',4000);
}

function msg1() {
    document.getElementById(\'msgbox\').firstChild.nodeValue = "Submitting...";
}

function msg2() {
    document.getElementById(\'msgbox\').firstChild.nodeValue = "Redirecting...";
}

</script></head>

<body id="sysfrm-container"  onLoad="document.forms[\'gw\'].submit();">

	<div id="sysfrm-container-container">

		<h1>Please wait while you are redirected</h1>
		<p id="msgbox">Validating...</p>
<script type="text/javascript">timedText()</script>		<img src="sysfrm/uploads/system/fsubmit.gif" alt="...">
	</div>
        <form name="gw" action="' . $url . '" method="POST">
        ' . $append . '
        </form>
        </body>
        </HTML>';


        echo $x;


    }

}
