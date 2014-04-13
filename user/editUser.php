<?php
include_once("../common/dbConnection.php");
include_once("../common/header.php");
?>
<?php
$thisUserId = $_REQUEST['userIdField']
?>
<?php
$sql = "SELECT   * FROM user WHERE userId = '$thisUserId'";
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
	$thisUsername = MYSQL_RESULT($result,$i,"username");
	$thisPassword = MYSQL_RESULT($result,$i,"password");

}
?>

<h2>Update User</h2>
<form name="userUpdateForm" method="POST" action="updateUser.php">

<table cellspacing="2" cellpadding="2" border="0" width="100%">
	<tr valign="top" height="20">
		<td align="right"> <b> UserId :  </b> </td>
		<td> <input type="text" name="thisUserIdField" size="20" value="<?php echo $thisUserId; ?>">  </td> 
	</tr>
	<tr valign="top" height="20">
		<td align="right"> <b> Username :  </b> </td>
		<td> <input type="text" name="thisUsernameField" size="20" value="<?php echo $thisUsername; ?>">  </td> 
	</tr>
	<tr valign="top" height="20">
		<td align="right"> <b> Password :  </b> </td>
		<td> <input type="text" name="thisPasswordField" size="20" value="<?php echo $thisPassword; ?>">  </td> 
	</tr>
</table>

<input type="submit" name="submitUpdateUserForm" value="Update User">
<input type="reset" name="resetForm" value="Clear Form">

</form>

<?php
include_once("../common/footer.php");
?>