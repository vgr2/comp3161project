<?php
include_once("../common/dbConnection.php");
include_once("../common/header.php");
?>
<?php
$thisFriendtype_friendofId = $_REQUEST['friendtype_friendofIdField']
?>
<?php
$sql = "SELECT   * FROM friendtype_friendof WHERE friendtype_friendofId = '$thisFriendtype_friendofId'";
$result = MYSQL_QUERY($sql);
$numberOfRows = MYSQL_NUMROWS($result);
if ($numberOfRows==0) {  
?>

Sorry. No records found !!

<?php
}
else if ($numberOfRows>0) {

	$i=0;
	$thisFriendtype_friendofId = MYSQL_RESULT($result,$i,"friendtype_friendofId");
	$thisFriendId = MYSQL_RESULT($result,$i,"friendId");
	$thisFriend_typeId = MYSQL_RESULT($result,$i,"friend_typeId");

}
?>

<h2>Update Friendtype_friendof</h2>
<form name="friendtype_friendofUpdateForm" method="POST" action="updateFriendtype_friendof.php">

<table cellspacing="2" cellpadding="2" border="0" width="100%">
	<tr valign="top" height="20">
		<td align="right"> <b> Friendtype_friendofId :  </b> </td>
		<td> <input type="text" name="thisFriendtype_friendofIdField" size="20" value="<?php echo $thisFriendtype_friendofId; ?>">  </td> 
	</tr>
	<tr valign="top" height="20">
		<td align="right"> <b> FriendId :  </b> </td>
		<td> <input type="text" name="thisFriendIdField" size="20" value="<?php echo $thisFriendId; ?>">  </td> 
	</tr>
	<tr valign="top" height="20">
		<td align="right"> <b> Friend_typeId :  </b> </td>
		<td> <input type="text" name="thisFriend_typeIdField" size="20" value="<?php echo $thisFriend_typeId; ?>">  </td> 
	</tr>
</table>

<input type="submit" name="submitUpdateFriendtype_friendofForm" value="Update Friendtype_friendof">
<input type="reset" name="resetForm" value="Clear Form">

</form>

<?php
include_once("../common/footer.php");
?>