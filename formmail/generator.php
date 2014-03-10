<?
	include( "include.php" );
// ==============================================	
	commonHeader( "Generator Demo" );
	displayJavaScript();
	$uuid = submit("uuid") ? submit("uuid") : getMD5FileName() ;
	$form = new phpForm( $uuid );
	
	$bPublished = false;
	if( $HTTP_POST_VARS["submited"] ) {
			$bSaveIniOk = $form->saveIni( $HTTP_POST_VARS ) ;	
			if( $bSaveIniOk ) {
				$sError = checkPass() ;
				if( !$sError ){

					if( $form->ini2php() ) :
						switch ( submit("formmail_action") ){
							case "preview" :
									print "\n<script langage='JavaScript'>window.open( \"" . $form->formmail_preview_php_url() . "\" );</script>\n";
									break;
							case "generate" :
									print "\n<script langage='JavaScript'>window.open( \"" . $form->formmail_preview_php_url() . "\" );</script>\n";
									break; 
							case "addmore" :
									break;
						}
					else:
						$sError = "Generate formMail fail." ;	
					endif; // if( $form->ini2html() )

			} //if( !$sError )
		} // if( $bSaveIniOk ) 
	} //if( $HTTP_POST_VARS["submit"] )

	if( $bPublished ):
		ThkMsg();
	else:
		if( $sError ) errMsg( $sError );
		$form->displaySetup();
	endif;
	
	commonFooter();
// ==============================================	

	function	checkPass(){
		global	$HTTP_POST_VARS;
		
		if( !isMail( submit( "esh_formmail_recipient" ) ) ) return "Recipient's email not valid.";
		//if( ! preg_match( "/^([a-z]+|[0-9]+)\.html?/", trim(strtolower(submit("esh_formmail_filename"))) ) ) return "File name for your publishing is not valid." ;
	}


	function	ThkMsg(){
		print "<center><font face=\"arial\" size=\"2\">Thank you for using FormMail Generator.</font></center><BR><BR>" ;
	}


	function	displayJavaScript(){
?>
	<script language="JavaScript">
	<!-- 
		
		function	submit_formmail( sAction )
		{
				var form = document.forms.frmSetup;
				form.formmail_action.value = sAction ;
				if( sAction == "addmore" ) form.esh_formmail_more_fields.value = 5; 
				form.submit();
		}
		
		function	tell_friend()
		{
			var	friend;
			friend = window.open( "formmail.tellafriend.php", "friend", "width=640,height=480,toolbar=no,resizable=yes,scrollbars=yes" );
			friend.focus();
		}
		
		function	faq( part )
		{
			var	faq;
			faq = window.open( "faq.html#" + part, "faq", "width=400,height=180,toolbar=no,resizable=yes,scrollbars=yes" );
			faq.focus();
		}

		function	sample( url )
		{
			var	url;
			 url = window.open( url, "url", "width=640,height=480,toolbar=no,resizable=yes,scrollbars=yes" );
			url.focus();
		}

		function	isNameExist( name ){
				var form = document.forms.frmSetup;
				fieldsCount = form.esh_formmail_field_nums.value ;
				sameCount = 0;
				for( i = 0; i < fieldsCount ; i ++ ){
					field = eval( "document.frmSetup.field_name" + i );
					if( name == field.value ) sameCount ++;
				}
				isExist = ( sameCount > 1 ) ;
				if( isExist ) {
					alert( "Field Name \"" + name + "\" already  exist!!" );
					//field.value = "";
				}
				return isExist;
		}
		
		function	listBuilder( i ){
			var form = document.forms.frmSetup;
			var fields = eval( "form.field_type" + i  );
			var field_type = fields.options[ fields.selectedIndex ].value.toLowerCase() ;
			if( field_type == "radio" ||
			    field_type == "checkbox" || 
				field_type == "select" ) 
			{
				winBuilder = window.open( "list_builder.php?i=" + i, "Builder", "width=500,height=300,toolbar=no,resizable=yes,scrollbars=yes" );
			} else alert( "Your data type is \"" + field_type + "\"\n\n" +
							  " \"Value Builder\" can't be used for that type!" );
			
		}
		
		function	txt2name( str )
		{
			str += "" ;
			str = str.replace( /^ +/gi, "" );
			str = str.replace( / +$/gi, "" );
			s = str.replace( /\.+|\?+|\:+|\>+|\<+|\;+|\"+|\'+|\,+|\/+/gi, " " );
			s = s.replace( / +/gi, "_" );
			s = s.replace( /^_|_$/gi, "" );
			return s.substr( 0, 60 );
		}

	// -->
	</script>
<?
}
?>
<?
/*
?>
<table cellpadding="0" cellspacing="0" border="0" align="center" width="90%">
	<tr>
		<td class="form_field"><b><a href="#" onclick="javascript:tell_friend();return false;">Tell your friend</a> about this great FormMail Generator(No login required).</b></td>
		<td class="form_field" align="right" ><a href="#" onclick="javascript:sample('formmail.define.html');return false;">Sample</a> &nbsp;&nbsp;&nbsp;  <a href="#" onclick="javascript:sample('formmail.result.html');return false;">Result of Sample</a></td>
	</tr>
</table>
<?
*/
?>
