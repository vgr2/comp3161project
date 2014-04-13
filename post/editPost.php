<?php
include_once("../common/dbConnection.php");
include_once("../common/header.php");
?>
<?php
$thisPostId = $_REQUEST['postIdField']
?>
<?php
$sql = "SELECT   * FROM post WHERE postId = '$thisPostId'";
$result = MYSQL_QUERY($sql);
$numberOfRows = MYSQL_NUMROWS($result);
if ($numberOfRows==0) {  
?>

Sorry. No records found !!

<?php
}
else if ($numberOfRows>0) {

	$i=0;
	$thisPostId = MYSQL_RESULT($result,$i,"postId");
	$thisUserId = MYSQL_RESULT($result,$i,"userId");
	$thisTitle = MYSQL_RESULT($result,$i,"title");
	$thisPost_type = MYSQL_RESULT($result,$i,"post_type");
	$thisImage_path = MYSQL_RESULT($result,$i,"image_path");
	$thisText_body = MYSQL_RESULT($result,$i,"text_body");
	$thisDate_created = MYSQL_RESULT($result,$i,"date_created");

}
?>

<h2>Update Post</h2>
<form name="postUpdateForm" method="POST" action="updatePost.php">

<table cellspacing="2" cellpadding="2" border="0" width="100%">
	<tr valign="top" height="20">
		<td align="right"> <b> PostId :  </b> </td>
		<td> <input type="text" name="thisPostIdField" size="20" value="<?php echo $thisPostId; ?>">  </td> 
	</tr>
	<tr valign="top" height="20">
		<td align="right"> <b> UserId :  </b> </td>
		<td> <input type="text" name="thisUserIdField" size="20" value="<?php echo $thisUserId; ?>">  </td> 
	</tr>
	<tr valign="top" height="20">
		<td align="right"> <b> Title :  </b> </td>
		<td> <input type="text" name="thisTitleField" size="20" value="<?php echo $thisTitle; ?>">  </td> 
	</tr>
	<tr valign="top" height="20">
		<td align="right"> <b> Post_type :  </b> </td>
		<td> <input type="text" name="thisPost_typeField" size="20" value="<?php echo $thisPost_type; ?>">  </td> 
	</tr>
	<tr valign="top" height="20">
		<td align="right"> <b> Image_path :  </b> </td>
		<td> <input type="text" name="thisImage_pathField" size="20" value="<?php echo $thisImage_path; ?>">  </td> 
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

<input type="submit" name="submitUpdatePostForm" value="Update Post">
<input type="reset" name="resetForm" value="Clear Form">

</form>

<?php
include_once("../common/footer.php");
?>