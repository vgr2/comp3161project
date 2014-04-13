<?php
include_once("../common/dbConnection.php");
include_once("../common/header.php");
?>
<?php
$thisG_id = $_REQUEST['g_idField']
?>
<?php
$sql = "SELECT   * FROM group_post WHERE g_id = '$thisG_id'";
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
	$thisGpostId = MYSQL_RESULT($result,$i,"gpostId");
	$thisTitle = MYSQL_RESULT($result,$i,"title");
	$thisG_post_type = MYSQL_RESULT($result,$i,"g_post_type");
	$thisG_image_path = MYSQL_RESULT($result,$i,"g_image_path");
	$thisText_body = MYSQL_RESULT($result,$i,"text_body");
	$thisDate_created = MYSQL_RESULT($result,$i,"date_created");

}
?>

<h2>Update Group_post</h2>
<form name="group_postUpdateForm" method="POST" action="updateGroup_post.php">

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
		<td align="right"> <b> GpostId :  </b> </td>
		<td> <input type="text" name="thisGpostIdField" size="20" value="<?php echo $thisGpostId; ?>">  </td> 
	</tr>
	<tr valign="top" height="20">
		<td align="right"> <b> Title :  </b> </td>
		<td> <input type="text" name="thisTitleField" size="20" value="<?php echo $thisTitle; ?>">  </td> 
	</tr>
	<tr valign="top" height="20">
		<td align="right"> <b> G_post_type :  </b> </td>
		<td> <input type="text" name="thisG_post_typeField" size="20" value="<?php echo $thisG_post_type; ?>">  </td> 
	</tr>
	<tr valign="top" height="20">
		<td align="right"> <b> G_image_path :  </b> </td>
		<td> <input type="text" name="thisG_image_pathField" size="20" value="<?php echo $thisG_image_path; ?>">  </td> 
	</tr>
	<tr valign="top" height="20">
		<td align="right"> <b> Text_body :  </b> </td>
		<td> <input type="text" name="thisText_bodyField" size="20" value="<?php echo $thisText_body; ?>">  </td> 
	</tr>
	<tr valign="top" height="20">
		<td align="right"> <b> Date_created :  </b> </td>
		<td> <input type="text" name="thisDate_createdField" size="20" value="<?php echo $thisDate_created; ?>">  </td> 
	</tr>
</table>

<input type="submit" name="submitUpdateGroup_postForm" value="Update Group_post">
<input type="reset" name="resetForm" value="Clear Form">

</form>

<?php
include_once("../common/footer.php");
?>