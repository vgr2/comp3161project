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

<h2>Update Friends_of</h2>
<form name="friends_ofUpdateForm" method="POST" action="updateFriends_of.php">

<table cellspacing="2" cellpadding="2" border="0" width="100%">
	<tr valign="top" height="20">
		<td align="right"> <b> FriendId :  </b> </td>
		<td> <input type="text" name="thisFriendIdField" size="20" value="<?php echo $thisFriendId; ?>">  </td> 
	</tr>
	<tr valign="top" height="20">
		<td align="right"> <b> Friends_owner :  </b> </td>
		<td> <input type="text" name="thisFriends_ownerField" size="20" value="<?php echo $thisFriends_owner; ?>">  </td> 
	</tr>
	<tr valign="top" height="20">
		<td align="right"> <b> Friend :  </b> </td>
		<td> <input type="text" name="thisFriendField" size="20" value="<?php echo $thisFriend; ?>">  </td> 
	</tr>
</table>

<input type="submit" name="submitUpdateFriends_ofForm" value="Update Friends_of">
<input type="reset" name="resetForm" value="Clear Form">

</form>

<?php
include_once("../common/footer.php");
?>