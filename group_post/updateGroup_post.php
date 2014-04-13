<?php
include_once("../common/dbConnection.php");
include_once("../common/header.php");
?>
<?php
	// Retreiving Form Elements from Form
	$thisG_id = addslashes($_REQUEST['thisG_idField']);
	$thisUserId = addslashes($_REQUEST['thisUserIdField']);
	$thisGpostId = addslashes($_REQUEST['thisGpostIdField']);
	$thisTitle = addslashes($_REQUEST['thisTitleField']);
	$thisG_post_type = addslashes($_REQUEST['thisG_post_typeField']);
	$thisG_image_path = addslashes($_REQUEST['thisG_image_pathField']);
	$thisText_body = addslashes($_REQUEST['thisText_bodyField']);
	$thisDate_created = addslashes($_REQUEST['thisDate_createdField']);

?>
<?php 
$sql = "UPDATE group_post SET g_id = '$thisG_id' , userId = '$thisUserId' , gpostId = '$thisGpostId' , title = '$thisTitle' , g_post_type = '$thisG_post_type' , g_image_path = '$thisG_image_path' , text_body = '$thisText_body' , date_created = '$thisDate_created'  WHERE g_id = '$thisG_id'";
$result = MYSQL_QUERY($sql);

?>
Record  has been updated in the database. Here is the updated information :- <br><br>

<table>
<tr height="30">
	<td align="right"><b>G_id : </b></td>
	<td><?php echo $thisG_id; ?></td>
</tr>
<tr height="30">
	<td align="right"><b>UserId : </b></td>
	<td><?php echo $thisUserId; ?></td>
</tr>
<tr height="30">
	<td align="right"><b>GpostId : </b></td>
	<td><?php echo $thisGpostId; ?></td>
</tr>
<tr height="30">
	<td align="right"><b>Title : </b></td>
	<td><?php echo $thisTitle; ?></td>
</tr>
<tr height="30">
	<td align="right"><b>G_post_type : </b></td>
	<td><?php echo $thisG_post_type; ?></td>
</tr>
<tr height="30">
	<td align="right"><b>G_image_path : </b></td>
	<td><?php echo $thisG_image_path; ?></td>
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
<br><br><a href="listGroup_post.php">Go Back to List All Records</a>

<?php
include_once("../common/footer.php");
?>