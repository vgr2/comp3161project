<?php
include_once("../common/dbConnection.php");
include_once("../common/header.php");
?>
<?php
$thisCommentId = $_REQUEST['commentIdField']
?>
<?php
$sql = "SELECT   * FROM comment WHERE commentId = '$thisCommentId'";
$result = MYSQL_QUERY($sql);
$numberOfRows = MYSQL_NUMROWS($result);
if ($numberOfRows==0) {  
?>

Sorry. No records found !!

<?php
}
else if ($numberOfRows>0) {

	$i=0;
	$thisCommentId = MYSQL_RESULT($result,$i,"commentId");
	$thisPostId = MYSQL_RESULT($result,$i,"postId");
	$thisUserId = MYSQL_RESULT($result,$i,"userId");
	$thisContent = MYSQL_RESULT($result,$i,"content");
	$thisDate_commented = MYSQL_RESULT($result,$i,"date_commented");

}
?>

<h2>Update Comment</h2>
<form name="commentUpdateForm" method="POST" action="updateComment.php">

<table cellspacing="2" cellpadding="2" border="0" width="100%">
	<tr valign="top" height="20">
		<td align="right"> <b> CommentId :  </b> </td>
		<td> <input type="text" name="thisCommentIdField" size="20" value="<?php echo $thisCommentId; ?>">  </td> 
	</tr>
	<tr valign="top" height="20">
		<td align="right"> <b> PostId :  </b> </td>
		<td> <input type="text" name="thisPostIdField" size="20" value="<?php echo $thisPostId; ?>">  </td> 
	</tr>
	<tr valign="top" height="20">
		<td align="right"> <b> UserId :  </b> </td>
		<td> <input type="text" name="thisUserIdField" size="20" value="<?php echo $thisUserId; ?>">  </td> 
	</tr>
	<tr valign="top" height="20">
		<td align="right"> <b> Content :  </b> </td>
		<td> <input type="text" name="thisContentField" size="20" value="<?php echo $thisContent; ?>">  </td> 
	</tr>
	<tr valign="top" height="20">
		<td align="right"> <b> Date_commented :  </b> </td>
		<td> <input type="text" name="thisDate_commentedField" size="20" value="<?php echo $thisDate_commented; ?>">  </td> 
	</tr>
</table>

<input type="submit" name="submitUpdateCommentForm" value="Update Comment">
<input type="reset" name="resetForm" value="Clear Form">

</form>

<?php
include_once("../common/footer.php");
?>