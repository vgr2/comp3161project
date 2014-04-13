<?php
include_once("../common/dbConnection.php");
include_once("../common/header.php");
?>
<h2>Enter Group_editors</h2>
<form name="group_editorsEnterForm" method="POST" action="insertNewGroup_editors.php">

<table cellspacing="2" cellpadding="2" border="0" width="100%">
	<tr valign="top" height="20">
		<td align="right"> <b> G_id :  </b> </td>
		<td> <input type="text" name="thisG_idField" size="20" value="">  </td> 
	</tr>
	<tr valign="top" height="20">
		<td align="right"> <b> User_added :  </b> </td>
		<td> <input type="text" name="thisUser_addedField" size="20" value="">  </td> 
	</tr>
	<tr valign="top" height="20">
		<td align="right"> <b> Date_added :  </b> </td>
		<td> <input type="text" name="thisDate_addedField" size="20" value="">  </td> 
	</tr>
</table>

<input type="submit" name="submitEnterGroup_editorsForm" value="Enter Group_editors">
<input type="reset" name="resetForm" value="Clear Form">

</form>

<?php
include_once("../common/footer.php");
?>