<?php
include_once("../common/dbConnection.php");
include_once("../common/header.php");
?>
<h2>Enter Group_members</h2>
<form name="group_membersEnterForm" method="POST" action="insertNewGroup_members.php">

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
		<td align="right"> <b> Date_added :  </b> </td>
		<td> <input type="text" name="thisDate_addedField" size="20" value="">  </td> 
	</tr>
</table>

<input type="submit" name="submitEnterGroup_membersForm" value="Enter Group_members">
<input type="reset" name="resetForm" value="Clear Form">

</form>

<?php
include_once("../common/footer.php");
?>