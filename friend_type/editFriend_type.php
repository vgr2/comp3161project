<?php
include_once("../common/dbConnection.php");
include_once("../common/header.php");
?>
<?php
$thisFriend_typeId = $_REQUEST['friend_typeIdField']
?>
<?php
$sql = "SELECT   * FROM friend_type WHERE friend_typeId = '$thisFriend_typeId'";
$result = MYSQL_QUERY($sql);
$numberOfRows = MYSQL_NUMROWS($result);
if ($numberOfRows==0) {  
?>

Sorry. No records found !!

<?php
}
else if ($numberOfRows>0) {

	$i=0;
	$thisFriend_typeId = MYSQL_RESULT($result,$i,"friend_typeId");
	$thisType = MYSQL_RESULT($result,$i,"type");

}
?>

<h2>Update Friend_type</h2>
<form name="friend_typeUpdateForm" method="POST" action="updateFriend_type.php">

<table cellspacing="2" cellpadding="2" border="0" width="100%">
	<tr valign="top" height="20">
		<td align="right"> <b> Friend_typeId :  </b> </td>
		<td> <input type="text" name="thisFriend_typeIdField" size="20" value="<?php echo $thisFriend_typeId; ?>">  </td> 
	</tr>
	<tr valign="top" height="20">
		<td align="right"> <b> Type :  </b> </td>
		<td> <input type="text" name="thisTypeField" size="20" value="<?php echo $thisType; ?>">  </td> 
	</tr>
</table>

<input type="submit" name="submitUpdateFriend_typeForm" value="Update Friend_type">
<input type="reset" name="resetForm" value="Clear Form">

</form>

<?php
include_once("../common/footer.php");
?>