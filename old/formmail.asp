<%@ Language = vbscript%>
<%option explicit %>
<%server.scripttimeout = 600 %>
<%
'------------------------------------------- FORMMAIL V1.3 ------------------------------------------

'----------------------------------------------------------------------------------------------------
'copyright information
'----------------------------------------------------------------------------------------------------
'Copyright 2002: Sorted Sites http://www.sortedsites.com
'Authors Jonas Tornqvist, David Parkes and Karl Snares
'This script is Freeware, which means you are free to use and modify 
'the script for your own use.
'The only condition is this copyright header remain intact and you don't 
'try and sell this script for profit without first asking us. 
'And of course also ask Matt Wright who wrote the original perl version of Formmail.

'----------------------------------------------------------------------------------------------------
'license agreement - Important
'----------------------------------------------------------------------------------------------------
'By using this script you agree to indeminfy the developers - Sorted Sites of any loss
'or damages that may arise from its use or missue.
'This script is provided as is with all faults - no warranties and no guarantees.
'basically its free - use it at your own risk and cost.
'No warranties and no tech support - if you need help with this don't ask us!
'The documentation is provided as is with all the help we can offer.
'As we develop this script we shall post updates hopefully fix any bugs
'We are not obliged to release any future versions and we might not bother...
'By using this script you accept this license agreement!

'----------------------------------------------------------------------------------------------------
'documentation v1.3
'----------------------------------------------------------------------------------------------------

'####################################################################################################
'this is where the code starts for real
'####################################################################################################

'----------------------------------------------------------------------------------------------------
'declare variables
'----------------------------------------------------------------------------------------------------
Dim strFrom, strTo, strSubject, strBody
Dim objMessage, objConfig, strServer, intPort
Dim recipient, redirect, subject, realname, email, required, strEmail1, strEmail2
Dim referer, url, url_verified, icounter, query, iloop, query2, query3, i, agree, validation, error0, error0ok

'############################## CONFIGURATION VARIABLES ####################################

'These are the only lines you will need to change
'----------------------------------------------------------------------------------------------------
strServer = "smtp.cavillaparkskincare.com" 'set which smtp server will be used to send the email. enter ip address or domain name. eg: "xxx.xxx.xxx.xxx" or "smtp.your-domain.com"
intPort = 25 'set the smtp port to be used when sending mail (by default port 25 is used)
'Referrer's Array is defined here. Enter the valid domains which may use this script.
url = Array("www.cavillaparkskincare.com","cavillaparkskincare.com")'Set which urls that will be accepted. http://xxxxx/
	'Seperate multiple domains by commas 
	'eg: url= Array("www.your-domain.com","your-domain.com","www.my-domain.com")
	'computer names can be used instead of domains if this script is being run locally
	'eg: url = Array("computername")

'######################################### IMPORTANT NOTICE #########################################
'IMPORTANT: do not modify anything below this line unless you know what you are doing!!
'######################################### IMPORTANT NOTICE #########################################
	
'----------------------------------------------------------------------------------------------------
'information type and CDOSYS constants
'----------------------------------------------------------------------------------------------------
%>
<!--METADATA TYPE="typelib"
UUID="CD000000-8B95-11D1-82DB-00C04FB1625D"
NAME="CDO for Windows 2000 Library" -->
<!--METADATA TYPE="typelib"
UUID="00000205-0000-0010-8000-00AA006D2EA4"
NAME="ADODB Type Library" -->
<%
'----------------------------------------------------------------------------------------------------
'retrieved default fields
'----------------------------------------------------------------------------------------------------
recipient = request("recipient")
redirect = request("redirect")
subject = request("subject")
email = request("email")
required = request("required") 
if required = "" then
	required = "recipient,subject,email,redirect"
else
	required = "recipient,subject,email,redirect," & required
end if

'----------------------------------------------------------------------------------------------------
'verify the referer
'----------------------------------------------------------------------------------------------------
referer = request.ServerVariables("HTTP_REFERER") 
referer = split(referer,"/")
url_verified = "no"
for icounter = Lbound(url) to Ubound(url) '
	if referer(2) = url(icounter) then
		url_verified = "yes"
	end if
next
if not url_verified = "yes" then 
	response.write("The url specified is invalid!")
	response.End
end if

'----------------------------------------------------------------------------------------------------
'verify the recipient(not tested)
'----------------------------------------------------------------------------------------------------
'trimed_referer = split(referer(2),".")'
'response.write recipient & "<br>" & referer(2) & "=" & trimed_referer(0) & "<br>"
'if trimed_referer(0) = "www" then
'	if InStr(1,recipient,trimed_referer(1),1) = 0 then
'		response.write "recipient don't match the referer"
'		response.end
'	end if
'else
'	if InStr(1,recipient,trimed_referer(0),1) = 0 then
'		response.write "recipient don't match the referer"
'		response.end
'	end if
'end if

'----------------------------------------------------------------------------------------------------
'retrieve form contents and create email fields
'---------------------------------------------------------------------------------------------------- 
query = Request.ServerVariables("QUERY_STRING") 
query = split(query,"&")
query3 = split(required,",")
	For iLoop = Lbound(query) to UBound(query)
		query2 = split(query(iloop),"=")
	
'----------------------------------------------------------------------------------------------------
'form validation, checks required fields are not null
'----------------------------------------------------------------------------------------------------
		for i = LBound(query3) to UBound(query3)
			if query3(i) = query2(0) then
				if query2(1) = "" then
					response.write ("you must enter a valid ") & query2(0)
					response.end
				end if
			end if
			
			'if query2(0) = "agree" then
				'if query2(1) <> "on" or query2(1) = "" then
				'	response.write("You must agree to terms and conditions to enable Formmailv1.3 to execute!")
				'response.end
				'end if
			'end if
			
'----------------------------------------------------------------------------------------------------
'form validation, checks a valid email address has been specified
'----------------------------------------------------------------------------------------------------			
			if query2(0) = "email" then
				trim(query2(0))
				if len(query2(1))<8 then
					response.Write("You must specify a valid ") & query2(0)
					response.end
				end if
				if instr(query2(1),"@")=0 and instr(query2(1),".")=0 then
					response.write query2(1)
					response.Write("You must specify a valid ") & query2(0)
					response.end
				end if
				strEmail1 = split(query2(1),"@")
				if len(strEmail1(1))<3 then
					response.Write("You must specify a valid ") & query2(0)
					response.end
				end if
				strEmail2 = split(strEmail1(1),".")
				if len(strEmail2(0))<3 then
					response.Write("You must specify a valid ") & query2(0)
					response.end
				end if
				if len(strEmail2(1))<2 then
					response.Write("You must specify a valid ") & query2(0)
					response.end
				end if
			end if

'----------------------------------------------------------------------------------------------------
'form validation, checks terms and conditions checkbox has been ticked
'----------------------------------------------------------------------------------------------------
			
		Next
		if not query2(0) = "recipient" and not query2(0) = "redirect" and not query2(0) = "subject" and not query2(0) = "realname" and not query2(0) = "email" and not query2(0) = "required" and not query2(0) = "agree" then
			strBody = strBody & vbnewline & vbnewline & query2(0) &": " & query2(1) 
		end if
	Next
if email = "" then
	email = "formmail@" & referer(2)
end if
'----------------------------------------------------------------------------------------------------
'replaces any special characters parsed through the query string
'----------------------------------------------------------------------------------------------------
strbody = replace(strbody, "+"," ")
strbody = replace(strbody, "%26%238364%3B","€")
strbody = replace(strbody, "%A1","¡")
strbody = replace(strbody, "%A3","£")
strbody = replace(strbody, "%A8","¨")
strbody = replace(strbody, "%AA","ª")
strbody = replace(strbody, "%AC","¬")
strbody = replace(strbody, "%B4","´")
strbody = replace(strbody, "%B7","·")
strbody = replace(strbody, "%BA","º")
strbody = replace(strbody, "%BF","¿")
strbody = replace(strbody, "%C7","Ç")
strbody = replace(strbody, "%E7","ç")
strbody = replace(strbody, "%0D%0A",vbnewline)
strbody = replace(strbody, "%21","!")
strbody = replace(strbody, "%23","#")
strbody = replace(strbody, "%24","$")
strbody = replace(strbody, "%25","%")
strbody = replace(strbody, "%26","&")
strbody = replace(strbody, "%27","'")
strbody = replace(strbody, "%28","(")
strbody = replace(strbody, "%29",")")
strbody = replace(strbody, "%2B","+")
strbody = replace(strbody, "%2C",",")
strbody = replace(strbody, "%2D","-")
strbody = replace(strbody, "%2E",".")
strbody = replace(strbody, "%2F","/")
strbody = replace(strbody, "%3A",":")
strbody = replace(strbody, "%3B",";")
strbody = replace(strbody, "%3C","<")
strbody = replace(strbody, "%3D","=")
strbody = replace(strbody, "%3E",">")
strbody = replace(strbody, "%3F","?")
strbody = replace(strbody, "%5B","[")
strbody = replace(strbody, "%5C","\")
strbody = replace(strbody, "%5D","]")
strbody = replace(strbody, "%5E","^")
strbody = replace(strbody, "%5F","_")
strbody = replace(strbody, "%60","`")
strbody = replace(strbody, "%7B","{")
strbody = replace(strbody, "%7C","|")
strbody = replace(strbody, "%7D","}")
strbody = replace(strbody, "%7E","~")

'----------------------------------------------------------------------------------------------------
'this creates the body of the mail message, the text in quotes can be modified accordingly 
'---------------------------------------------------------------------------------------------------
strBody = "Here is the results of your form submitted from" & referer(2)  & vbnewline & vbnewline & "Name: " & realname & vbnewline &  vbnewline & "Email: " & email & vbnewline & strBody & vbnewline &  vbnewline & "############# End Formmail Tranmission #############" 

'----------------------------------------------------------------------------------------------------
'checks if a smtp port has been specified, if not it uses the default port 25
'----------------------------------------------------------------------------------------------------
if intport <> 25 then
	intport = intport
else
	intport = 25
end if

'----------------------------------------------------------------------------------------------------
'send the mail message
'----------------------------------------------------------------------------------------------------	
set objMessage = CreateObject("CDO.Message")
objMessage.To = recipient
objMessage.From = email
objMessage.Subject = subject
objMessage.Sender = email
objMessage.Textbody = strBody

'----------------------------------------------------------------------------------------------------
'cdosys configuration setup
'----------------------------------------------------------------------------------------------------
set objConfig = CreateObject("CDO.Configuration")
objConfig.Fields(cdoSendUsingMethod) = cdoSendUsingPort
objConfig.Fields(cdoSMTPServer) = strServer
objConfig.Fields(cdoSMTPServerPort) = intPort
objConfig.Fields(cdoSMTPAuthenticate) = cdoAnonymous
objConfig.Fields.Update
set objMessage.Configuration = objConfig

'----------------------------------------------------------------------------------------------------
'define error handling procedures
'----------------------------------------------------------------------------------------------------
On Error Resume Next
	objMessage.Send
If Err.Number = 0 then
	response.write("Formmail v1.3 processed all operations successfully!")
else
	response.write("Formmail v1.3 detected the following errors:")& "<br>"
	response.write("error no.: ")&err.number & "<br>"
	response.write("description: ")&err.description & "<br>"
	response.end
End If
On Error Goto 0
	
'----------------------------------------------------------------------------------------------------
'send them to the page specified
'----------------------------------------------------------------------------------------------------
Response.Redirect redirect

'####################################################################################################
'This is where the code ends
'####################################################################################################
%>
<!-- That's All Folks -->
<!-- Happy Surfing -->
<!-- Credits -->
<!-- David Parkes - Project Planning -->
<!-- Jonas Tornqvist - Lead Programmer version 1-->
<!-- Karl Snares - Lead Programmer version 1.2 & 1.3
<!-- Matt Wright - Original Formmail CGI Developer -->