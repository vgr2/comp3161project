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
$sql = "UPDATE user SET userId = '$thisUserId' , username = '$thisUsername' , password = '$thisPassword'  WHERE userId = '$thisUserId'";
$result = MYSQL_QUERY($sql);

?>
Record  has been updated in the database. Here is the updated information :- <br><br>

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
<br><br><a href="listUser.php">Go Back to List All Records</a>

<?php
include_once("../common/footer.php");
?>