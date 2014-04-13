<?php
include_once("../common/dbConnection.php");
include_once("../common/header.php");
?>
<?php
$thisUserId = $_REQUEST['userIdField']
?>
<?php
$sql = "SELECT   * FROM profile WHERE userId = '$thisUserId'";
$result = MYSQL_QUERY($sql);
$numberOfRows = MYSQL_NUMROWS($result);
if ($numberOfRows==0) {  
?>

Sorry. No records found !!

<?php
}
else if ($numberOfRows>0) {

	$i=0;
	$thisUserId = MYSQL_RESULT($result,$i,"userId");
	$thisProfileId = MYSQL_RESULT($result,$i,"profileId");
	$thisStatus = MYSQL_RESULT($result,$i,"status");
	$thisFname = MYSQL_RESULT($result,$i,"fname");
	$thisLname = MYSQL_RESULT($result,$i,"lname");
	$thisEmail = MYSQL_RESULT($result,$i,"email");
	$thisDob = MYSQL_RESULT($result,$i,"dob");
	$thisProfile_pic = MYSQL_RESULT($result,$i,"profile_pic");

}
?>

<h2>Update Profile</h2>
<form name="profileUpdateForm" method="POST" action="updateProfile.php">

<table cellspacing="2" cellpadding="2" border="0" width="100%">
	<tr valign="top" height="20">
		<td align="right"> <b> UserId :  </b> </td>
		<td> <input type="text" name="thisUserIdField" size="20" value="<?php echo $thisUserId; ?>">  </td> 
	</tr>
	<tr valign="top" height="20">
		<td align="right"> <b> ProfileId :  </b> </td>
		<td> <input type="text" name="thisProfileIdField" size="20" value="<?php echo $thisProfileId; ?>">  </td> 
	</tr>
	<tr valign="top" height="20">
		<td align="right"> <b> Status :  </b> </td>
		<td> <input type="text" name="thisStatusField" size="20" value="<?php echo $thisStatus; ?>">  </td> 
	</tr>
	<tr valign="top" height="20">
		<td align="right"> <b> Fname :  </b> </td>
		<td> <input type="text" name="thisFnameField" size="20" value="<?php echo $thisFname; ?>">  </td> 
	</tr>
	<tr valign="top" height="20">
		<td align="right"> <b> Lname :  </b> </td>
		<td> <input type="text" name="thisLnameField" size="20" value="<?php echo $thisLname; ?>">  </td> 
	</tr>
	<tr valign="top" height="20">
		<td align="right"> <b> Email :  </b> </td>
		<td> <input type="text" name="thisEmailField" size="20" value="<?php echo $thisEmail; ?>">  </td> 
	</tr>
	<tr valign="top" height="20">
		<td align="right"> <b> Dob :  </b> </td>
		<td> <input type="text" name="thisDobField" size="20" value="<?php echo $thisDob; ?>">  </td> 
	</tr>
	<tr valign="top" height="20">
		<td align="right"> <b> Profile_pic :  </b> </td>
		<td> <input type="text" name="thisProfile_picField" size="20" value="<?php echo $thisProfile_pic; ?>">  </td> 
	</tr>
</table>

<input type="submit" name="submitUpdateProfileForm" value="Update Profile">
<input type="reset" name="resetForm" value="Clear Form">

</form>

<?php
include_once("../common/footer.php");
?>