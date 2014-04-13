<?php
include_once("../common/dbConnection.php");
include_once("../common/header.php");
?>
<?php
	// Retreiving Form Elements from Form
	$thisUserId = addslashes($_REQUEST['thisUserIdField']);
	$thisUsername = addslashes($_REQUEST['thisUsernameField']);
	$thisPassword = addslashes($_REQUEST['thisPasswordField']);

?>
<?php 
$sql = "DELETE FROM user WHERE userId = '$thisUserId'";
$result = MYSQL_QUERY($sql);

?>
Record  has been deleted from database. Here is the deleted record :-<br><br>

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

<?php
include_once("../common/footer.php");
?>