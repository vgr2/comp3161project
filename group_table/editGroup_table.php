<?php
include_once("../common/dbConnection.php");
include_once("../common/header.php");
?>
<?php
$thisG_id = $_REQUEST['g_idField']
?>
<?php
$sql = "SELECT   * FROM group_table WHERE g_id = '$thisG_id'";
$result = MYSQL_QUERY($sql);
$numberOfRows = MYSQL_NUMROWS($result);
if ($numberOfRows==0) {  
?>

Sorry. No records found !!

<?php
}
else if ($numberOfRows>0) {

	$i=0;
	$thisG_id = MYSQL_RESULT($result,$i,"g_id");
	$thisUserId = MYSQL_RESULT($result,$i,"userId");
	$thisGroup_name = MYSQL_RESULT($result,$i,"group_name");
	$thisDate_created = MYSQL_RESULT($result,$i,"date_created");

}
?>

<h2>Update Group_table</h2>
<form name="group_tableUpdateForm" method="POST" action="updateGroup_table.php">

<table cellspacing="2" cellpadding="2" border="0" width="100%">
	<tr valign="top" height="20">
		<td align="right"> <b> G_id :  </b> </td>
		<td> <input type="text" name="thisG_idField" size="20" value="<?php echo $thisG_id; ?>">  </td> 
	</tr>
	<tr valign="top" height="20">
		<td align="right"> <b> UserId :  </b> </td>
		<td> <input type="text" name="thisUserIdField" size="20" value="<?php echo $thisUserId; ?>">  </td> 
	</tr>
	<tr valign="top" height="20">
		<td align="right"> <b> Group_name :  </b> </td>
		<td> <input type="text" name="thisGroup_nameField" size="20" value="<?php echo $thisGroup_name; ?>">  </td> 
	</tr>
	<tr valign="top" height="20">
		<td align="right"> <b> Date_created :  </b> </td>
		<td> <input type="text" name="thisDate_createdField" size="20" value="<?php echo $thisDate_created; ?>">  </td> 
	</tr>
</table>

<input type="submit" name="submitUpdateGroup_tableForm" value="Update Group_table">
<input type="reset" name="resetForm" value="Clear Form">

</form>

<?php
include_once("../common/footer.php");
?>