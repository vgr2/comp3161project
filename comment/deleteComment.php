<?php
include_once("../common/dbConnection.php");
include_once("../common/header.php");
?>
<?php
	// Retreiving Form Elements from Form
	$thisCommentId = addslashes($_REQUEST['thisCommentIdField']);
	$thisPostId = addslashes($_REQUEST['thisPostIdField']);
	$thisUserId = addslashes($_REQUEST['thisUserIdField']);
	$thisContent = addslashes($_REQUEST['thisContentField']);
	$thisDate_commented = addslashes($_REQUEST['thisDate_commentedField']);

?>
<?php 
$sql = "DELETE FROM comment WHERE commentId = '$thisCommentId'";
$result = MYSQL_QUERY($sql);

?>
Record  has been deleted from database. Here is the deleted record :-<br><br>

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

<?php
include_once("../common/footer.php");
?>