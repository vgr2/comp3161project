<?php
include_once("../common/dbConnection.php");
include_once("../common/header.php");
?>
<h2>Enter Group_table</h2>
<form name="group_tableEnterForm" method="POST" action="insertNewGroup_table.php">

<table cellspacing="2" cellpadding="2" border="0" width="100%">
	<tr valign="top" height="20">
		<td align="right"> <b> G_id :  </b> </td>
		<td> <input type="text" name="thisG_idField" size="20" value="">  </td> 
	</tr>
	<tr valign="top" height="20">
		<td align="right"> <b> UserId :  </b> </td>
		<td> <input type="text" name="thisUserIdField" size="20" value="">  </td> 
	</tr>
	<tr valign="top" height="20">
		<td align="right"> <b> Group_name :  </b> </td>
		<td> <input type="text" name="thisGroup_nameField" size="20" value="">  </td> 
	</tr>
	<tr valign="top" height="20">
		<td align="right"> <b> Date_created :  </b> </td>
		<td> <input type="text" name="thisDate_createdField" size="20" value="">  </td> 
	</tr>
</table>

<input type="submit" name="submitEnterGroup_tableForm" value="Enter Group_table">
<input type="reset" name="resetForm" value="Clear Form">

</form>

<?php
include_once("../common/footer.php");
?>