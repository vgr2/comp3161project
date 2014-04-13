<?php
include_once("../common/dbConnection.php");
include_once("../common/header.php");
?>
<h2>Enter Friendtype_friendof</h2>
<form name="friendtype_friendofEnterForm" method="POST" action="insertNewFriendtype_friendof.php">

<table cellspacing="2" cellpadding="2" border="0" width="100%">
	<tr valign="top" height="20">
		<td align="right"> <b> Friendtype_friendofId :  </b> </td>
		<td> <input type="text" name="thisFriendtype_friendofIdField" size="20" value="">  </td> 
	</tr>
	<tr valign="top" height="20">
		<td align="right"> <b> FriendId :  </b> </td>
		<td> <input type="text" name="thisFriendIdField" size="20" value="">  </td> 
	</tr>
	<tr valign="top" height="20">
		<td align="right"> <b> Friend_typeId :  </b> </td>
		<td> <input type="text" name="thisFriend_typeIdField" size="20" value="">  </td> 
	</tr>
</table>

<input type="submit" name="submitEnterFriendtype_friendofForm" value="Enter Friendtype_friendof">
<input type="reset" name="resetForm" value="Clear Form">

</form>

<?php
include_once("../common/footer.php");
?>