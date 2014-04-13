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
$sqlQuery = "INSERT INTO user (userId , username , password ) VALUES ('$thisUserId' , '$thisUsername' , '$thisPassword' )";
$result = MYSQL_QUERY($sqlQuery);

?>
A new record has been inserted in the database. Here is the information that has been inserted :- <br><br>

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