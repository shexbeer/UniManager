{include file="header.tpl" title=foo}

<b>Die Liste zeigt alle existierender Studiengaenge.</b><br><br>
Einen ausw&auml;hlen um ihn zu editieren bzw zu l&ouml;schen oder hier einen neuen anlegen:<br>
	<a href="SG_edit.php?createnew=yes">Neuen Studiengang kreieren</a>
<br><br>
<script language="JavaScript">
    <!--
     function send_formular($id) {
              Check = confirm("Wollen Sie den Studiengang wirklich loeschen?\nDies kann nicht mehr rueckgaengig gemacht werden!");
              if (Check == false){
                  //history.back();
              } else {
                  window.location.href="SG_edit.php?deleteid="+$id;
              }
     }
    //-->
  </script>
<noscript></noscript>
   
<table border="1" rules="rows">
<tr>
	<th id="sg_edit_table_flags">Typ</th>
	<th id="sg_edit_table_flags">Name des Studiengangs</th>
	<!-- <th>Studiengang_ID</th> -->
	<th id="sg_edit_table_flags">Studiendekan</th>
	<th id="sg_edit_table_flags">Status</th>
	<th></th>
	
	<th id="sg_edit_table_flags" colspan="3">setze</th>
	<!-- <th></th> -->
	<th></th>
</tr>

{foreach from=$SGList item=var}
<tr>
	<td>{$var.sg_typ}</td>
	<td>{$var.sg_name}</td>
	<!-- <td>{$var.sg_id}</td> -->
	<td align=center>{$var.sg_dekan}</td>
	<td {if $var.sg_status=="beschlossen"}style="color:blue;"{else if $var.sg_status=="abgestimmt"}style="color:orange;"{else if $var.sg_status=="bestaetigt"}style="color:green;"{/if}>{$var.sg_status}</td>
	<td><a href="SG_edit.php?showEdit=yes&forid={$var.sg_id}"> &auml;ndern </a></td>

	<td><a id="sg_edit_table_flags_left" style="color:blue;" href="SG_edit.php?setStatus=1&forid={$var.sg_id}"> beschlossen </a></td>
	<td><a  style="color:orange" href="SG_edit.php?setStatus=2&forid={$var.sg_id}"> abgestimmt </a></td>
	<td><a id="sg_edit_table_flags_right" style="color:green" href="SG_edit.php?setStatus=3&forid={$var.sg_id}"> best&auml;tigt </a></td>

	<!-- <td><a href="SG_edit.php?editMauf=yes&forid={$var.sg_id}"> Modulaufstellung </a></td> -->

	<td><a style="color:red" onClick="send_formular({$var.sg_id})"> l&ouml;schen</a></td>
</tr>
{/foreach}
</table>

{include file="footer.tpl" title=foo}