<?php
include_once("../common/dbConnection.php");
include_once("../common/header.php");
?>
<?php
$thisG_id = $_REQUEST['g_idField']
?>
<?php
$sql = "SELECT   * FROM group_editors WHERE g_id = '$thisG_id'";
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
	$thisUser_added = MYSQL_RESULT($result,$i,"user_added");
	$thisDate_added = MYSQL_RESULT($result,$i,"date_added");

}
?>

<h2>Update Group_editors</h2>
<form name="group_editorsUpdateForm" method="POST" action="updateGroup_editors.php">

<table cellspacing="2" cellpadding="2" border="0" width="100%">
	<tr valign="top" height="20">
		<td align="right"> <b> G_id :  </b> </td>
		<td> <input type="text" name="thisG_idField" size="20" value="<?php echo $thisG_id; ?>">  </td> 
	</tr>
	<tr valign="top" height="20">
		<td align="right"> <b> User_added :  </b> </td>
		<td> <input type="text" name="thisUser_addedField" size="20" value="<?php echo $thisUser_added; ?>">  </td> 
	</tr>
	<tr valign="top" height="20">
		<td align="right"> <b> Date_added :  </b> </td>
		<td> <input type="text" name="thisDate_addedField" size="20" value="<?php echo $thisDate_added; ?>">  </td> 
	</tr>
</table>

<input type="submit" name="submitUpdateGroup_editorsForm" value="Update Group_editors">
<input type="reset" name="resetForm" value="Clear Form">

</form>

<?php
include_once("../common/footer.php");
?>