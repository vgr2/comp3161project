<?php
include_once("../common/dbConnection.php");
include_once("../common/setup.php");
?>
<?php
	// Retreiving Form Elements from Form
	$thisPostId = addslashes($_REQUEST['thisPostIdField']);
	$thisUserId = addslashes($_REQUEST['thisUserIdField']);
	$thisContent = addslashes($_REQUEST['thisContentField']);
	$thisDate_commented = addslashes($_REQUEST['thisDate_commentedField']);
        $refpage = htmlentities($_REQUEST['refpage']);

?>
<?php 
$sqlQuery = "insert into comment ( postId , userId , content , date_commented ) values ( '$thisPostId' , '$thisUserId' , '$thisContent' , '$thisDate_commented' )";
$result = $db->query($sqlQuery);
header("Location: ".$refpage);//../index.php");

?>
A new record has been inserted in the database. Here is the information that has been inserted :- <br><br>

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