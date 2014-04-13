<?php
include_once("../common/dbConnection.php");
include_once("../common/header.php");
?>
<?php 
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


$sql = "SELECT   * FROM group_post".$orderByQuery.$limitQuery;
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
			<a href="<?php echo $PHP_SELF; ?>?sortBy=g_id&sortOrder=<?php echo $newSortOrder; ?>&startLimit=<?php echo $startLimit; ?>&rows=<?php echo $limitPerPage; ?>">
				<B>G_id</B>
			</a>
</TD>
		<TD>
			<a href="<?php echo $PHP_SELF; ?>?sortBy=userId&sortOrder=<?php echo $newSortOrder; ?>&startLimit=<?php echo $startLimit; ?>&rows=<?php echo $limitPerPage; ?>">
				<B>UserId</B>
			</a>
</TD>
		<TD>
			<a href="<?php echo $PHP_SELF; ?>?sortBy=gpostId&sortOrder=<?php echo $newSortOrder; ?>&startLimit=<?php echo $startLimit; ?>&rows=<?php echo $limitPerPage; ?>">
				<B>GpostId</B>
			</a>
</TD>
		<TD>
			<a href="<?php echo $PHP_SELF; ?>?sortBy=title&sortOrder=<?php echo $newSortOrder; ?>&startLimit=<?php echo $startLimit; ?>&rows=<?php echo $limitPerPage; ?>">
				<B>Title</B>
			</a>
</TD>
		<TD>
			<a href="<?php echo $PHP_SELF; ?>?sortBy=g_post_type&sortOrder=<?php echo $newSortOrder; ?>&startLimit=<?php echo $startLimit; ?>&rows=<?php echo $limitPerPage; ?>">
				<B>G_post_type</B>
			</a>
</TD>
		<TD>
			<a href="<?php echo $PHP_SELF; ?>?sortBy=g_image_path&sortOrder=<?php echo $newSortOrder; ?>&startLimit=<?php echo $startLimit; ?>&rows=<?php echo $limitPerPage; ?>">
				<B>G_image_path</B>
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
	while ($i<$numberOfRows)
	{

		if (($i%2)==0) { $bgColor = "#FFFFFF"; } else { $bgColor = "#C0C0C0"; }

	$thisG_id = MYSQL_RESULT($result,$i,"g_id");
	$thisUserId = MYSQL_RESULT($result,$i,"userId");
	$thisGpostId = MYSQL_RESULT($result,$i,"gpostId");
	$thisTitle = MYSQL_RESULT($result,$i,"title");
	$thisG_post_type = MYSQL_RESULT($result,$i,"g_post_type");
	$thisG_image_path = MYSQL_RESULT($result,$i,"g_image_path");
	$thisText_body = MYSQL_RESULT($result,$i,"text_body");
	$thisDate_created = MYSQL_RESULT($result,$i,"date_created");

?>
	<TR BGCOLOR="<?php echo $bgColor; ?>">
		<TD><?php echo $thisG_id; ?></TD>
		<TD><?php echo $thisUserId; ?></TD>
		<TD><?php echo $thisGpostId; ?></TD>
		<TD><?php echo $thisTitle; ?></TD>
		<TD><?php echo $thisG_post_type; ?></TD>
		<TD><?php echo $thisG_image_path; ?></TD>
		<TD><?php echo $thisText_body; ?></TD>
		<TD><?php echo $thisDate_created; ?></TD>
	<TD><a href="editGroup_post.php?g_idField=<?php echo $thisG_id; ?>">Edit</a></TD>
	<TD><a href="confirmDeleteGroup_post.php?g_idField=<?php echo $thisG_id; ?>">Delete</a></TD>
	</TR>
<?php 
		$i++;

	} // end while loop
?>
</TABLE>


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