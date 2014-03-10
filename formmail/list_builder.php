<?
	$I = $HTTP_GET_VARS[ "i" ] > 0 ? $HTTP_GET_VARS[ "i" ] : 0;
?>
<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.0 Transitional//EN">

<html>
<head>
	<title>PHP Form Generator | Value Builder - A tool to add multiple value for Radio Button, Checkbox, Selection List</title>
	<LINK REL='STYLESHEET' TYPE='text/css' HREF='form.css'>
<script language="javascript" type="text/javascript">
<!--
	var phpFormI = <?= $I ?> ;
	var separator = "|" ;
	//var initValue = "A|B|C";
	var initValue = eval( "opener.document.frmSetup.field_value" + phpFormI + ".value" );
	var allValues = initValue ;

	function saveValue(){
		fieldValue = eval( "opener.document.frmSetup.field_value" + phpFormI ) ;
		fieldValue.value = allValues ;
		self.close();
	}
	
	function buildList(){
		var form = document.frmBuilder ;
		A = allValues.split( separator );
		form.allvalues.length = 0;
		for( i = 0; i < A.length; i ++ ){
			v = reFmt( A[i] );
			if(  v != "" ) form.allvalues.options[i] = new Option( v, v ) ; 
		}
	}
	
	function addValue(){
		var form = document.frmBuilder ;
		if( form.addvalue.value !="" && form.addvalue.value != separator ){
			allValues += separator + reFmt(form.addvalue.value) ;
			allValues = reFmt( allValues );
			buildList();
			form.addvalue.value = "" ;
		}
	}
	
	function delValue(){
		var form = document.frmBuilder ;
		newAllValues = "" ;
		for( v = 0; v < form.allvalues.options.length; v ++ ){
			if( form.allvalues.options[ v ].selected ){
				form.allvalues.options[ v ] = null ;
				v -- ;
			} else newAllValues += separator + form.allvalues.options[ v ].text ;
		}
		allValues = newAllValues ;
	}

	function reFmt( s ){
		s = s.replace( /^(\s+|\|+)/gi, "" );
		s = s.replace( /(\s+|\|+)$/gi, "" );
		return s;
	}
	
	function up(){
		var form = document.frmBuilder ;
		var List = form.allvalues.options ;
		index = List.selectedIndex ;
		if( index == -1 ) return ;

		if( index > 0 ) {
			prev = new Option( List.options[ index - 1 ].text,  List.options[ index - 1 ].value );
			current = new Option( List.options[ index ].text, List.options[ index ].value );
			List.options[ index - 1 ] = current ;
			List.options[ index ] = prev ;
			List.options[ index - 1 ].selected = true;
		} // index > 0
	}
	
	function down(){
		var form = document.frmBuilder ;
		var List = form.allvalues.options ;
		index = List.selectedIndex ;
		if( index == -1 ) return ;
		
		if( index < List.options.length - 1 ) {
			next = new Option( List.options[ index + 1 ].text,  List.options[ index + 1 ].value );
			current = new Option( List.options[ index ].text, List.options[ index ].value );
			List.options[ index + 1 ] = current; 
			List.options[ index ] = next ; 
			List.options[ index + 1 ].selected = true;
		} // index < List.options.length
	}
//-->
</script>	
</head>

<body>

<form name="frmBuilder" >
<table cellpadding="6" cellspacing="6" border="0">
   	<tr>
		<td class="form_field" align="right" valign="top">Value:</td>
   		<td class="form_text"><input type="text" name="addvalue" value="" style="width:200px" size=30></td>
		<td class="form_text"><a href="javascript:void(0);" onclick="addValue();">Add</a>&nbsp;&nbsp;</td>
   	</tr>
   	<tr>
		<td class="form_field" align="right" valign="top">All :</td>
   		<td class="form_text">
			<select name="allvalues" size="5" multiple style="width:200px;height:100px;" >
				<option value="">- No Value -</option>
				<option value="">- ============================= -</option>
				<option value="">- ============================= -</option>
				<option value="">- ============================= -</option>
			</select>
		</td>
		<td class="form_text" valign="top">
			<a href="javascript:void(0);" onclick="delValue();">Remove</a> &nbsp;&nbsp; <br>
			<a href="javascript:void(0);" onclick="up();">Up</a>&nbsp;&nbsp; <br>
			<a href="javascript:void(0);" onclick="down();">Down</a>&nbsp;&nbsp;
		</td>
   	</tr>
	<tr>
		<td>&nbsp;</td>
		<td colspan="2" class="form_text"><a href="javascript:void(0);" onclick="self.close();">Close</a> &nbsp;&nbsp; <a href="javascript:void(0);" onclick="saveValue();">Save</a></td>
	</tr>
   </table>
</form>

<script language="javascript" type="text/javascript">
<!--
	buildList();
//-->
</script>
</body>
</html>
