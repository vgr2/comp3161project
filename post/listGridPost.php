<?php
include_once("../common/dbConnection.php");
include_once("../common/header.php");
?>
<?php 
$thisPostIdFromForm = $_REQUEST['thisPostIdField'];
$thisAction = $_REQUEST['action'];
if ($thisAction=="Update")
{
	// Retreiving Form Elements from Form
	$thisPostId = addslashes($_REQUEST['thisPostIdField']);
	$thisUserId = addslashes($_REQUEST['thisUserIdField']);
	$thisTitle = addslashes($_REQUEST['thisTitleField']);
	$thisPost_type = addslashes($_REQUEST['thisPost_typeField']);
	$thisImage_path = addslashes($_REQUEST['thisImage_pathField']);
	$thisText_body = addslashes($_REQUEST['thisText_bodyField']);
	$thisDate_created = addslashes($_REQUEST['thisDate_createdField']);

	$sqlUpdate = "UPDATE post SET postId = '$thisPostId' , userId = '$thisUserId' , title = '$thisTitle' , post_type = '$thisPost_type' , image_path = '$thisImage_path' , text_body = '$thisText_body' , date_created = '$thisDate_created'  WHERE postId = '$thisPostId'";
	$resultUpdate = MYSQL_QUERY($sqlUpdate);
	echo "<b>Record with Id ".$thisPostIdFromForm." has been Updated<br></b>";
	$thisPostIdFromForm = "";
}

if ($thisAction=="Insert")
{
	// Retreiving Form Elements from Form
	$thisPostId = addslashes($_REQUEST['thisPostIdField']);
	$thisUserId = addslashes($_REQUEST['thisUserIdField']);
	$thisTitle = addslashes($_REQUEST['thisTitleField']);
	$thisPost_type = addslashes($_REQUEST['thisPost_typeField']);
	$thisImage_path = addslashes($_REQUEST['thisImage_pathField']);
	$thisText_body = addslashes($_REQUEST['thisText_bodyField']);
	$thisDate_created = addslashes($_REQUEST['thisDate_createdField']);

	$sqlInsert = "INSERT INTO post (postId , userId , title , post_type , image_path , text_body , date_created ) VALUES ('$thisPostId' , '$thisUserId' , '$thisTitle' , '$thisPost_type' , '$thisImage_path' , '$thisText_body' , '$thisDate_created' )";
	$resultInsert = MYSQL_QUERY($sqlInsert);
	echo "<b>Record has been inserted in Database<br></b>";
	$thisPostIdFromForm = "";
}

if ($thisAction=="Delete")
{
	// Retreiving Form Elements from Form
	$thisPostId = addslashes($_REQUEST['thisPostIdField']);
	$thisUserId = addslashes($_REQUEST['thisUserIdField']);
	$thisTitle = addslashes($_REQUEST['thisTitleField']);
	$thisPost_type = addslashes($_REQUEST['thisPost_typeField']);
	$thisImage_path = addslashes($_REQUEST['thisImage_pathField']);
	$thisText_body = addslashes($_REQUEST['thisText_bodyField']);
	$thisDate_created = addslashes($_REQUEST['thisDate_createdField']);

	$sqlDelete = "DELETE FROM post WHERE postId = '$thisPostId'";
	$resultDelete = MYSQL_QUERY($sqlDelete);

	echo "<b>Record with Id ".$thisPostIdFromForm." has been Deleted<br></b>";
	$thisPostIdFromForm = "";
}

$initStartLimit = 0;
$limitPerPage = 10;

$startLimit = $_REQUEST['startLimit'];
$numberOfRows = $_REQUEST['rows'];
$sortBy = $_REQUEST['sortBy'];
$sortOrder = $_REQUEST['sortOrder'];

if ($startLimit=="")
{
		$startLimit = $initStartLimit;
}

if ($numberOfRows=="")
{
		$numberOfRows = $limitPerPage;
}

if ($sortOrder=="")
{
		$sortOrder  = "DESC";
}
if ($sortOrder == "DESC") { $newSortOrder = "ASC"; } else  { $newSortOrder = "DESC"; }
$limitQuery = " LIMIT ".$startLimit.",".$numberOfRows;
$nextStartLimit = $startLimit + $limitPerPage;
$previousStartLimit = $startLimit - $limitPerPage;

if ($sortBy!="")
{
		$orderByQuery = " ORDER BY ".$sortBy." ".$sortOrder;
}


$sql = "SELECT   * FROM post".$orderByQuery.$limitQuery;
$result = MYSQL_QUERY($sql);
$numberOfRows = MYSQL_NUM_ROWS($result);


?>
<?php 
if ($numberOfRows==0) {  
?>

Sorry. No records found !!

<?php 
}
else if ($numberOfRows>0) {

	$i=0;
?>


<br>
<?php 
if ($_REQUEST['startLimit'] != "")
{
?>

<a href="<?php echo  $_SERVER['PHP_SELF']; ?>?startLimit=<?php echo $previousStartLimit; ?>&limitPerPage=<?php echo $limitPerPage; ?>&sortBy=<?php echo $sortBy; ?>&sortOrder=<?php echo $sortOrder; ?>">Previous <?php echo $limitPerPage; ?> Results</a>....
<?php } ?>
<?php 
if ($numberOfRows == $limitPerPage)
{
?>
<a href="<?php echo $_SERVER['PHP_SELF']; ?>?startLimit=<?php echo $nextStartLimit; ?>&limitPerPage=<?php echo $limitPerPage; ?>&sortBy=<?php echo $sortBy; ?>&sortOrder=<?php echo $sortOrder; ?>">Next <?php echo $limitPerPage; ?> Results</a>
<?php } ?>

<br><br>
<TABLE CELLSPACING="0" CELLPADDING="3" BORDER="0" WIDTH="100%">
	<TR>
		<TD>
			<a href="<?php echo $PHP_SELF; ?>?sortBy=postId&sortOrder=<?php echo $newSortOrder; ?>&startLimit=<?php echo $startLimit; ?>&rows=<?php echo $limitPerPage; ?>">
				<B>PostId</B>
			</a>
</TD>
		<TD>
			<a href="<?php echo $PHP_SELF; ?>?sortBy=userId&sortOrder=<?php echo $newSortOrder; ?>&startLimit=<?php echo $startLimit; ?>&rows=<?php echo $limitPerPage; ?>">
				<B>UserId</B>
			</a>
</TD>
		<TD>
			<a href="<?php echo $PHP_SELF; ?>?sortBy=title&sortOrder=<?php echo $newSortOrder; ?>&startLimit=<?php echo $startLimit; ?>&rows=<?php echo $limitPerPage; ?>">
				<B>Title</B>
			</a>
</TD>
		<TD>
			<a href="<?php echo $PHP_SELF; ?>?sortBy=post_type&sortOrder=<?php echo $newSortOrder; ?>&startLimit=<?php echo $startLimit; ?>&rows=<?php echo $limitPerPage; ?>">
				<B>Post_type</B>
			</a>
</TD>
		<TD>
			<a href="<?php echo $PHP_SELF; ?>?sortBy=image_path&sortOrder=<?php echo $newSortOrder; ?>&startLimit=<?php echo $startLimit; ?>&rows=<?php echo $limitPerPage; ?>">
				<B>Image_path</B>
			</a>
</TD>
		<TD>
			<a href="<?php echo $PHP_SELF; ?>?sortBy=text_body&sortOrder=<?php echo $newSortOrder; ?>&startLimit=<?php echo $startLimit; ?>&rows=<?php echo $limitPerPage; ?>">
				<B>Text_body</B>
			</a>
</TD>
		<TD>
			<a href="<?php echo $PHP_SELF; ?>?sortBy=date_created&sortOrder=<?php echo $newSortOrder; ?>&startLimit=<?php echo $startLimit; ?>&rows=<?php echo $limitPerPage; ?>">
				<B>Date_created</B>
			</a>
</TD>
	</TR>
<?php 
if ($thisAction=="EnterNew")
{
?>
<FORM NAME="insertForm" METHOD="POST" ACTION="<?php echo $_SERVER['PHP_SELF']; ?>">
<input type="hidden" name="action" value="Insert">
<input type="hidden" name="thisPostIdField" value="<?php echo $thisPostId; ?>">
	<TR BGCOLOR="#FF6666">
		<TD><input type"text" name="thisPostIdField" value=""></TD>
		<TD><input type"text" name="thisUserIdField" value=""></TD>
		<TD><input type"text" name="thisTitleField" value=""></TD>
		<TD><input type"text" name="thisPost_typeField" value=""></TD>
		<TD><input type"text" name="thisImage_pathField" value=""></TD>
		<TD><input type"text" name="thisText_bodyField" value=""></TD>
		<TD><input type"text" name="thisDate_createdField" value=""></TD>
	<TD COLSPAN=2><input type="submit" name="Insert" Value="Insert Record"> </TD>
	</TR>
</FORM>

<?php 
 } 
?>
<?php 
	while ($i<$numberOfRows)
	{

		if (($i%2)==0) { $bgColor = "#FFFFFF"; } else { $bgColor = "#C0C0C0"; }

	$thisPostId = MYSQL_RESULT($result,$i,"postId");
	$thisUserId = MYSQL_RESULT($result,$i,"userId");
	$thisTitle = MYSQL_RESULT($result,$i,"title");
	$thisPost_type = MYSQL_RESULT($result,$i,"post_type");
	$thisImage_path = MYSQL_RESULT($result,$i,"image_path");
	$thisText_body = MYSQL_RESULT($result,$i,"text_body");
	$thisDate_created = MYSQL_RESULT($result,$i,"date_created");
if ($thisPostIdFromForm == $thisPostId)
{

?>
<FORM NAME="editForm" METHOD="POST" ACTION="<?php echo $_SERVER['PHP_SELF']; ?>">
<input type="hidden" name="action" value="Update">
<input type="hidden" name="thisPostIdField" value="<?php echo $thisPostId; ?>">
	<TR BGCOLOR="<?php echo $bgColor; ?>">
		<TD><input type"text" name="thisPostIdField" value="<?php echo $thisPostId; ?>"></TD>
		<TD><input type"text" name="thisUserIdField" value="<?php echo $thisUserId; ?>"></TD>
		<TD><input type"text" name="thisTitleField" value="<?php echo $thisTitle; ?>"></TD>
		<TD><input type"text" name="thisPost_typeField" value="<?php echo $thisPost_type; ?>"></TD>
		<TD><input type"text" name="thisImage_pathField" value="<?php echo $thisImage_path; ?>"></TD>
		<TD><input type"text" name="thisText_bodyField" value="<?php echo $thisText_body; ?>"></TD>
		<TD><input type"text" name="thisDate_createdField" value="<?php echo $thisDate_created; ?>"></TD>
	<TD COLSPAN=2><input type="button" name="Save" Value="Save" onClick="this.form.submit();"> </TD>
	</TR>
</FORM>

<?php 
} else { 
?>
	<TR BGCOLOR="<?php echo $bgColor; ?>">
		<TD><?php echo $thisPostId; ?></TD>
		<TD><?php echo $thisUserId; ?></TD>
		<TD><?php echo $thisTitle; ?></TD>
		<TD><?php echo $thisPost_type; ?></TD>
		<TD><?php echo $thisImage_path; ?></TD>
		<TD><?php echo $thisText_body; ?></TD>
		<TD><?php echo $thisDate_created; ?></TD>
	<TD><a href="<?php echo $_SERVER['PHP_SELF']; ?>?action=Edit&thisPostIdField=<?php echo $thisPostId; ?>">Edit</a></TD>
	<TD><a href="<?php echo $_SERVER['PHP_SELF']; ?>?action=Delete&thisPostIdField=<?php echo $thisPostId; ?>">Delete</a></TD>
	</TR>

<?php 
}
?>
<?php 
		$i++;

	} // end while loop
?>
</TABLE>
<FORM NAME="insertForm" METHOD="POST" ACTION="<?php echo $_SERVER['PHP_SELF']; ?>">
<input type="hidden" name="action" value="EnterNew">
<input type="Submit" name="submit" value="Insert New Record">
</FORM>


<br>
<?php 
if ($_REQUEST['startLimit'] != "")
{
?>

<a href="<?php echo  $_SERVER['PHP_SELF']; ?>?startLimit=<?php echo $previousStartLimit; ?>&limitPerPage=<?php echo $limitPerPage; ?>&sortBy=<?php echo $sortBy; ?>&sortOrder=<?php echo $sortOrder; ?>">Previous <?php echo $limitPerPage; ?> Results</a>....
<?php } ?>
<?php 
if ($numberOfRows == $limitPerPage)
{
?>
<a href="<?php echo $_SERVER['PHP_SELF']; ?>?startLimit=<?php echo $nextStartLimit; ?>&limitPerPage=<?php echo $limitPerPage; ?>&sortBy=<?php echo $sortBy; ?>&sortOrder=<?php echo $sortOrder; ?>">Next <?php echo $limitPerPage; ?> Results</a>
<?php } ?>

<br><br>
<?php 
} // end of if numberOfRows > 0 
 ?>

<?php
include_once("../common/footer.php");
?>