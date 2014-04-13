<?php
include_once("../common/dbConnection.php");
include_once("../common/header.php");
?>
<?php
$thisFriendId = $_REQUEST['friendIdField']
?>
<?php
$sql = "SELECT   * FROM friends_of WHERE friendId = '$thisFriendId'";
$result = MYSQL_QUERY($sql);
$numberOfRows = MYSQL_NUMROWS($result);
if ($numberOfRows==0) {  
?>

Sorry. No records found !!

<?php
}
else if ($numberOfRows>0) {

	$i=0;
	$thisFriendId = MYSQL_RESULT($result,$i,"friendId");
	$thisFriends_owner = MYSQL_RESULT($result,$i,"friends_owner");
	$thisFriend = MYSQL_RESULT($result,$i,"friend");

}
?>

View Record<br><br>

<table>
<tr height="30">
	<td align="right"><b>FriendId : </b></td>
	<td><?php echo $thisFriendId; ?></td>
</tr>
<tr height="30">
	<td align="right"><b>Friends_owner : </b></td>
	<td><?php echo $thisFriends_owner; ?></td>
</tr>
<tr height="30">
	<td align="right"><b>Friend : </b></td>
	<td><?php echo $thisFriend; ?></td>
</tr>
</table>

<?php
include_once("../common/footer.php");
?>