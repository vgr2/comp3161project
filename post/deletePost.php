<?php
include_once("../common/dbConnection.php");
include_once("../common/header.php");
?>
<?php
	// Retreiving Form Elements from Form
	$thisPostId = addslashes($_REQUEST['thisPostIdField']);
	$thisUserId = addslashes($_REQUEST['thisUserIdField']);
	$thisTitle = addslashes($_REQUEST['thisTitleField']);
	$thisPost_type = addslashes($_REQUEST['thisPost_typeField']);
	$thisImage_path = addslashes($_REQUEST['thisImage_pathField']);
	$thisText_body = addslashes($_REQUEST['thisText_bodyField']);
	$thisDate_created = addslashes($_REQUEST['thisDate_createdField']);

?>
<?php 
$sql = "DELETE FROM post WHERE postId = '$thisPostId'";
$result = MYSQL_QUERY($sql);

?>
Record  has been deleted from database. Here is the deleted record :-<br><br>

<table>
<tr height="30">
	<td align="right"><b>PostId : </b></td>
	<td><?php echo $thisPostId; ?></td>
</tr>
<tr height="30">
	<td align="right"><b>UserId : </b></td>
	<td><?php echo $thisUserId; ?></td>
</tr>
<tr height="30">
	<td align="right"><b>Title : </b></td>
	<td><?php echo $thisTitle; ?></td>
</tr>
<tr height="30">
	<td align="right"><b>Post_type : </b></td>
	<td><?php echo $thisPost_type; ?></td>
</tr>
<tr height="30">
	<td align="right"><b>Image_path : </b></td>
	<td><?php echo $thisImage_path; ?></td>
</tr>
<tr height="30">
	<td align="right"><b>Text_body : </b></td>
	<td><?php echo $thisText_body; ?></td>
</tr>
<tr height="30">
	<td align="right"><b>Date_created : </b></td>
	<td><?php echo $thisDate_created; ?></td>
</tr>
</table>

<?php
include_once("../common/footer.php");
?>