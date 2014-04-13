<?php
include_once("../common/dbConnection.php");
include_once("../common/header.php");
?>
<h2>Enter Friends_of</h2>
<form name="friends_ofEnterForm" method="POST" action="insertNewFriends_of.php">

<table cellspacing="2" cellpadding="2" border="0" width="100%">
	<tr valign="top" height="20">
		<td align="right"> <b> FriendId :  </b> </td>
		<td> <input type="text" name="thisFriendIdField" size="20" value="">  </td> 
	</tr>
	<tr valign="top" height="20">
		<td align="right"> <b> Friends_owner :  </b> </td>
		<td> <input type="text" name="thisFriends_ownerField" size="20" value="">  </td> 
	</tr>
	<tr valign="top" height="20">
		<td align="right"> <b> Friend :  </b> </td>
		<td> <input type="text" name="thisFriendField" size="20" value="">  </td> 
	</tr>
</table>

<input type="submit" name="submitEnterFriends_ofForm" value="Enter Friends_of">
<input type="reset" name="resetForm" value="Clear Form">

</form>

<?php
include_once("../common/footer.php");
?>