<?php

/* If they don't have a logo, don't bother.. */
/*if (isset($org_logo) && $org_logo) {
    /* Display width and height like good little people */
 /*   $width_and_height = '';
    if (isset($org_logo_width) && is_numeric($org_logo_width) &&
     $org_logo_width>0) {
        $width_and_height = " width=\"$org_logo_width\"";
    }
    if (isset($org_logo_height) && is_numeric($org_logo_height) &&
     $org_logo_height>0) {
        $width_and_height .= " height=\"$org_logo_height\"";
    }
}
/*
echo html_tag( 'table',
    html_tag( 'tr',
        html_tag( 'td',
            '<center>'.
            ( isset($org_logo) && $org_logo
              ? '<img src="' . $org_logo . '" alt="' .
                sprintf(_("%s Logo"), $org_name) .'"' . $width_and_height .
                ' /><br />' . "\n"
              : '' ).
            ( (isset($hide_sm_attributions) && $hide_sm_attributions) ? '' :
            '<small>' . sprintf (_("SquirrelMail version %s"), $version) . '<br />' ."\n".
            '  ' . _("By the SquirrelMail Project Team") . '<br /></small>' . "\n" ) .
            html_tag( 'table',
                html_tag( 'tr',
                    html_tag( 'td',
                        '<b>' . sprintf (_("%s Login"), $org_name) . "</b>\n",
                    'center', $color[0] )
                ) .
                html_tag( 'tr',
                    html_tag( 'td',  "\n" .
                        html_tag( 'table',
                            html_tag( 'tr',
                                html_tag( 'td',
                                    _("Name:") ,
                                'right', '', 'width="30%"' ) .
                                html_tag( 'td',
				    addInput($username_form_name, $loginname_value, 0, 0, ' onfocus="alreadyFocused=true;"'),
                                'left', '', 'width="70%"' )
                                ) . "\n" .
                            html_tag( 'tr',
                                html_tag( 'td',
                                    _("Password:") ,
                                'right', '', 'width="30%"' ) .
                                html_tag( 'td',
				    addPwField($password_form_name, null, ' onfocus="alreadyFocused=true;"').
				    addHidden('js_autodetect_results', SMPREF_JS_OFF).
                    $mailtofield . 
				    addHidden('just_logged_in', '1'),
                                'left', '', 'width="70%"' )
                            ) ,
                        'center', $color[4], 'border="0" width="100%"' ) ,
                    'left',$color[4] )
                ) . 
                html_tag( 'tr',
                    html_tag( 'td',
                        '<center>'. addSubmit(_("Login")) .'</center>',
                    'left' )
                ),
            '', $color[4], 'border="0" width="350"' ) . '</center>',
        'center' )
    ) ,
'', $color[4], 'border="0" cellspacing="0" cellpadding="0" width="100%"' );
do_hook('login_form');
echo '</form>' . "\n";
*/
?>
<style type="text/css">
<!--
body {

	text-align: center;

	margin: 0;

	padding: 0;

	background-color:#FFFFFF;

	font-family: Verdana, Lucida, Helvetica;

}

#container {

	background-image:    url(../images/bg.png);

	background-repeat: no-repeat;

	background-attachment: scroll;

	background-position: center left;

	margin: 8em auto;

	width: 474px;

	height: 273px;

	position: relative;

}

/* #logo {

	width: 140px;

	height: 78px;

	background-image: url(../images/<? echo "$org_logo" ?>);

	position: absolute;

	top: 120px;

	left: 40px;

}
*/
#copyright {

	color: #666666;

	width: 290px;

	height: 77px;

	position: absolute;

	top: 140px;

	left: -150px;

}

h1 {

	text-align: right;

	font-size: .9em;

	color: #0066CC;

	width: 375px;

	margin: 65px 20px 0px 0px;
	
	position: absolute;

	top: 0px;

	left: 40px;

}

h2 {

	color: #666666;
		
	text-align: right;

	font-size: .6em;

	margin: 15px 30px;
	
	position: absolute;

	top: 90px;

	left: 170px;

}

fieldset {

	width: 200px;

	margin: 0 auto auto 190px;

	text-align: left;

	border: none;

	position: absolute;

	top: 100px;

	left: 10px;

}

p.1, p.2, p.3 {

	font-size: .7em;

	color: #6D6D6D;

	vertical-align: super;


}

p.1 {
	color: #666666;
	margin: 0px 0 0 0;

}

p.2, p.3 {

	margin: 3px 0 0 0;
	color: #6D6D6D;

}
p.4 {

	margin: 3px 0px 0px 0px;
	text-decoration: none;


}

.input {

	margin: 0px 12px 0px 7px;

	height: 16px;

	width: 200px;

	border: 1px solid #CCCCCC;

	font-size: 11px;

	vertical-align: middle;
	text-align:left;
	float:left;

}

.button {

	width: 93px;

	height: 16px;

	background-color: #6BABFC;

	color: #ffffff;

	border: none;

	font-weight: bold;

	font-size: 9px;

	margin: 0px 12px 0 0;

}

p.logout {

	font-size: .7em;

	font-weight: bold;

	text-transform: uppercase;

	color: #0066CC;

	margin: 3em 2em 0 15em;

}


-->
</style>


<div id="container"> 
  <h1>WebMail Login</h1>
  <div id="logo"></div>
  
  <fieldset>
  <font size="2" color="#666666">username:<input  class="input"type="text" name="<?=$username_form_name?>" VALUE="" size='34' tabindex="1"></font><br />
  <font size="2" color="#666666">password:<input name="<?=$password_form_name;?>" type="password" class="input" tabindex="2"></font>
 <p class="3"> 
    <input name="button" type="submit" value="login" class="button">
  </p>
    <input type=hidden name="js_autodetect_results" value="SMPREF_JS_OFF">
  <input type=hidden name="just_logged_in" value=1>
  <p class="3">    </p> 
<div id="copyright"> 
<font size="1" color="#CCCCCC">Designed by NutsMail Modified by <a href="http://www.amperonline.com" target="_blank" style="text-decoration: none;"><font color="#CCCCCC">amperonline.com</font></a></font></div>
  </fieldset>
</div>
</form>
</body></html>
