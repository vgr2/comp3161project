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

View Record<br><br>

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