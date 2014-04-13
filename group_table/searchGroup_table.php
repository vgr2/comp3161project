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
$sqlQuery = "SELECT *  FROM group_table WHERE g_id like '%$thisKeyword%'  OR userId like '%$thisKeyword%'  OR group_name like '%$thisKeyword%'  OR date_created like '%$thisKeyword%' ";
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
			<a href="<?php echo $PHP_SELF; ?>?sortBy=group_name&sortOrder=<?php echo $newSortOrder; ?>&startLimit=<?php echo $startLimit; ?>&rows=<?php echo $limitPerPage; ?>">
				<B>Group_name</B>
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

	$thisG_id = MYSQL_RESULT($result,$i,"g_id");
	$thisUserId = MYSQL_RESULT($result,$i,"userId");
	$thisGroup_name = MYSQL_RESULT($result,$i,"group_name");
	$thisDate_created = MYSQL_RESULT($result,$i,"date_created");
	$thisG_id = highlightSearchTerms($thisG_id, $thisKeyword, $highlightColor); 
	$thisUserId = highlightSearchTerms($thisUserId, $thisKeyword, $highlightColor); 
	$thisGroup_name = highlightSearchTerms($thisGroup_name, $thisKeyword, $highlightColor); 
	$thisDate_created = highlightSearchTerms($thisDate_created, $thisKeyword, $highlightColor); 

?>
	<TR BGCOLOR="<?php echo $bgColor; ?>">
		<TD><?php echo $thisG_id; ?></TD>
		<TD><?php echo $thisUserId; ?></TD>
		<TD><?php echo $thisGroup_name; ?></TD>
		<TD><?php echo $thisDate_created; ?></TD>
	<TD><a href="editGroup_table.php?g_idField=<?php echo $thisG_id; ?>">Edit</a></TD>
	<TD><a href="confirmDeleteGroup_table.php?g_idField=<?php echo $thisG_id; ?>">Delete</a></TD>
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