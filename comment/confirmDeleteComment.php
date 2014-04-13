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

<h2>Confirm Record Deletion</h2><br><br>

<table>
<tr height="30">
	<td align="right"><b>CommentId : </b></td>
	<td><?php echo $thisCommentId; ?></td>
</tr>
<tr height="30">
	<td align="right"><b>PostId : </b></td>
	<td><?php echo $thisPostId; ?></td>
</tr>
<tr height="30">
	<td align="right"><b>UserId : </b></td>
	<td><?php echo $thisUserId; ?></td>
</tr>
<tr height="30">
	<td align="right"><b>Content : </b></td>
	<td><?php echo $thisContent; ?></td>
</tr>
<tr height="30">
	<td align="right"><b>Date_commented : </b></td>
	<td><?php echo $thisDate_commented; ?></td>
</tr>
</table>

<h3>If you are sure you want to delete the above record, please press the delete button below.</h3><br><br>
<form name="commentEnterForm" method="POST" action="deleteComment.php">
<input type="hidden" name="thisCommentIdField" value="<?php echo $thisCommentId; ?>">
<input type="submit" name="submitConfirmDeleteCommentForm" value="Delete  from Comment">
<input type="button" name="cancel" value="Go Back" onClick="javascript:history.back();">
</form>

<?php
include_once("../common/footer.php");
?>