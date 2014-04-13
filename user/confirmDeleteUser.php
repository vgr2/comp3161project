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

<h2>Confirm Record Deletion</h2><br><br>

<table>
<tr height="30">
	<td align="right"><b>UserId : </b></td>
	<td><?php echo $thisUserId; ?></td>
</tr>
<tr height="30">
	<td align="right"><b>Username : </b></td>
	<td><?php echo $thisUsername; ?></td>
</tr>
<tr height="30">
	<td align="right"><b>Password : </b></td>
	<td><?php echo $thisPassword; ?></td>
</tr>
</table>

<h3>If you are sure you want to delete the above record, please press the delete button below.</h3><br><br>
<form name="userEnterForm" method="POST" action="deleteUser.php">
<input type="hidden" name="thisUserIdField" value="<?php echo $thisUserId; ?>">
<input type="submit" name="submitConfirmDeleteUserForm" value="Delete  from User">
<input type="button" name="cancel" value="Go Back" onClick="javascript:history.back();">
</form>

<?php
include_once("../common/footer.php");
?>