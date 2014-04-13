<?php
include_once("../common/dbConnection.php");
include_once("../common/header.php");
?>
<h2>Enter Profile</h2>
<form name="profileEnterForm" method="POST" action="insertNewProfile.php">

<table cellspacing="2" cellpadding="2" border="0" width="100%">
	<tr valign="top" height="20">
		<td align="right"> <b> UserId :  </b> </td>
		<td> <input type="text" name="thisUserIdField" size="20" value="">  </td> 
	</tr>
	<tr valign="top" height="20">
		<td align="right"> <b> ProfileId :  </b> </td>
		<td> <input type="text" name="thisProfileIdField" size="20" value="">  </td> 
	</tr>
	<tr valign="top" height="20">
		<td align="right"> <b> Status :  </b> </td>
		<td> <input type="text" name="thisStatusField" size="20" value="">  </td> 
	</tr>
	<tr valign="top" height="20">
		<td align="right"> <b> Fname :  </b> </td>
		<td> <input type="text" name="thisFnameField" size="20" value="">  </td> 
	</tr>
	<tr valign="top" height="20">
		<td align="right"> <b> Lname :  </b> </td>
		<td> <input type="text" name="thisLnameField" size="20" value="">  </td> 
	</tr>
	<tr valign="top" height="20">
		<td align="right"> <b> Email :  </b> </td>
		<td> <input type="text" name="thisEmailField" size="20" value="">  </td> 
	</tr>
	<tr valign="top" height="20">
		<td align="right"> <b> Dob :  </b> </td>
		<td> <input type="text" name="thisDobField" size="20" value="">  </td> 
	</tr>
	<tr valign="top" height="20">
		<td align="right"> <b> Profile_pic :  </b> </td>
		<td> <input type="text" name="thisProfile_picField" size="20" value="">  </td> 
	</tr>
</table>

<input type="submit" name="submitEnterProfileForm" value="Enter Profile">
<input type="reset" name="resetForm" value="Clear Form">

</form>

<?php
include_once("../common/footer.php");
?>