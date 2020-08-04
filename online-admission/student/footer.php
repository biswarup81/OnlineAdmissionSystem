			</div>
		</td> 
	</tr>
</table>
<TABLE cellSpacing=0 cellPadding=0 width="100%" border=0 style="background:url(images/footerbk.gif); height:73">
    <TR>
      <TD class="small_text" align="center" width="100%" valign="left">
      <?=$cdata['aname']?>
<br />
<?=$cdata['address1']?>
<br />
	  </TD>
	</TR>	  
</TABLE>	  
<?php if(isset($ERmsg) && $ERmsg!=''){
$msg_table="<table cellpadding=\'0\' cellspacing=\'0\' width=\'100%\' style=\'\'><tr><td align=\'left\' style=\'background-color:#3F5E9F; height:20px; color:#ffffff; padding-left:5px; font-weight:bold;\'>Message Box<td align=\'right\' style=\'background-color:#3F5E9F; height:20px;\'><a href=\'javascript:closeMessage();\' style=\'text-decoration:none\' ><span style=\'color:#ffffff; padding-right:5px;font-weight:bold\'>X</span></a></td></tr><tr><td class=\'message\' align=\'center\' colspan=\'2\' style=\'height:70px\'>".ucfirst($ERmsg)."</td></tr><tr><td class=\'message\' align=\'center\' colspan=\'2\'><input  class=\'form_button\' type=\'button\' id=\'msg_ok\' name=\'msg_ok\' onclick=\'closeMessage();return false\' value=\'Ok\' /></td></tr></table>";
?>

<script type="text/javascript">
messageObj = new DHTML_modalMessage();	// We only create one object of this class
messageObj.setShadowOffset(5);	// Large shadow
messageObj.setHtmlContent("<?=$msg_table?>");
messageObj.setCssClassMessageBox(false);
messageObj.setSource(false);	// no html source since we want to use a static message here.
messageObj.setShadowDivVisible(false);	// Disable shadow for these boxes	
messageObj.display();

var msg_butt=document.getElementById('msg_ok');	
msg_butt.focus();

function closeMessage()
{
	messageObj.close();	
	
}
</script>
<?php }?>

</body>
</html>
