<?php
include_once("../common/dbConnection.php");
include_once("../common/header.php");
?>
<?php 
function highlightSearchTerms($fullText, $searchTerm, $bgcolor="#FFFF99")
{
	if (empty($searchTerm))
	{
		return $fullText;
	}
	else
	{
		$start_tag = "<span style=\"background-color: $bgcolor\">";
		$end_tag = "</span>";
		$highlighted_results = $start_tag . $searchTerm . $end_tag;
		return eregi_replace($searchTerm, $highlighted_results, $fullText);
	}
}

?>
<?php
$thisKeyword = $_REQUEST['keyword'];
?>
<?php 
$sqlQuery = "SELECT *  FROM post WHERE postId like '%$thisKeyword%'  OR userId like '%$thisKeyword%'  OR title like '%$thisKeyword%'  OR post_type like '%$thisKeyword%'  OR image_path like '%$thisKeyword%'  OR text_body like '%$thisKeyword%'  OR date_created like '%$thisKeyword%' ";
$result = MYSQL_QUERY($sqlQuery);
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
$highlightColor = "#FFFF99"; 

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
	$thisPostId = highlightSearchTerms($thisPostId, $thisKeyword, $highlightColor); 
	$thisUserId = highlightSearchTerms($thisUserId, $thisKeyword, $highlightColor); 
	$thisTitle = highlightSearchTerms($thisTitle, $thisKeyword, $highlightColor); 
	$thisPost_type = highlightSearchTerms($thisPost_type, $thisKeyword, $highlightColor); 
	$thisImage_path = highlightSearchTerms($thisImage_path, $thisKeyword, $highlightColor); 
	$thisText_body = highlightSearchTerms($thisText_body, $thisKeyword, $highlightColor); 
	$thisDate_created = highlightSearchTerms($thisDate_created, $thisKeyword, $highlightColor); 

?>
	<TR BGCOLOR="<?php echo $bgColor; ?>">
		<TD><?php echo $thisPostId; ?></TD>
		<TD><?php echo $thisUserId; ?></TD>
		<TD><?php echo $thisTitle; ?></TD>
		<TD><?php echo $thisPost_type; ?></TD>
		<TD><?php echo $thisImage_path; ?></TD>
		<TD><?php echo $thisText_body; ?></TD>
		<TD><?php echo $thisDate_created; ?></TD>
	<TD><a href="editPost.php?postIdField=<?php echo $thisPostId; ?>">Edit</a></TD>
	<TD><a href="confirmDeletePost.php?postIdField=<?php echo $thisPostId; ?>">Delete</a></TD>
	</TR>
<?php 
		$i++;

	} // end while loop
?>
</TABLE>
<?php 
} // end of if numberOfRows > 0 
 ?>

<?php
include_once("../common/footer.php");
?>