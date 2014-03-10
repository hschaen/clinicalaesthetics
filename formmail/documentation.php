<?
	include( "include.php" );
// ==============================================	
	commonHeader( "Contact" );
?>
<table cellpadding="0" cellspacing="0" border="0" width="90%" align="center">
	<tr>
		<td>

  <b>PHP FormMail Generator</b> - A tool to create ready-to-use web forms in a flash.
  <br><br>

  <b>Documentation:</b>		
<br><br>

  <b>Version 1.0</b><br>
  ---------------------------
<blockquote>
<p>
    This program is free software; you can redistribute it and/or modify
    it under the terms of the GNU General Public License as published by
    the Free Software Foundation; either version 2 of the License, or
    (at your option) any later version.
<p>

    This program is distributed in the hope that it will be useful,
    but WITHOUT ANY WARRANTY; without even the implied warranty of
    MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the
    GNU General Public License for more details.
<p>

    You should have received a copy of the GNU General Public License
    along with this program; if not, write to the Free Software
    Foundation, Inc., 59 Temple Place, Suite 330, Boston, MA  02111-1307  USA
</blockquote>

  
  <b>Features: </b><br>
  ---------------------------
<blockquote>
	<li type="square"></li>Unlimited fields of form
	<li type="square"></li>All standard type of fields, plus lots of template, such as credit card number & expiry date...  
	<li type="square"></li>List/menu builder for multiple lists of Radio Buttons, Selection Menu, Check Box.
	<li type="square"></li>Error checking : credit card number & expiry date, email address, required fields checking. 
	<li type="square"></li>Mail multiple attachments
	<li type="square"></li>Email auto responding
	<li type="square"></li>Store submitted form data to a text file
	<li type="square"></li>Multiple language support ( to do )
	<li type="square"></li>Anti-spam feature for ISP companies( to do )
</blockquote>

  
  <b>Installation:</b><br>
  ---------------------------
<blockquote>
  	1. Get the source file and untar/unzip it as following step<br>
  		Unix:<br>
  		tar zxvf phpFormMailGenerator-php-x.xx.tar.gz
<p>

		Windows:<br>
		use winrar or some other unzipping utility
<p>
	
	2. Upload the unpacked directory to your web server
<p>
	
	3. Make sure the permission of the directory has r+w+x ( read+write+execute )
		Unix:<br>
		chmod -R 777 phpfmg
<p>
		
		Windows NTFS (NT4/2000/XP):<br>
		. right click floder "phpfmg", select "properties"<br>
		. set allow Read+Write then "OK"<br>
<p>

	4. type the URL http://www.yourdomain.com/phpfmg/index.php to your browser
</blockquote>
		
	
  <b>How to use Generator:</b><br>
  ---------------------------
<blockquote>
	1. Define fields for your form.
<p>
	
	2. What happens after click "Generate" button:<br>
		. Attempt to save your fields to a .ini file<br>
		. If the .ini saved, try to out put two files : yyyymmdd-xxxx.php, yyyymmdd-xxxx.lib.php<br>
		. If all 3 files created, you will get a pop up window of your form<br>
		. Now you have a ready-to-use web form<br>
<p>
	
	3. Download two files yyyymmdd-xxxx.php & yyyymmdd-xxxx.lib.php
<p>
	
	4. Rename file yyyymmdd-xxxx.php to what you want, such as order.php.
	   Don't rename file yyyymmdd-xxxx.lib.php.
<p>
	
	5. Upload those two files to your web site.
<p>
	
	6. Done!
</blockquote>

		</td>
	</tr>
</table>
<?
	commonFooter();
// ==============================================	
?>