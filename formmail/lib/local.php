<?php
// -------------------------------------------------------------------------------------------
function	commonHeader( $title = "" ){
?>
<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.0 Transitional//EN">

<html>
<head>
	<title><? print( SITE_TITLE . ( $title ? " | $title" : "" ) ); ?></title>
	<link rel='stylesheet' type='text/css' href='form.css'>
	<meta name="keywords" content="PHP FormMail Generator, phpFormMailGen, Customize Forms, phpFormMailGenerator,formmail.php, formmail.pl, formMail Generator, PHP, Generator, Backend Tool, phpFormGen, phpFormGenerator, anti-spam, web hosting">
	<meta name="description" content="PHP formMail Generator - A tool to ceate ready-to-use web forms in a flash">
</head>

<body bottommargin="10" leftmargin="10" topmargin="10" rightmargin="10">

<!-- -------------------------- Menu -------------------------------------  -->
<table cellspacing="0" cellpadding="0" border="0" width="100%" height="25"	bgcolor="#8ac428" background="pics/menubg.gif">
	<tr>
		<td width="6" valign="top"><img src="pics/conner_left.gif" width="6" height="7" alt="" border="0"></td>
		<td valign="middle" >

			<!--  ----------------  Menu Table  ---------------- -->
			<table cellpadding="0" cellspacing="0" border="0" height=19>
				<tr>
					<td width=60 class="menu_bg" background="pics/bg_menuitem_off.gif"><font class="menu_text"><a href="home.php">Home</a></font></td>
					<td width="1" bgcolor="#8ac428"><img src="pics/blank.gif" border=0 width=1 height=1></td>
					<td width=60  class="menu_bg" background="pics/bg_menuitem_off.gif" ><font class="menu_text"><a href="generator.php">Demo</a></font></td>
					<td width="1" bgcolor="#8ac428"><img src="pics/blank.gif" border=0 width=1 height=1></td>
					<td width=150  class="menu_bg" background="pics/bg_menuitem_off.gif" ><font class="menu_text"><a href="demo.google.php">Sample of Google</a></font></td>
					<td width="1" bgcolor="#8ac428"><img src="pics/blank.gif" border=0 width=1 height=1></td>
					<td  width=80 class="menu_bg" background="pics/bg_menuitem_off.gif" nowrap><font class="menu_text"><a href="download.php">Download</a></font></td>
					<td width="1" bgcolor="#8ac428"><img src="pics/blank.gif" border=0 width=1 height=1></td>
					<td  width=120 class="menu_bg" background="pics/bg_menuitem_off.gif" nowrap><font class="menu_text"><a href="documentation.php">Documentation</a></font></td>
					<td width="1" bgcolor="#8ac428"><img src="pics/blank.gif" border=0 width=1 height=1></td>
					<td  width=180 class="menu_bg" background="pics/bg_menuitem_off.gif" nowrap><font class="menu_text"><a href="licensing_services.php">Licensing & Services</a></font></td>
					<td width="1" bgcolor="#8ac428"><img src="pics/blank.gif" border=0 width=1 height=1></td>
					<td  width=80 class="menu_bg" background="pics/bg_menuitem_off.gif" nowrap><font class="menu_text"><a href="contact.php">Contacts</a></font></td>
				</tr>
			</table>

		</td>
	</tr>
</table>

<table class="box" width="100%" cellspacing="0" cellpadding="0"  >
	<tr>
		<td>
			<!--  ----------------  Main Content Table  ---------------- -->
			<br><br>
<?
}


// -------------------------------------------------------------------------------------------
function	commonFooter(){
?>
			<br><br>
			<!--  ----------------  End: Main Content Table  ---------------- -->
		</td>
	</tr>
</table>

<br><br>
<table cellpadding='10' cellspacing='10' border='0' width="90%" align="center">
	<tr>
		<td><a href="http://sourceforge.net" target="_blank"><img src="pics/logo/sourceforge.gif"  border="0" alt="SourceForge.net Logo" /></a></td>
		<td><a href="http://www.php.net" target="_blank"><img src="pics/logo/php.gif" border=0 alt="My Favority Language"></a></td>
		<td><a href="http://www.mysql.org" target="_blank"><img src="pics/logo/mysql.gif" border=0 alt="The Best Open Source Database"></a></td>
		<td><a href="http://www.apache.org" target="_blank"><img src="pics/logo/apache.gif" border=0 alt="The Best Web Server"></a></td>
		<td><a href="http://www.google.com" target="_blank"><img src="pics/logo/google.gif" border=0 alt="The Best Search Engine"></a></td>
	</tr>
</table>

<hr size=1 style='color:#ff0000'>
<div class="copyright"><? print SITE_COPY_RIGHT;?></div>
<br><br>



</body>
</html>
<?
}


// -------------------------------------------------------------------------------------------
function	errMsg( $err = "" )
{
	print "<font class='form_error'><b>$err</b></b>" ;
}

// -----------------------------------------------------------------------------
// ---- Begin Class : phpForm ----
class	phpForm
{
	var	$nField = 10;
	var $FieldCount = 0;
	var	$value_sperator = "\|" ;
	var $field_sperator = "\t" ;
	var $field_required_sperator = "|" ;
	var $newliner = "<!--esh_newline-->" ; // replace \r\n with $newliner ;
	var $newtaber = "<!--esh_newtaber-->" ; // replace \t with $newtaber ;
		
	var $uuid = "" ; //md5( uniqid( srand( time() ) ) );  // id of FormMail 
	var $sIniFile = "phpformmail.ini" ;
	var $sFormMailHTMLFile = "" ;
	var $sSocketIniFile = "phpformmail.socket.ini" ;
	var $sPath = "ini/" ;
	var $sPHPFile ;
	var $sPHPLib  ;  
	var $sUsageLogFile = "usinglog.php";
	
	var $tpl_path = "/template/" ;
	var $html_header_tpl = "html_header.html" ;
	var $html_footer_tpl = "html_footer.html" ;
	var $php_header_tpl = "html_header.html" ;
	var $php_footer_tpl = "html_footer.html" ;
	var $php_common_tpl = "common.php" ;
	var $define_tpl = "define.php" ;
	
	var $action = "http://www.yourname.com/formmail.php" ;
	
	var $aFormMailFields = array( 
													"esh_formmail_domainname" => "", 
													"esh_formmail_description" => "",
													"esh_formmail_field_nums"  => "10" , 
													"esh_formmail_recipient" => "", 
													"esh_formmail_subject" => "",
													"esh_formmail_filename" => "myform.html" ,
													"esh_formmail_redirect" => "thankyou.html" ,
													"esh_formmail_return_msg" => "",
													"esh_formmail_return_subject" => "",
													
													"esh_formmail_mail_and_file" => "MailOnly",
													"esh_formmail_save_record_file" => "",
													"esh_formmail_charset" => "iso-8859-1",
													"esh_form_layout" => "One Column",
												 );

	var $aFieldType = array( /*"Sender's Name", */ "Sender's email", "Generic email", "Text", "Radio", "CheckBox", "Select", "TextArea" ,  "Attachment", "Password", "CreditCard(MM-YYYY)", "CreditCard#", "Date(MM-DD-YYYY)", "Date(MM-YYYY)", "Time(HH:MM:SS)", "Time(HH:MM)"  );
	var	$aRequired = array( "Not Required", "Required" );
	var	$aIni = array();
/*	
	var $from = "online.submit@yourname.com" ;
	var	$mailto = "raymond@lynx.net" ;
	var	$thanks_url  = "" ;
	var $charset = "iso-8859-1" ;
	var	$layout = "One Column" ;
	var $subject = "Online Form Submit" ;
	
	var $whattodo = "MailOnly" ;
	var $tofile = "" ;
*/
	function	phpForm( $sUUID = "" )
	{
		if( $sUUID ) $this->uuid = $sUUID ;
		if( ! $this->uuid ) $this->uuid = getMD5FileName() ;
		$this->sPath = FORMMAIL_INI_PATH ;
		$this->init();
	}
	
	function	init(){
		$this->sIniFile = $this->sPath . $this->uuid . ".ini" ;
		$this->sSocketIniFile = $this->sPath . $this->uuid . ".socket.ini" ;
		$this->sFormMailHTMLFile = $this->sPath . $this->uuid . ".html" ;

		$this->sPHPFile = $this->sPath . $this->uuid . ".php" ;
		$this->sPHPLib = $this->sPath . $this->uuid . ".lib.php" ;  
		$this->sUsageLogFile = $this->sPath . "bak/usagelog.php" ;
		
		$tpl_path = DOCUMENT_ROOT . $this->tpl_path ;
		$this->html_header_tpl =  $tpl_path . "html_header.html" ;
		$this->html_footer_tpl = $tpl_path . "html_footer.html" ;
		$this->php_header_tpl = $tpl_path . "html_header.html" ;
		$this->php_footer_tpl = $tpl_path . "html_footer.html" ;
		$this->php_common_tpl = $tpl_path . "common.php" ;
		$this->define_tpl = $tpl_path . "define.php" ;
	}
	
	// --------- User Interface ---------------
	function	faq( $part = "" ){
		//return "&nbsp;(<a href=\"#\" onclick=\"javascript:faq('$part');return false;\">?</a>)&nbsp;" ;
	}

	function	displaySetup()
	{
		$this->readIni() ;
		$bgcolor = "#f4f6e5;" ;
		print "\n\n<form name=\"frmSetup\" action=\"" . getEnv( "SCRIPT_NAME" ) ."\" method=\"post\">\n" ;
		print "<input type=\"hidden\" name=\"submited\" value=\"Y\">\n" ;
		print "<input type=\"hidden\" name=\"formmail_action\" value=\"\">\n" ;
		print "<input type=\"hidden\" name=\"uuid\" value=\"" . $this->uuid . "\">\n" ;
		print "<input type=\"hidden\" name=\"esh_formmail_field_nums\" value=\"" . htmlSpecialChars($this->aFormMailFields["esh_formmail_field_nums"]) . "\">\n" ;
		print "<input type=\"hidden\" name=\"esh_formmail_domainname\" value=\"" . htmlSpecialChars($this->aFormMailFields["esh_formmail_domainname"]) . "\">\n" ;
		print "<input type='hidden' name='esh_formmail_more_fields' value='0'>\n\n";  //use javascript to check this value
		
		$sTextBoxStyle = " size=18 style='width:180px;background-color:$bgcolor'" ;
		print "<table width='90%' align='center' border=0 bordercolor='#bbbbbb' ><tr><td>\n\n" ;
		
		print "<table border=0 width='98%' align='center'>\n" ;

		print "<tr><td colspan=7 bgcolor='#ffffcf' class='form_title'><font color='red'>Step 1 :</font> Define Your Form Elements</td></tr>\n" ;
		
		print "<tr><td colspan=7>\n<table border=0 width='100%' >\n" ;
		print "<tr valign='top'><td  class='formmail_field' width='150' >Direct&nbsp;All&nbsp;Emails&nbsp;to:" . $this->faq("recipient" ) . "</td><td class='formmail_text'><input type='text' name='esh_formmail_recipient' value=\""  . htmlSpecialChars($this->aFormMailFields["esh_formmail_recipient"]). "\" $sTextBoxStyle></td><td  class='formmail_field'  rowspan=2 >Description:" . $this->faq("description" ) . "</td><td class='formmail_text' rowspan=2 width='100%'><textarea name='esh_formmail_description'  wrap='off' cols=40 rows=3 class='formmail_text' style=\"width:100%;height:80px;background-color:$bgcolor\">" . htmlSpecialChars( $this->aFormMailFields[ "esh_formmail_description" ] ) . "</textarea></td></tr>\n" ;
		print "<tr valign='top'><td  class='formmail_field' width='150'>Subject:" . $this->faq("subject" ) . "</td><td class='formmail_text'><input type='text' name='esh_formmail_subject' value=\""  . htmlSpecialChars($this->aFormMailFields["esh_formmail_subject"]). "\" $sTextBoxStyle></td></tr>\n" ;
		print "</table></td></tr>\n\n" ;
		

		print "<tr><td colspan=7><hr size=1 style='color:#ff0000'></td></tr>\n\n" ;
		print "<tr>\n" .
				 "<td class='formmail_field'>&nbsp;</td>\n" .
		         "<td class='formmail_field'>Display Text :" . $this->faq("displaytext" ) . "</td>\n" .
				 "<td class='formmail_field'>Variable Name:</td>\n".
				 "<td class='formmail_field'>Data Type :" . $this->faq("datatype" ) . "</td>\n".
				 "<td class='formmail_field' width='10'>&nbsp;</td>\n" .
				 "<td class='formmail_field'>Data Value(s) : " . $this->faq("datavalue" ) . "<font color='#FF0000'>*</font></td>\n" .
				 "<td class='formmail_field' width='20' align='center'>Required" . $this->faq("required" ) . "</td>\n" .
				 "</tr>\n\n" ;

		$sTextBoxFieldStyle = " size=18 style='width:180px;background-color:$bgcolor'" ;
		for( $i = 0; $i < $this->nField; $i ++ ){
			print "<tr>\n" .
					 "<td class='formmail_text' align=right><b>" . ($i+1) . ".</b></td>\n" .
			         "<td class='formmail_text'><input type=\"text\" name=\"field_text" . $i . "\" value=\"" . HtmlSpecialChars( $this->aIni[ $i ][ "field_text" ] ) .  "\" onchange=\"document.frmSetup.field_name" . $i . ".value=txt2name( this.value );\" class='formmail_text' $sTextBoxFieldStyle></td>\n" .
			         "<td class='formmail_text'><input type=\"text\" name=\"field_name" . $i . "\" value=\"" . HtmlSpecialChars( $this->aIni[ $i ][ "field_name" ] ) .  "\" class='formmail_text' onchange=\"isNameExist( this.value );\"  $sTextBoxFieldStyle></td>\n" .
			         "<td class='formmail_text'>" . $this->displayTypeSelection( "field_type" . $i ,  $this->aIni[ $i ][ "field_type" ] )  .  "</td>\n" .
 					 "<td class='formmail_field' width='10'><a href=\"javascript:void(0)\" onclick=\"listBuilder('$i');\">+</a></td>\n" .
			         "<td class='formmail_text'><input type=\"text\" name=\"field_value" . $i . "\" value=\"" . HtmlSpecialChars( $this->aIni[ $i ][ "field_value" ] ) .  "\" class='formmail_text' $sTextBoxFieldStyle></td>\n" .
			         "<td class='formmail_text'>" . $this->displayRequiredSelection( "field_required" . $i ,  $this->aIni[ $i ][ "field_required" ] )  .    "</td>\n" .
					 "</tr>\n\n" ;
		};
		print "<tr><td>&nbsp;</td><td class='formmail_text'><a href='#' onclick=\"javascript:submit_formmail('addmore');return false;\">Add 5 More Fields</a></td><td colspan=3>&nbsp;</td><td class='formmail_text'><font color='#FF0000'>* Please use the symbol | to separate each variable</font>" . $this->faq("datavalue" ) . " </td><td class='formmail_text' >&nbsp;</td></tr>\n\n" ;
		//print "<tr><td colspan=6 class='formmail_text' align='right'>Not engout fields, I want to  add more <select name='esh_formmail_more_fields'><option value=0 selected>0</option><option value=5>5</option></select> fields</td></tr>\n" ;
		//print "<tr><td colspan=4 class='formmail_text' align='right'>&nbsp;</td><td class='formmail_text'><font color='#FF0000'>* Please use the symbol | to separate each variable</font> </td><td class='formmail_text' >&nbsp;</td></tr>\n" ;
		//print "<tr><td colspan=5 class='formmail_text' align='right'><b>Not engout fields, I want to  add more 5 fields.--></b> </td><td class='formmail_text' ><input type='checkbox' name='esh_formmail_more_fields' value='5'></td></tr>\n" ;

		//$sBtnPreview = "<a href='#' onclick=\"submit_formmail('preview');return false;\">Preview</a>";
		print "<tr><td colspan=7 bgcolor='#ffffcf' class='form_title'><font color='red'>Step 2 :</font> Define Your Mail Auto Response Message (Optional)</td></tr>\n\n" ;
		print "<tr><td colspan=7>\n\n<table border=0 width='100%' >\n" ;
		print "<tr valign='top'><td  class='formmail_field' width='150'>Message&nbsp;Subject:" . $this->faq("messagesubject" ) . "</td><td  class='formmail_text'><input type='text' name='esh_formmail_return_subject' value=\""  . HtmlSpecialChars($this->aFormMailFields["esh_formmail_return_subject"]). "\" $sTextBoxStyle ></td></tr>\n\n" ;
		print "<tr valign='top'><td  class='formmail_field'>Message:" . $this->faq("message" ) . "</td><td  class='formmail_text'><textarea name='esh_formmail_return_msg'  wrap='off' cols=40 rows=3 class='formmail_text' style=\"width:300px;height:80px;background-color:$bgcolor\">" . htmlSpecialChars( $this->newline_back($this->aFormMailFields[ "esh_formmail_return_msg" ]) ) . "</textarea></td ><td rowspan=2 align='center' valign='middle' >$sBtnPreview</td></tr>\n\n" ;
		print "</table>\n\n</td></tr>\n\n" ;

		//$sBtnGenerate = "<input type='button' value='Generate' onclick=\"submit_formmail('preview');\">" ;
		print "<tr><td colspan=7 class='form_title' align=center><br><br></td></tr>\n" ;
		print "<tr><td colspan=7 bgcolor='#ffffcf' class='form_title'><font color='red'>Step 3 :</font> Save Submit Form Data to A Text File (Optional)</td></tr>\n" ;
		print "<tr><td colspan=7>\n<table border=0 width='100%' >\n" ;
		print "<tr valign='top'><td  class='formmail_field' width='150'>File&nbsp;Name:" . $this->faq("filename" ) . "</td><td  class='formmail_text'><input type='text' name='esh_formmail_save_record_file' value=\""  . HtmlSpecialChars($this->aFormMailFields["esh_formmail_save_record_file"]). "\" $sTextBoxStyle><br><i>(Digit or letter only, and no space in between.)</i></td><td align='center' valign='middle' >$sBtnGenerate</td></tr>\n" ;
		print "</table></td></tr>\n" ;

		print "<tr><td colspan=7 class='form_title' align=center><br><br></td></tr>\n" ;
		print "<tr><td colspan=7 class='form_title' align=center><input type='button' value='Generate' onclick=\"submit_formmail('generate');\"> &nbsp;&nbsp; &nbsp;&nbsp; <input type='button' value='Cancel' onclick=\"location.href='home.php';\"></td></tr>\n" ;

/*
		$sBtnPublish = $this->aFormMailFields["esh_formmail_domainname"] ? "<a href='#' onclick=\"javascript:submit_formmail('publish');return false;\">Publish</a>"
		                                                                                                  : "<a href='#' onclick=\"alert('Sorry, You are using Demo Version.');return false;\">Publish</a>" ;
		print "<tr><td colspan=7 class='form_title' align=center><br><br></td></tr>\n" ;
		print "<tr><td colspan=7 bgcolor='#e5e5e5' class='form_title'><font color='red'>Step 3 :</font> Define Your File</td></tr>\n" ;
		print "<tr><td colspan=7>\n<table border=0 width='100%' >\n" ;
		print "<tr valign='top'><td  class='formmail_field' width='150'>File&nbsp;Name:" . $this->faq("filename" ) . "</td><td  class='formmail_text'><input type='text' name='esh_formmail_filename' value=\""  . HtmlSpecialChars($this->aFormMailFields["esh_formmail_filename"]). "\" $sTextBoxStyle><br><i>(Digit or letter only, and no space in between.)</i></td><td align='center' valign='middle' >$sBtnPublish</td></tr>\n" ;
		print "<tr><td colspan=3><hr size=1 style='color:#ff0000'></td></tr>\n" ;
		print "<tr valign='top'><td colspan=3><font class=\"form_text\"><b><a href=\"#\" onclick=\"javascript:tell_friend();return false;\">Tell your friend</a> about this great FormMail Generator(No login required).</b></td></tr>\n" ;
		print "</table></td></tr>\n" ;
*/


		print "</table>\n" ;
		
		print "\n\n</td></tr></table>\n\n" ;
		print "</form>\n\n" ;
		return $i ;	
	}

	function	displayTypeSelection( $name, $selectedValue )
	{
		$s =  "\n<select name=\"$name\" class='form_text' style='background-color:#f4f6e5;'>\n" ;
		for( $i = 0; $i < count( $this->aFieldType ); $i ++ ){
			$selected = trim(strtolower( $this->aFieldType[ $i ] )) == trim(strtolower( $selectedValue )) ? " selected " : "" ;
			$s .= "<option value=\"" . HtmlSpecialChars( $this->aFieldType[ $i ] ) . "\" $selected >" . $this->aFieldType[ $i ] . "</option>\n" ;
		}
		$s .= "</select>\n" ;
		return  $s ;
	}

	function	displayRequiredSelection( $name, $selectedValue )
	{
		$selected = (trim(strtolower( $selectedValue )) == "required") ? " checked " : "" ;
		$s = "<input type=\"checkbox\" name=\"$name\" value=\"Required\" $selected >\n" ;
		return $s ;
	}


	// --------- Read Config ---------------
	function	readIni()
	{
		if( ! is_file( $this->sIniFile ) ) return ;
		
		$iniLine = file( $this->sIniFile );
		$nCount = 0 ;
		while( list( $lineNum, $line ) = each( $iniLine ) ){
				$aField = spliti(  $this->field_sperator, chop($line) );

				$bFound = false ;
				foreach( $this->aFormMailFields as $key => $value ){
					if( strtolower($key) == strtolower($aField[ 0 ]) ){
						$this->aFormMailFields[ $key ] = $this->newline_back($aField[ 1 ]);
						$bFound = true;
						break;
					}
				}

				if( !$bFound ){
					$this->aIni[ $nCount ][ "field_text" ] = $this->newline_back($aField[ 0 ]); // $field_text ;
					$this->aIni[ $nCount ][ "field_name" ] = $this->newline_back($aField[ 1 ]); //$field_name ;
					$this->aIni[ $nCount ][ "field_type" ] = $this->newline_back($aField[ 2 ]); //$field_type ;
					$this->aIni[ $nCount ][ "field_value" ] = $this->newline_back($aField[ 3 ]); //$field_value ;
					$this->aIni[ $nCount ][ "field_required" ] = $this->newline_back($aField[ 4 ]); //$field_required ;
					$nCount ++;
				}

		} // while
		$this->FieldCount = $nCount;
		if( $this->aFormMailFields["esh_formmail_field_nums"] > $this->nField ) $this->nField = $this->aFormMailFields["esh_formmail_field_nums"] ;
		if( !$this->aFormMailFields["esh_formmail_filename"] ) $this->aFormMailFields["esh_formmail_filename"] = "myform.html";
	}
	
	
	// --------- Save Config ---------------
	function	saveIni( $post ) // $HTTP_POST_VARS
	{
		$nElement = 0 ;
		$hFile = fopen( $this->sIniFile, "w" );
		if( $hFile ){
			$post[ "esh_formmail_field_nums" ] = ( $post[ "esh_formmail_field_nums" ] > 0 ) ? $post[ "esh_formmail_field_nums" ] += $post[ "esh_formmail_more_fields" ] : $this->nField ;
			$this->nField = $post[ "esh_formmail_field_nums" ] ;
			//print $post[ "esh_formmail_field_nums" ] . "MOR=" . $post[ "esh_formmail_more_fields" ] ;
			foreach( $this->aFormMailFields as $key => $value ){
				$line = $key . $this->field_sperator  . $this->remove_newline($post[ $key ]) . "\n" ;
				fputs( $hFile, gpc($line) );  // handle slashes
				$nElement ++ ;
			}
		
			for( $i = 0; $i < $this->nField; $i ++ ){
				$field_text = $this->remove_newline( $post[ "field_text" . $i ]  );
				$field_name = $this->remove_newline( $post[ "field_name"  . $i ] ) ;
				$field_type = $this->remove_newline(  $post[ "field_type"  . $i ] ) ;
				$field_value = $this->remove_newline( $post[ "field_value" . $i ] ) ;
				$field_required = $this->remove_newline(  $post[ "field_required" . $i ] );
				if( strlen(trim( $field_text )) ){
					$line = $field_text . $this->field_sperator . 
								$field_name . $this->field_sperator . 
								//$field_text . $this->field_sperator .  /* we use the display text for field's name */
								$field_type . $this->field_sperator . 
								$field_value . $this->field_sperator .
								$field_required . "\n" ;
					fputs( $hFile, gpc($line) );  // handle slashes
					$nElement ++ ;
				} // if
			} //for
		
			fclose( $hFile );
		} // if
		return $nElement ;
	}

	function	ini2html()
	{
		$this->readIni() ;

		$tab = "\t" ;
		$bIsTwo = ( $this->layout == "Two Column" ) && ( $this->FieldCount > 1 ) ;
		$nStartSecond = Floor( $this->FieldCount / 2 ) ;
		$hFile = fopen( $this->sFormMailHTMLFile, "w" );
		if( $hFile ){
			fputs( $hFile, readFile2Str( $this->html_header_tpl ) );
			$description = $this->newline_back($this->aFormMailFields[ "esh_formmail_description" ]) ;
			$description = preg_match( "/<[\/\!]*?[^<>]*?>/i", $description ) ? $description : "<font class='form_title'>" . nl2br( $description ) . "</font>";
			fputs( $hFile, "\r\n\r\n<!-- ------------------------ Begin: Your FormMail's Description  ------------------------ -->\r\n\r\n<br><br><br><table cellspacing='16' cellpadding='0' border='0' align='center' ><tr><td>\r\n\r\n" . $description . "\r\n\r\n</td></tr></table>\r\n\r\n<!-- ------------------------ End: Your FormMail's Description  ------------------------ -->\r\n\r\n"  );
	
			fputs( $hFile, "\r\n\r\n\r\n\r\n<!-- =======================  Begin: Dont't Change The Following Code ======================= -->\r\n\r\n\r\n\r\n" );
			fputs( $hFile, "\r\n<form name=\"frmFormMail\" action=\"" . $this->action . "\" method='post' enctype='multipart/form-data'>\r\n" );
			fputs( $hFile, "<script language=\"JavaScript\" src=\"http://cgi01.eseehosting.com/cgi-bin/key.pl\"></script>\r\n" );
			
			fputs( $hFile, "\r\n<table cellspacing='16' cellpadding='0' border='0' align='center' >\r\n"  );
			if( $bIsTwo ) fputs( $hFile, "$tab<tr>\r\n" . str_repeat( $tab, 2 ) . "<td valign='top'>\r\n" . str_repeat( $tab, 3 ) . "<!-- ---------------- Begin :: Left Column ------------------ -->\r\n" );

			for( $i = 0; $i < count( $this->aIni ); $i ++ ){
				$field_type = strtolower( $this->aIni[ $i ][ "field_type" ] );
				$field_text = htmlSpecialChars( $this->aIni[ $i ][ "field_text" ] );
				$field_name = htmlSpecialChars( $this->aIni[ $i ][ "field_name" ] );
				$field_value = htmlSpecialChars( $this->aIni[ $i ][ "field_value" ] );
				$field_required = $this->aIni[ $i ][ "field_required" ] ;
				$aValue = split( "\|", $field_value );

				$s = "" ;
				$red_star = " <font size='2' color='#ff0000'>*</font> " ;
				$star = ( $field_required == "Required" ) ?  $red_star : "" ;
				switch( $field_type  ){
					case strtolower("CreditCard#"):
								$hidden_required = ($field_required == "Required") ? $hidden_required . $field_name .$this->field_required_sperator : "" ;
								$s = " <input type=\"$field_type\" maxlength=16 name=\"$field_name\"  value=\"$field_value\" class='text_box'> " ;
								break;
					case strtolower("Sender's Name") :
								if( $field_required == "Required") :
									$hidden_required = $hidden_required . "realname" .$this->field_required_sperator;
									$hidden_realname_text = "<input type='hidden' name='esh_formmail_realname_text' value=\"" . $field_text  . "\" >\r\n" ; // show the original text for formmail's required error message.
								endif;
								$s = "<input type=\"text\" name=\"realname\"  value=\"$field_value\" class='text_box'> " ;
								break;
					case strtolower("Sender's email") :
								if( $field_required == "Required") :
									$hidden_required =  $hidden_required .  "email" .$this->field_required_sperator ;
									$hidden_email_text = "<input type='hidden' name='esh_formmail_email_text' value=\"" . $field_text  . "\" >\r\n" ; // show the original text for formmail's required error message.
								endif;
								$s = "<input type=\"text\" name=\"email\"  value=\"$field_value\" class='text_box'> " ;
								break;
					case	"text" :
								if ($field_required == "Required")  $hidden_required .= $field_name .$this->field_required_sperator  ;
								$s = "<input type=\"$field_type\" name=\"$field_name\"  value=\"$field_value\" class='text_box'> " ;
								break;
					case	"attachment" :
								if ($field_required == "Required")  $hidden_required .= $field_name .$this->field_required_sperator  ;
								$s = "<input type=\"file\" name=\"$field_name\"  value=\"$field_value\" class='text_box'> " ;
								break;
					case 	"textarea" :
								if ($field_required == "Required")  $hidden_required .= $field_name .$this->field_required_sperator  ;
								$s = " <textarea name=\"$field_name\"  cols=19 rows=4 class='text_area'>$field_value</textarea> " ;
								break;
					case	"checkbox" :
								for( $j = 0; $j < count( $aValue ); $j ++ ) {
									$new_field_name = "[Checkbox" . substr("00".($j+1), strlen("00".($j+1))-2,2) . "]" . $field_name ;
									if ($field_required == "Required")  $hidden_required .= $new_field_name .$this->field_required_sperator  ;
									$s .= "<input type=\"$field_type\" name=\"$new_field_name\"  value=\"" . $aValue[ $j ]  . "\"  > " . $aValue[ $j ] . "<br>\r\n" ;
								}
								break;
					case 	"radio" :
								if ($field_required == "Required")  $hidden_required .= $field_name .$this->field_required_sperator  ;
								for( $j = 0; $j < count( $aValue ); $j ++ ) 
									$s .= "<input type=\"$field_type\" name=\"$field_name\"  value=\"" . $aValue[ $j ]  . "\"  > " . $aValue[ $j ] . "<br>\r\n" ;
								break;
					case 	"select" :
								if ($field_required == "Required")  $hidden_required .= $field_name .$this->field_required_sperator  ;
								for( $j = 0; $j < count( $aValue ); $j ++ ) 
									$s .= "<option  value=\"" . $aValue[ $j ]  . "\" > " .$aValue[ $j ] . "\r\n" ;
								$s = "<select name=\"$field_name\"  class='text_select' >\r\n<option value=''>- Select -</option>\r\n " . $s . "</select> " ;
								break;

				} // switch

				if( $s ) {
					$sIndent = "\r\n" . str_repeat( $tab, 2 ) ;
					$tr_begin = $tab ."<tr>$sIndent<td class=\"form_field\" valign='top'>$field_text </td><td width='10'  aligh='right' valign='top'>$star</td>$sIndent<td class=\"form_text\">\r\n" ;
					$tr_end = "$sIndent</td>\r\n$tab</tr>\r\n\r\n" ;
					$s = $tr_begin . $s . $tr_end ;
					if( $bIsTwo ){
						if( $i == 0  ) fputs( $hFile, "\r\n<table width='100%' cellspacing='1' cellpadding='1' border='0' >\r\n"  );
						if( $i == $nStartSecond ) {
							fputs( $hFile, "\r\n</table>\r\n" . str_repeat( $tab, 2 ) . "<!-- ---------------- End :: Left Column ------------------ -->\r\n" . str_repeat( $tab, 2 ) . "</td>\r\n\r\n" );
							fputs( $hFile, str_repeat( $tab, 2 ) . "<td valign='top'>\r\n" . str_repeat( $tab, 3 ) . "<!-- ---------------- Begin :: Right Column ------------------ -->\r\n" );
							fputs( $hFile, "\r\n<table width='100%' cellspacing='1' cellpadding='1' border='0' >\r\n"  );
						}
					}
					fputs( $hFile, $s );
				}

			}; // for 
			
			if( $bIsTwo ) fputs( $hFile, "\r\n</table>\r\n" . str_repeat( $tab, 2 ) . "<!-- ---------------- End :: Right Column ------------------ -->\r\n" . str_repeat( $tab, 2 ) . "</td>\r\n$tab</tr>\r\n\r\n" );
			fputs( $hFile, "\r\n" . $tab . "<tr><td colspan=3 align='center'><input type='reset' value='Reset'> &nbsp;&nbsp; <input type='submit' value='Submit'></td></tr>" );

			fputs( $hFile, "\r\n</table>\r\n\r\n" );

			fputs( $hFile, "<input type='hidden' name='recipient' value=\"" . htmlSpecialChars($this->aFormMailFields[ "esh_formmail_recipient" ]) . "\">\r\n" );
			fputs( $hFile, "<input type='hidden' name='subject' value=\"" . htmlSpecialChars($this->aFormMailFields[ "esh_formmail_subject" ]) . "\">\r\n" );
			fputs( $hFile, "<input type='hidden' name='esh_formmail_return_msg' value=\"" . htmlSpecialChars($this->aFormMailFields[ "esh_formmail_return_msg" ]) . "\">\r\n" );
			$hidden_required = substr($hidden_required, 0, strlen($hidden_required)-strlen($this->field_sperator) ) ;
			//if( $hidden_required ) fputs( $hFile, $hidden_realname_text . $hidden_email_text . "<input type='hidden' name='required' value=\"" . $hidden_required . "\" >\r\n" );
			fputs( $hFile, $hidden_realname_text . $hidden_email_text . "<input type='hidden' name='required' value=\"" . $hidden_required . "\" >\r\n" );
			fputs( $hFile, "\r\n</form>\r\n\r\n" );
			fputs( $hFile, "\r\n\r\n\r\n\r\n<!-- =======================  End: Dont't Change The Following Code ======================= -->\r\n\r\n\r\n\r\n" );

			fputs( $hFile, readFile2Str( $this->html_footer_tpl ) );
			fclose( $hFile );
			return true ;
		};// if( $hFile )

		return false;
	}

	function	txt2name( $s )
	{
		$patterns = array( "/ +/" );
		$replace   = array( "_" );
		return preg_replace( $patterns, $replace, $s );
	}
	
	function	remove_newline( $str = "" ){
		$str = ereg_replace( "\t", $this->newtaber, $str );
		$str = ereg_replace( "\r\n", $this->newliner, $str );
		return ereg_replace( "\n", $this->newliner, $str );
	}
	
	function	remove_newline_for_fields( $str = "" ){
		$str = ereg_replace( "\t", "", $str );
		$str = ereg_replace( "\r\n", "", $str ) ;
		return trim(ereg_replace( "\n", "", $str ));
	}

	function	newline_back( $str = "" ){
		$str = ereg_replace( $this->newtaber, "\t", $str );
		return ereg_replace( $this->newliner, "\r\n", $str );
	}
	
	function	createSocketIni(){
		$hFile = fopen( $this->sSocketIniFile, "w" );
		$nBytes = 0;
		if( $hFile ):
			$sIni = "SOCKET_CMD = create_formmail" . "\n" .
			            "domainname = " . $this->aFormMailFields[ "esh_formmail_domainname" ]. "\n" .
			            "filename = " . $this->aFormMailFields[ "esh_formmail_filename" ]. "\n" .
			            "datafile = "  . $this->remove_newline( readFile2Str($this->sFormMailHTMLFile) ) . "\n" .
			            "SOCKET_DATA_END = 1" . "\n" ;
			$nBytes = fputs( $hFile, $sIni );
			fclose( $hFile );
		endif;
		return $nBytes ;
	}
	
	function	formmail_full_url(){
		return "http://www." . $this->aFormMailFields[ "esh_formmail_domainname" ] . "/" . $this->aFormMailFields[ "esh_formmail_filename" ] ;
	}
	
	function	formmail_preview_html_url(){
		//return ereg_replace( DOCUMENT_ROOT ."/"  , "", $this->sFormMailHTMLFile ); // fail on Win32
		$start = strlen(DOCUMENT_ROOT)+1 ;
		return substr( $this->sFormMailHTMLFile, $start, strlen($this->sFormMailHTMLFile)-$start );
	}

	function	formmail_preview_php_url(){
		//return ereg_replace( DOCUMENT_ROOT ."/" , "", $this->sPHPFile ); // fail on Win32
		$start = strlen(DOCUMENT_ROOT)+1 ;
		return substr( $this->sPHPFile, $start, strlen($this->sPHPFile)-$start );
	}

	function	cleanup_after_published(){
		$sRenName = $this->sPath . $this->aFormMailFields[ "esh_formmail_domainname" ] . "." . date("YmdHis") ;
		$sPublishedIni = $sRenName . ".ini" ;
		//$sPublishedSocketIniFile = $sRenName . ".socket.ini" ;
		//$$sPublishedFormMailHTMLFile = $sRenName . ".html" ;
		if( rename( $this->sIniFile, $sPublishedIni ) ) {
			unlink( $this->sSocketIniFile ) ;
			unlink( $this->sFormMailHTMLFile ) ;
		}
	}

	function	delExpiryFiles(){
		$nPeriod = 180 ; // half year
		$nExpiryDays = mktime( 0,0,0, date("m"), date("d")-$nPeriod, date("Y") ) ; // get $nPeriod days ago's timestamp
		
		$sFCTempPath = $this->sPath ;
		$oDir = dir( $sFCTempPath );
		while( $entry = $oDir->read() ) :
			if( ! ( ($entry == ".") || ($entry == "..") ) ):
				clearstatcache();
				$filename = $sFCTempPath . $entry ;
				$bExpiry = date( "Ymd", $nExpiryDays ) > date( "Ymd" , filectime( $filename ) ) ;
				if( $bExpiry && ! is_dir( $filename ) ) unlink( $filename );
			endif;
			//print $filename . " = " . date( "Ymd", $nExpiryDays ) . "<br>\n";
		endwhile;
		$oDir->close();
	}
	
	function	usageLog(){
		$hFile = fopen( $this->sUsageLogFile, "a+" );
		if( $hFile ):
			$line = date( "Ymd" ) . "\t" . $this->uuid . 
			                                   "\t" . $this->aFormMailFields[ "esh_formmail_field_nums" ] . 
			                                   "\t" . $this->aFormMailFields[ "esh_formmail_recipient" ] .
			                                   "\t" . $this->aFormMailFields[ "esh_formmail_subject" ] . 
			                                   "\t" . $this->aFormMailFields[ "esh_formmail_return_subject" ] . 
			                                   "\t" . $this->aFormMailFields[ "esh_formmail_save_record_file" ] . 
			                                   "\t" . getEnv("REMOTE_ADDR") . 
											   "\t" . getEnv("HTTP_USER_AGENT" ) ;
			$nBytes = fputs( $hFile, $line . "\r\n" );
			fclose( $hFile );
			return $nBytes;
		endif;
		return 0;
	}


	// --------- Crete PHP Files ---------------
	function	ini2php()
	{
		$this->readIni() ;
		$this->delExpiryFiles() ;
		$ok =  $this->ini2php_form() &&	$this->ini2php_lib();
		if( $ok ) $this->usageLog();
		return $ok ;
	}
	
	function	ini2php_lib()
	{
		$hFile = fopen( $this->sPHPLib, "w" );
		if( $hFile ){
			fputs( $hFile, readFile2Str( $this->define_tpl ) );
			fputs( $hFile, "<?php\n" );			

			$sCombine = "" ;
			fputs( $hFile, "// --- Array of Form Elements ---\n" );
			for( $i = 0; $i < count( $this->aIni ); $i ++ ){
				$field_type = stripslashes( strtolower( $this->aIni[ $i ][ "field_type" ] ) ); // add stripslashes() for Win32, otherwise "Sender's email" fail
				//$field_type = strtolower( $this->aIni[ $i ][ "field_type" ] );
				$field_text = $this->aIni[ $i ][ "field_text" ] ;
				$field_name = $this->aIni[ $i ][ "field_name" ] ;
				$field_value = $this->aIni[ $i ][ "field_value" ] ;
				$field_required = $this->aIni[ $i ][ "field_required" ] ;
				$aValue = split( "\|", $field_value );

				$line = "\$form_mail[] = array( \"name\" => \"$field_name\", \"text\" => \"" . addslashes( $field_text ) . "\",  \"type\" => \"$field_type\", \"required\" => \"$field_required\" ) ;\n" ;
				fputs( $hFile, $line );

				switch( $field_type  ){
					case strtolower("Sender's email"):
							$bFrom = true;
							$sender_email = "\$HTTP_POST_VARS[ \"" . $field_name . "\" ]" ;
							break;
					case strtolower("Date(MM-DD-YYYY)"):
								$sCombine .= " \$HTTP_POST_VARS[ \"$field_name\" ] = ( \$HTTP_POST_VARS[ \"". $field_name . "_YYYY\" ] && \$HTTP_POST_VARS[ \"". $field_name . "_MM\" ] && \$HTTP_POST_VARS[ \"". $field_name . "_DD\" ] ) \n" . 
								                      "                                                          ?  \$HTTP_POST_VARS[ \"". $field_name . "_YYYY\" ] . \"-\" .  \$HTTP_POST_VARS[ \"". $field_name . "_MM\" ]  . \"-\" .  \$HTTP_POST_VARS[ \"". $field_name . "_DD\" ]\n"  .
													  "                                                          : \"\" ;\n" ;
								break;
					case strtolower("CreditCard(MM-YYYY)"):
					case strtolower("Date(MM-YYYY)"):
								$sCombine .= " \$HTTP_POST_VARS[ \"$field_name\" ] = ( \$HTTP_POST_VARS[ \"". $field_name . "_YYYY\" ] && \$HTTP_POST_VARS[ \"". $field_name . "_MM\" ]  ) \n" . 
								                      "                                                          ?  \$HTTP_POST_VARS[ \"". $field_name . "_YYYY\" ] . \"-\" .  \$HTTP_POST_VARS[ \"". $field_name . "_MM\" ] \n"  .
													  "                                                          : \"\" ;\n" ;
								break;
					case strtolower("Time(HH:MM:SS)"):
								$sCombine .= " \$HTTP_POST_VARS[ \"$field_name\" ] = ( \$HTTP_POST_VARS[ \"". $field_name . "_HH\" ] && \$HTTP_POST_VARS[ \"". $field_name . "_MM\" ] && \$HTTP_POST_VARS[ \"". $field_name . "_SS\" ] ) \n" .
								                      "                                                          ? \$HTTP_POST_VARS[ \"". $field_name . "_HH\" ] . \":\" .  \$HTTP_POST_VARS[ \"". $field_name . "_MM\" ] . \":\" . \$HTTP_POST_VARS[ \"". $field_name . "_SS\" ]\n" .
													  "                                                          : \"\" ;\n" ;
								break;
					case strtolower("Time(HH:MM)"):
								$sCombine .= " \$HTTP_POST_VARS[ \"$field_name\" ] = ( \$HTTP_POST_VARS[ \"". $field_name . "_HH\" ] && \$HTTP_POST_VARS[ \"". $field_name . "_MM\" ] ) \n" .
								                      "                                                          ? \$HTTP_POST_VARS[ \"". $field_name . "_HH\" ] . \":\" .  \$HTTP_POST_VARS[ \"". $field_name . "_MM\" ]\n" .
													  "                                                          : \"\" ;\n" ;
								break;

					case	"checkbox" :
								if( count( $aValue ) ):
									$sCombine .= "\$" . $field_name . " = array();\n" ;
									for( $j = 0; $j < count( $aValue ); $j ++ ) {
										$new_field_name = "Checkbox" . substr("00".($j+1), strlen("00".($j+1))-2,2) . "_" . $field_name ;
										$sCombine .= "\$" . $field_name . "[$j]=\$HTTP_POST_VARS[ \"$new_field_name\"];\n" ;
									}
									 $sCombine .= "\$HTTP_POST_VARS[ \"$field_name\" ] = join( \"\\n\", \$" . $field_name . ");\n\n" ;
								endif;
								break;
				} // switch
				
			}; // for 
			
			if( $sCombine ) fputs( $hFile, "\n\n// -- Create new vars for checkPass() & sendFormMail() --\n" . $sCombine . "\n\n" ) ;
			
			$savefile = $this->aFormMailFields["esh_formmail_save_record_file"];
			fputs( $hFile,
"
// -- Detech Submit & SendMail -- 
\$isHideForm = false;
if( \$HTTP_POST_VARS[\"formmail_submit\"] ){
	\$sErr = checkPass();
	if( ! \$sErr ){
		sendFormMail( \$form_mail, \"$savefile\") ;
		\$isHideForm = true;
		
		\$redirect = \"" . $this->aFormMailFields["esh_formmail_redirect"] . "\";
		if( strlen(trim(\$redirect)) ):
			header( \"Location:\$redirect\" );
			exit;
		endif;
	}
}

" );

			fputs( $hFile, "\n?>\n" );
			fputs( $hFile, readFile2Str( $this->php_common_tpl ) );
			fclose( $hFile );
			return true;
		};// if( $hFile )
		return false;
	}
	
	function	ini2php_form()
	{
		$tab = "\t" ;
		$bIsTwo = ( $this->layout == "Two Column" ) && ( $this->FieldCount > 1 ) ;
		$nStartSecond = Floor( $this->FieldCount / 2 ) ;
		$hFile = fopen( $this->sPHPFile, "w" );
		if( $hFile ){
			fputs( $hFile, "<?php 	include_once( \"" . basename($this->sPHPLib) . "\" ); ?>\n" );
			fputs( $hFile, readFile2Str( $this->php_header_tpl ) );
			fputs( $hFile, "\n<meta http-equiv=\"content-type\" content=\"text/html; charset=" . $this->charset . "\">\n" ) ;
			$description = $this->newline_back($this->aFormMailFields[ "esh_formmail_description" ]) ;
			$description = preg_match( "/<[\/\!]*?[^<>]*?>/i", $description ) ? $description : "<font class='form_title'>" . nl2br( $description ) . "</font>";
			fputs( $hFile, "\r\n\r\n<!-- ------------------------ Begin: Your FormMail's Description  ------------------------ -->\r\n\r\n<br><br><br>\n<table cellspacing='16' cellpadding='0' border='0' align='center' ><tr><td>\r\n\r\n" . $description . "\r\n\r\n</td></tr></table>\r\n\r\n<!-- ------------------------ End: Your FormMail's Description  ------------------------ -->\r\n\r\n"  );
	
			fputs( $hFile, "\r\n\r\n\r\n\r\n<!-- =======================  Begin: Form Generated By PHP FormMail Generator ======================= -->\r\n\r\n\r\n\r\n" );

			fputs( $hFile, "<?php\n	if( !\$isHideForm ): \n		global \$sErr ;\n		if( \$sErr ) print \"<br><a name='error'></a><center><font class='form_error' >\$sErr</font></center><br>\"; \n\n		\$starColor = \$sErr ? \"#ff0000\" : \"#000000\";\n		\$style=\" class='form_text' \";\n ?>\n" );
			fputs( $hFile, "\n<form name=\"frmFormMail\" action=\"<?php print PHP_SELF ?>\" method='post' enctype='multipart/form-data'>\n" );
			fputs( $hFile, "<input type='hidden' name='formmail_submit' value='Y'>\n" );
			
			fputs( $hFile, "<input type='hidden' name='esh_formmail_recipient' value=\"" . htmlSpecialChars($this->aFormMailFields[ "esh_formmail_recipient" ]) . "\">\r\n" );
			fputs( $hFile, "<input type='hidden' name='esh_formmail_subject' value=\"" . htmlSpecialChars($this->aFormMailFields[ "esh_formmail_subject" ]) . "\">\r\n" );
			fputs( $hFile, "<input type='hidden' name='esh_formmail_cc' value=\"" . htmlSpecialChars($this->aFormMailFields[ "esh_formmail_cc" ]) . "\">\r\n" );
			fputs( $hFile, "<input type='hidden' name='esh_formmail_bcc' value=\"" . htmlSpecialChars($this->aFormMailFields[ "esh_formmail_bcc" ]) . "\">\r\n" );
			
			fputs( $hFile, "<input type='hidden' name='esh_formmail_return_subject' value=\"" . htmlSpecialChars($this->aFormMailFields[ "esh_formmail_return_subject" ]) . "\">\r\n" );
			fputs( $hFile, "<input type='hidden' name='esh_formmail_return_msg' value=\"" . htmlSpecialChars($this->aFormMailFields[ "esh_formmail_return_msg" ]) . "\">\r\n" );
			fputs( $hFile, "<input type='hidden' name='esh_formmail_mail_and_file' value=\"" . htmlSpecialChars($this->aFormMailFields[ "esh_formmail_mail_and_file" ]) . "\">\r\n" );
			// remove it. we don't want the file to be downloaded.
			//fputs( $hFile, "<input type='hidden' name='esh_formmail_save_record_file' value=\"" . htmlSpecialChars($this->aFormMailFields[ "esh_formmail_save_record_file" ]) . "\">\r\n" );
			fputs( $hFile, "<input type='hidden' name='esh_formmail_charset' value=\"" . htmlSpecialChars($this->aFormMailFields[ "esh_formmail_charset" ]) . "\">\r\n" );
			
			fputs( $hFile, "\r\n<table cellspacing='16' cellpadding='0' border='0'  >\r\n"  );
			if( $bIsTwo ) fputs( $hFile, "$tab<tr>\n" . str_repeat( $tab, 2 ) . "<td valign='top'>\n" . str_repeat( $tab, 3 ) . "<!-- ---------------- Begin :: Left Column ------------------ -->\n" );

			for( $i = 0; $i < count( $this->aIni ); $i ++ ){
				$field_type = stripslashes( strtolower( $this->aIni[ $i ][ "field_type" ] ) ); // add stripslashes() for Win32, otherwise "Sender's email" fail
				$field_text = htmlSpecialChars( $this->aIni[ $i ][ "field_text" ] );
				$field_name = htmlSpecialChars( $this->aIni[ $i ][ "field_name" ] );
				$field_value = htmlSpecialChars( $this->aIni[ $i ][ "field_value" ] );
				$field_required = $this->aIni[ $i ][ "field_required" ] ;
				$aValue = split( "\|", $field_value );

				$s = "" ;
				$red_star = " <font size='2' color='#ff0000'>*</font> " ;
				$star = ( $field_required == "Required" ) ?  $red_star : "" ;
				$sIndent = "\n" . str_repeat( $tab, 2 ) ;
				switch( $field_type  ){
					case strtolower("Generic email"):
					case strtolower("Sender's email"):
							$s = "<input type=\"$field_type\" name=\"$field_name\"  value=\"<?php  print HtmlSpecialChars( \$HTTP_POST_VARS[ \"$field_name\" ] ); ?>\" class='text_box'>" ;
							break;
					case strtolower("Password"):
							$s = "<input type=\"password\" name=\"$field_name\"  value=\"<?php  print HtmlSpecialChars( \$HTTP_POST_VARS[ \"$field_name\" ] ); ?>\" class='text_box'>" ;
							break;
					case strtolower("CreditCard#"):
								$s = "<input type=\"$field_type\" maxlength=16 name=\"$field_name\"  value=\"<?php  print HtmlSpecialChars( \$HTTP_POST_VARS[ \"$field_name\" ] ); ?>\" class='text_box'>" ;
								break;
					case	"text" :
								$s = "<input type=\"$field_type\" name=\"$field_name\"  value=\"<?php  print HtmlSpecialChars( \$HTTP_POST_VARS[ \"$field_name\" ] ); ?>\" class='text_box'>" ;
								break;
					case	"attachment" :
								$s = "<input type=\"file\" name=\"$field_name\"  value=\"\" class='text_box'>" ;
								break;
					case 	"textarea" :
								$s = "<textarea name=\"$field_name\" rows=4 cols=25 ><?php  print HtmlSpecialChars( \$HTTP_POST_VARS[ \"$field_name\" ] ); ?></textarea>\n" ;
								break;
					case	"checkbox" :
								for( $j = 0; $j < count( $aValue ); $j ++ ) {
									$new_field_name = "Checkbox" . substr("00".($j+1), strlen("00".($j+1))-2,2) . "_" . $field_name ;
									$s .= "<input type=\"$field_type\" name=\"$new_field_name\"  value=\"" . $aValue[ $j ] . "\"  <?php  formChecked( \$HTTP_POST_VARS[ \"$new_field_name\" ], \"" . $aValue[ $j ] . "\" ); ?> > " . $aValue[ $j ] . "<br>\r\n" ;
								}
								break;
					case 	"radio" :
								for( $j = 0; $j < count( $aValue ); $j ++ ) 
									$s .= "<input type=\"$field_type\" name=\"$field_name\"  value=\"" . $aValue[ $j ] . "\"  <?php  formChecked( \$HTTP_POST_VARS[ \"$field_name\" ], \"" . $aValue[ $j ] . "\" ); ?> > " . $aValue[ $j ] . "<br>\r\n" ;
								break;
					case 	"select" :
								//$func = ( "radio" == $field_type ) ? " checked" : " selected" ;
								for( $j = 0; $j < count( $aValue ); $j ++ ) 
									$s .= "<option  value=\"" . $aValue[ $j ] . "\"  <?php  formSelected( \$HTTP_POST_VARS[ \"$field_name\" ], \"" . $aValue[ $j ] . "\" ); ?> > " . $aValue[ $j ] . "\n" ;
								$s = "<select name=\"$field_name\" <? print \$style; ?>>\n<option value=''>- Select -</option>\n " . $s . "</select>\n" ;
								break;
					case strtolower("Date(MM-DD-YYYY)"):
								$s = "<?php \n" .
										"selectList( \"" . $field_name . "_MM\", \$HTTP_POST_VARS[\"" . $field_name . "_MM\"], 1, 12, \"MM\", \$style ) ;\n" .
										"selectList( \"" . $field_name . "_DD\", \$HTTP_POST_VARS[\"" . $field_name . "_DD\"], 1, 31, \"DD\", \$style ) ;\n" .
										"selectList( \"" . $field_name . "_YYYY\", \$HTTP_POST_VARS[\"" . $field_name . "_YYYY\"], date(\"Y\"), date(\"Y\")+3, \"YYYY\", \$style ) ;\n" .
										"?>\n" ;
								break;
					case strtolower("CreditCard(MM-YYYY)"):
					case strtolower("Date(MM-YYYY)"):
								$s = $tab ."<?php \n" .
										"selectList( \"" . $field_name . "_MM\", \$HTTP_POST_VARS[\"" . $field_name . "_MM\"], 1, 12, \"MM\", \$style ) ;\n" .
										"selectList( \"" . $field_name . "_YYYY\", \$HTTP_POST_VARS[\"" . $field_name . "_YYYY\"], date(\"Y\"), date(\"Y\")+3, \"YYYY\", \$style ) ;\n" .
										"?>\n" ;
								break;
					case strtolower("Time(HH:MM:SS)"):
								$s = "<?php \n" .
										"selectList( \"" . $field_name . "_HH\", \$HTTP_POST_VARS[\"" . $field_name . "_HH\"], 0, 23, \"HH\", \$style ) ;\n" .
										"selectList( \"" . $field_name . "_MM\", \$HTTP_POST_VARS[\"" . $field_name . "_MM\"], 0, 59, \"MM\", \$style ) ;\n" .
										"selectList( \"" . $field_name . "_SS\", \$HTTP_POST_VARS[\"" . $field_name . "_SS\"], 0, 59, \"SS\", \$style ) ;\n" .
										"?>\n" ;
								break;
					case strtolower("Time(HH:MM)"):
								$s = "<?php \n" .
										"selectList( \"" . $field_name . "_HH\", \$HTTP_POST_VARS[\"" . $field_name . "_HH\"], 0, 23, \"HH\", \$style ) ;\n" .
										"selectList( \"" . $field_name . "_MM\", \$HTTP_POST_VARS[\"" . $field_name . "_MM\"], 0, 59, \"MM\", \$style ) ;\n" .
										"?>\n" ;
								break;
				} // switch

				if( $s ) {
					$sIndent = "\r\n" . str_repeat( $tab, 2 ) ;
					$tr_begin = $tab ."<tr>$sIndent<td class=\"form_field\" valign='top' align='right'>$field_text </td><td width='10'  aligh='right' valign='top'>$star</td>$sIndent<td class=\"form_text\">\r\n" ;
					$tr_end = "$sIndent</td>\r\n$tab</tr>\r\n\r\n" ;
					$s = $tr_begin . $s . $tr_end ;
					if( $bIsTwo ){
						if( $i == 0  ) fputs( $hFile, "\r\n<table width='100%' cellspacing='1' cellpadding='1' border='0' >\r\n"  );
						if( $i == $nStartSecond ) {
							fputs( $hFile, "\r\n</table>\r\n" . str_repeat( $tab, 2 ) . "<!-- ---------------- End :: Left Column ------------------ -->\r\n" . str_repeat( $tab, 2 ) . "</td>\r\n\r\n" );
							fputs( $hFile, str_repeat( $tab, 2 ) . "<td valign='top'>\r\n" . str_repeat( $tab, 3 ) . "<!-- ---------------- Begin :: Right Column ------------------ -->\r\n" );
							fputs( $hFile, "\r\n<table width='100%' cellspacing='1' cellpadding='1' border='0' >\r\n"  );
						}
					}
					fputs( $hFile, $s );
				}

			}; // for 
			
			if( $bIsTwo ) fputs( $hFile, "\r\n</table>\r\n" . str_repeat( $tab, 2 ) . "<!-- ---------------- End :: Right Column ------------------ -->\r\n" . str_repeat( $tab, 2 ) . "</td>\r\n$tab</tr>\r\n\r\n" );
			fputs( $hFile, "\r\n" . $tab . "<tr><td colspan=3 align='center'><input type='submit' value='Submit'> &nbsp;&nbsp; <input type='button' value='Cancel' onclick=\"location.href='/';\"></td></tr>" );

			fputs( $hFile, "\r\n</table>\r\n\r\n" );
			fputs( $hFile, "\n</form>\n" );
			fputs( $hFile, "\r\n\r\n\r\n\r\n<!-- =======================  End:  ======================= -->\r\n\r\n\r\n\r\n" );
			fputs( $hFile, "<?php\n		if( \$sErr ) print \"<script language='javascript' type='text/javascript'>location.href='#error';</script>\";;; \n
else: //!\$isHideForm
	print( \"<br><br><hr><center><b>Your form has been sent. Thank you.</b><br><br><input type='button' value='Home' onclick=\\\"location.href='/';\\\"></center><br><br>\" );
endif; //!\$isHideForm
			?>\n" );

			fputs( $hFile, readFile2Str( $this->php_footer_tpl ) );
			fclose( $hFile );
			return true;
		};// if( $hFile 
		return false;
	}
}
// ---- End of Class : phpForm ----


// - - - -- - - - - - - - - - - - - - - - - - - - - - - - - - - 
function	readFile2Str( $file )
{
	$hFile = fopen( $file, "r" );
	if( $hFile ){
	  $s = fread( $hFile, filesize( $file ) );
	  fclose( $hFile );
	  return $s ;
	}
	return "" ;
}

// - - - -- - - - - - - - - - - - - - - - - - - - - - - - - - - 
function	getMD5FileName(){
	$md5 = md5(uniqid(srand(time()))) ;
	return date("Ymd") . "-". substr($md5, 0,4) ;
}
?>