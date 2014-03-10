<?
define( "ADMIN_MAIL", "s6software@users.sourceforge.net" ); // bug report email

define( "HOST_NAME", getEnv( "HTTP_HOST" ) );
define( "PHP_SELF", getEnv( "SCRIPT_NAME" ) );

define( "ERR_MISSING", "Missing required field : " );
define( "ERR_EMAIL", "Please type in a valid e-mail address : " );
define( "ERR_CREDIT_CARD_NUMBER", "Please check the credit card number : " );
define( "ERR_CREDIT_CARD_EXPIRED", "Please check the credit card expiry date : " );
define( "ERR_SELECT_UPLOAD", "Please select upload file : " );

error_reporting( E_ERROR | E_WARNING | E_PARSE );
?><?php
// --- Array of Form Elements ---
$form_mail[] = array( "name" => "Company_name", "text" => "Company name",  "type" => "text", "required" => "Required" ) ;
$form_mail[] = array( "name" => "Contact_name", "text" => "Contact name",  "type" => "text", "required" => "Required" ) ;
$form_mail[] = array( "name" => "Email_address", "text" => "Email address",  "type" => "sender's email", "required" => "Required" ) ;
$form_mail[] = array( "name" => "Phone_number", "text" => "Phone number",  "type" => "text", "required" => "Required" ) ;
$form_mail[] = array( "name" => "State", "text" => "State",  "type" => "select", "required" => "Required" ) ;
$form_mail[] = array( "name" => "URL_of_site", "text" => "URL of site",  "type" => "text", "required" => "Required" ) ;
$form_mail[] = array( "name" => "Which_Custom_Search_option_interests_you", "text" => "Which Custom Search option interests you?",  "type" => "select", "required" => "Required" ) ;
$form_mail[] = array( "name" => "Estimated_number_of_search_queries_PER_DAY", "text" => "Estimated number of search queries PER DAY",  "type" => "select", "required" => "Required" ) ;
$form_mail[] = array( "name" => "Website_size_(approximate_#_of_pages)", "text" => "Website size (approximate # of pages)",  "type" => "text", "required" => "" ) ;
$form_mail[] = array( "name" => "When_are_you_planning_to_launch_a_new_search_service_on_your", "text" => "When are you planning to launch a new search service on your site?",  "type" => "radio", "required" => "Required" ) ;
$form_mail[] = array( "name" => "What_type_of_company_do_you_work_for_(e_g_software_health_tr", "text" => "What type of company do you work for? (e.g. software, health, travel, etc.) ",  "type" => "text", "required" => "Required" ) ;
$form_mail[] = array( "name" => "How_did_you_hear_about_Google", "text" => "How did you hear about Google?",  "type" => "radio", "required" => "" ) ;
$form_mail[] = array( "name" => "Comments", "text" => "Comments",  "type" => "textarea", "required" => "" ) ;

// -- Detech Submit & SendMail -- 
$isHideForm = false;
if( $HTTP_POST_VARS["formmail_submit"] ){
	$sErr = checkPass();
	if( ! $sErr ){
		sendFormMail( $form_mail, "google.txt") ;
		$isHideForm = true;
		
		$redirect = "";
		if( strlen(trim($redirect)) ):
			header( "Location:$redirect" );
			exit;
		endif;
	}
}


?>
<?
// ===============================================
function    sendFormMail( $form_mail, $sFileName = ""  ) 
{ 
    global    $HTTP_POST_VARS ; 
	
	$to = $HTTP_POST_VARS["esh_formmail_recipient"]; // I don't detect spam at this moment. it's to do list.
	$from = "online.submit@" . HOST_NAME ;
	$subject = $HTTP_POST_VARS["esh_formmail_subject"]; 

	// first stage keep it simple:
	$sWhatToDo = $sFileName ? "mailandfile" : "" ; //$HTTP_POST_VARS["esh_formmail_mail_and_file"];

	//$sFileName = $HTTP_POST_VARS["esh_formmail_save_record_file"];
	$cc = $HTTP_POST_VARS["esh_formmail_cc"];
	$bcc = $HTTP_POST_VARS["esh_formmail_bcc"];
	$charset = $HTTP_POST_VARS["esh_formmail_charset"];
	
    for( $i = 0; $i < count( $form_mail ); $i ++ ){ 
        $value = trim( $HTTP_POST_VARS[ $form_mail[ $i ][ "name" ] ] ); 
        $content .= $form_mail[ $i ][ "text" ] . " \t : " . $value ."\n"; 
        $line .= remove_newline( $value ) . "\t" ; 
		if( strtolower("Sender's email") == strtolower($form_mail[ $i ][ "type" ]) ) {
			//print "Type:[" . $form_mail[ $i ][ "type" ] . "] $value <br>\n"; 
			$from = $value ;		
		}
    }; 
    $content .= "\n\nIP:" . getEnv( "REMOTE_ADDR" ); 

	switch( strtolower($sWhatToDo) ){
		case "mailandfile" :
	        mailAttachments( $to , $subject , $content,  $from,  $charset, $cc , $bcc ) ; 
    	    if( ! appendToFile( $sFileName, $line ) ) 
				mailReport( $content . "\n\nWrite Form Mail to File Fail." ); 
			break;			

		case "fileonly" :
    	    if( ! appendToFile( $sFileName, $line ) ) 
				mailReport( $content . "\n\nWrite Form Mail to File Fail.", $from ); 
			break;

		default :
	        mailAttachments( $to , $subject , $content,  $from,  $charset, $cc , $bcc ) ; 
	} 

	mailAutoResponse( $from ) ;
} 


//------------------------------------------------------------------------------------------ 
function mailAutoResponse( $to ){
    global    $HTTP_POST_VARS ; 
	$subject = $HTTP_POST_VARS["esh_formmail_return_subject"];
	$responseMsg = $HTTP_POST_VARS["esh_formmail_return_msg"];
	if( $to && $responseMsg ) 
		mail( $to, $subject, $responseMsg, "From: " . $HTTP_POST_VARS["esh_formmail_recipient"] );
}


//------------------------------------------------------------------------------------------ 
function mailReport( $content = "", $from = "" ){
	mail( ADMIN_MAIL, "Error@" . HOST_NAME . PHP_SELF, $content, "From:$from" );
}

//------------------------------------------------------------------------------------------ 
function	remove_newline( $str = "" ){
	$newliner = "<!--esh_newline-->" ; // replace \r\n with $newliner ;
	$newtaber = "<!--esh_newtaber-->" ; // replace \t with $newtaber ;
	$str = ereg_replace( "\t", $newtaber, $str );
	$str = ereg_replace( "\r\n", $newliner, $str );
	return ereg_replace( "\n", $newliner, $str );
}

//------------------------------------------------------------------------------------------ 
function	checkPass()
{
	global	$form_mail ;
	global	$HTTP_POST_VARS ;
    global    $HTTP_POST_FILES ; 

	for( $i = 0; $i < count( $form_mail ); $i ++ ){
		$type = strtolower( $form_mail[ $i ][ "type" ]  );
		$value = trim( $HTTP_POST_VARS[ $form_mail[ $i ][ "name" ] ] );
		$required = $form_mail[ $i ][ "required" ] ;
		$text = stripslashes( $form_mail[ $i ][ "text" ] );
		
		// simple check the field has something keyed in.
		if( !strlen($value) && (  $required == "Required" ) && $type != "attachment" )   
			return ERR_MISSING . $text  ;

		// verify the special case
		if( 
			( strlen($value) || $type == "attachment" ) 
			&&  $required == "Required" 
		):
			switch( $type ){
					case 	strtolower("Sender's Name") :
							  break;
					case 	strtolower("Generic email"):
					case 	strtolower("Sender's email"):
							   if( ! formIsEMail($value) )	 return ERR_EMAIL . $text ;
							   break;
					case	"text" :
								break;
					case 	"textarea" :
								break;
					case	"checkbox" :
					case 	"radio" :
								break;
					case 	"select" :
								break;
					case 	"attachment" :
								$upload_file = $HTTP_POST_FILES[ $form_mail[ $i ]["name"] ][ "tmp_name" ] ;
								if( ! is_uploaded_file($upload_file)  )
									return  ERR_SELECT_UPLOAD . $text; 
								break;
					case strtolower("Date(MM-DD-YYYY)"):
								break;
					case strtolower("Date(MM-YYYY)"):
								break;
					case strtolower("CreditCard(MM-YYYY)"):
								if( $value < date("Y-m") ) return ERR_CREDIT_CARD_EXPIRED  . $text; 
								break;
					case strtolower("CreditCard#"):
								if( !formIsCreditNumber( $value )  ) return ERR_CREDIT_CARD_NUMBER  . $text ;
								break;
					case strtolower("Time(HH:MM:SS)"):
								break;
					case strtolower("Time(HH:MM)"):
								break;
					default :
						//return $sErrRequired . $form_mail[ $i ][ "text" ];
				} // switch
		endif;
	} // for
	
	return "" ;
}



//------------------------------------------------------------------------------------------ 
function formSelected( $var, $val ) 
{ 
    echo ( $var == $val ) ? "selected" : ""; 
} 


//------------------------------------------------------------------------------------------ 
function formChecked( $var, $val ) 
{ 
    echo ( $var == $val ) ? "checked" : ""; 
} 


//------------------------------------------------------------------------------------------ 
function    formIsEMail( $email ){ 
        return ereg( "^(.+)@(.+)\\.(.+)$", $email ); 
} 


//------------------------------------------------------------------------------------------ 
function    selectList( $name, $selectedValue, $start, $end, $prompt = "-Select-", $style = "" ) 
{ 
    $tab = "\t" ; 
    print "<select name=\"$name\" $style>\n" ; 
    print $tab . "<option value=''>$prompt</option>\n" ; 
    $nLen = strlen( "$end" ) ; 
    $prefix_zero = str_repeat( "0", $nLen ); 
    for( $i = $start; $i <= $end ; $i ++ ){ 
        $stri = substr( $prefix_zero . $i, strlen($prefix_zero . $i)-$nLen, $nLen ); 
        $selected = ( $stri == $selectedValue ) ? " selected " : "" ; 
        print $tab . "<option value=\"$stri\" $selected >$stri</option>\n" ; 
    } 
    print "</select>\n\n" ; 
} 


//------------------------------------------------------------------------------------------ 
// something like CreditCard.pm in perl CPAN 
function formIsCreditNumber( $number ) { 
     
    $tmp = $number; 
    $number = preg_replace( "/[^0-9]/", "", $tmp ); 

    if ( preg_match(  "/[^\d\s]/", $number ) )  return 0; 
    if ( strlen($number) < 13  && 0+$number ) return 0;  

    for ($i = 0; $i < strlen($number) - 1; $i++) { 
        $weight = substr($number, -1 * ($i + 2), 1) * (2 - ($i % 2)); 
        $sum += (($weight < 10) ? $weight : ($weight - 9)); 
    } 

    if ( substr($number, -1) == (10 - $sum % 10) % 10  )  return $number; 
    return $number; 
} 


// -------------------------- Begin Mail Attachment Functions ----------------------------------------------------------------- 
function    mailAttachments( $to = "" , $subject = "" , $message = "" , $from = "support@lynx.net" , $charset = "iso-8859-1", $cc = "" , $bcc = "" ){ 
    global    $HTTP_POST_FILES ; 
     
        if( ! strlen( trim( $to ) ) ) return "Missing \"To\" Field." ; 

        $boundary = "====_My_PHP_Form_Generator_" . md5( uniqid( srand( time() ) ) ) . "====";  
         
        // setup mail header infomation 
        $headers = "From: $from\r\n";  
        if ($cc) $headers .= "CC: $cc\r\n";  
        if ($bcc) $headers .= "BCC: $bcc\r\n";  
		$plainHeaders = $headers ; // for no attachments header
        $headers .= "MIME-Version: 1.0\nContent-type: multipart/mixed;\n\tboundary=\"$boundary\"\n";  

        $txtMsg = "\nThis is a multi-part message in MIME format.\n" .  
                        "\n--$boundary\n" . 
                        "Content-Type: text/plain;\n\tcharset=\"$charset\"\n\n"  . $message . "\n"; 
         
        //create mulitipart attachments boundary 
        $sError = "" ; 
        $nFound = 0; 
        foreach( $HTTP_POST_FILES as $aFile ){ 
                    $sFileName = $aFile[ "tmp_name" ] ; 
                    $sFileRealName = $aFile[ "name" ] ; 
                    if( is_file( $sFileName ) ): 
                         
                        if( $fp = fopen( $sFileName, "rb" ) ) : 
                            $sContent = fread( $fp, filesize( $sFileName ) ); 
                            $sFName = basename( $sFileRealName ) ; 
                            $sMIME = getMIMEType( $sFName ) ; 
                             
                            $bPlainText = ( $sMIME == "text/plain" ) ; 
                            if( $bPlainText ) : 
                                $encoding = "" ; 
                            else: 
                                $encoding = "Content-Transfer-Encoding: base64\n";  
                                $sContent = chunk_split( base64_encode( $sContent ) );  
                            endif; 
                             
                            $sEncodeBody .=     "\n--$boundary\n" .  
                                                        "Content-Type: $sMIME;\n" .  
                                                        "\tname=\"$sFName\"\n" . 
                                                        $encoding .  
                                                        "Content-Disposition: attachment;\n" .  
                                                        "\tfilename=\"$sFName\"\n\n" . 
                                                        $sContent . "\n" ; 
                            $nFound ++;                                                 
                        else: 
                            $sError .= "<br>File $sFileName can not open.\n" ; 
                        endif; // if( $fp = fopen( $sFileName, "rb" ) ) : 
                         
                    else: 
                        $sError .= "<br>File $sFileName doesn't exist.\n" ; 
                    endif; //if( file_exists( $sFileName ) ): 
        }; // end foreach 
   
         $sEncodeBody .= "\n\n--$boundary--" ; 
         $sSource = $txtMsg . $sEncodeBody ; 


		 $nFound ? mail( $to, $subject, $sSource, $headers  )
		                : mail( $to, $subject, $message, $plainHeaders );  

        return $sError ;         
} 

/* --------------------------------------------------------------------------------------------------- 
    Parameters: $sFileName 
    Return : 
        1. "" :  no extendsion name, or sFileName is empty 
        2. string: MIME Type name of array aMimeType's definition. 
   ---------------------------------------------------------------------------------------------------*/ 
function    getMIMEType( $sFileName = "" ) { 
         
        $sFileName = strtolower( trim( $sFileName ) ); 
        if( ! strlen( $sFileName  ) ) return ""; 
         
        $aMimeType = array(  
                                        "txt" => "text/plain" , 
                                        "pdf" => "application/pdf" , 
                                        "zip" => "application/x-compressed" , 

                                        "html" => "text/html" , 
                                        "htm" => "text/html" , 

                                        "avi" => "video/avi" , 
                                        "mpg" => "video/mpeg " , 
                                        "wav" => "audio/wav" , 

                                        "jpg" => "image/jpeg " , 
                                        "gif" => "image/gif" , 
                                        "tif" => "image/tiff " , 
                                        "png" => "image/x-png" , 
                                        "bmp" => "image/bmp"  
                                    ); 
        $aFile = split( "\.", basename( $sFileName ) ) ; 
        $nDiminson = count( $aFile ) ; 
         $sExt = $aFile[ $nDiminson - 1 ] ; // get last part: like ".tar.zip", return "zip" 
         
        return ( $nDiminson > 1 ) ? $aMimeType[ $sExt ] : "";  
} 
// -------------------------- End Mail Attachment Functions ----------------------------------------------------------------- 


//------------------------------------------------------------------------------------------ 
function    appendToFile( $sFileName = "", $line = "" ){ 
    if( !$sFileName || !$line ) return 0; 
    $hFile = fopen( "$sFileName", "a+w" ); 
    $nBytes = 0; 
    if( $hFile ){ 
        $nBytes = fputs( $hFile , trim($line)."\r\n" ); 
        fclose( $hFile ); 
    }; 
    return $nBytes ; 
} 
?>