<?php
include_once("../common/dbConnection.php");
include_once("../common/header.php");
?>
<h2>Enter User</h2>
<form name="userEnterForm" method="POST" action="insertNewUser.php">

<table cellspacing="2" cellpadding="2" border="0" width="100%">
	<tr valign="top" height="20">
		<td align="right"> <b> UserId :  </b> </td>
		<td> <input type="text" name="thisUserIdField" size="20" value="">  </td> 
	</tr>
	<tr valign="top" height="20">
		<td align="right"> <b> Username :  </b> </td>
		<td> <input type="text" name="thisUsernameField" size="20" value="">  </td> 
	</tr>
	<tr valign="top" height="20">
		<td align="right"> <b> Password :  </b> </td>
		<td> <input type="text" name="thisPasswordField" size="20" value="">  </td> 
	</tr>
</table>

<input type="submit" name="submitEnterUserForm" value="Enter User">
<input type="reset" name="resetForm" value="Clear Form">

</form>

<?php
include_once("../common/footer.php");
?>