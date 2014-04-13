<?php
include_once("../common/dbConnection.php");
include_once("../common/header.php");
?>
<h2>Enter Friend_type</h2>
<form name="friend_typeEnterForm" method="POST" action="insertNewFriend_type.php">

<table cellspacing="2" cellpadding="2" border="0" width="100%">
	<tr valign="top" height="20">
		<td align="right"> <b> Friend_typeId :  </b> </td>
		<td> <input type="text" name="thisFriend_typeIdField" size="20" value="">  </td> 
	</tr>
	<tr valign="top" height="20">
		<td align="right"> <b> Type :  </b> </td>
		<td> <input type="text" name="thisTypeField" size="20" value="">  </td> 
	</tr>
</table>

<input type="submit" name="submitEnterFriend_typeForm" value="Enter Friend_type">
<input type="reset" name="resetForm" value="Clear Form">

</form>

<?php
include_once("../common/footer.php");
?>