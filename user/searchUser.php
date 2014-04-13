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
$sqlQuery = "SELECT *  FROM user WHERE userId like '%$thisKeyword%'  OR username like '%$thisKeyword%'  OR password like '%$thisKeyword%' ";
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
			<a href="<?php echo $PHP_SELF; ?>?sortBy=userId&sortOrder=<?php echo $newSortOrder; ?>&startLimit=<?php echo $startLimit; ?>&rows=<?php echo $limitPerPage; ?>">
				<B>UserId</B>
			</a>
</TD>
		<TD>
			<a href="<?php echo $PHP_SELF; ?>?sortBy=username&sortOrder=<?php echo $newSortOrder; ?>&startLimit=<?php echo $startLimit; ?>&rows=<?php echo $limitPerPage; ?>">
				<B>Username</B>
			</a>
</TD>
		<TD>
			<a href="<?php echo $PHP_SELF; ?>?sortBy=password&sortOrder=<?php echo $newSortOrder; ?>&startLimit=<?php echo $startLimit; ?>&rows=<?php echo $limitPerPage; ?>">
				<B>Password</B>
			</a>
</TD>
	</TR>
<?php 
$highlightColor = "#FFFF99"; 

	while ($i<$numberOfRows)
	{

		if (($i%2)==0) { $bgColor = "#FFFFFF"; } else { $bgColor = "#C0C0C0"; }

	$thisUserId = MYSQL_RESULT($result,$i,"userId");
	$thisUsername = MYSQL_RESULT($result,$i,"username");
	$thisPassword = MYSQL_RESULT($result,$i,"password");
	$thisUserId = highlightSearchTerms($thisUserId, $thisKeyword, $highlightColor); 
	$thisUsername = highlightSearchTerms($thisUsername, $thisKeyword, $highlightColor); 
	$thisPassword = highlightSearchTerms($thisPassword, $thisKeyword, $highlightColor); 

?>
	<TR BGCOLOR="<?php echo $bgColor; ?>">
		<TD><?php echo $thisUserId; ?></TD>
		<TD><?php echo $thisUsername; ?></TD>
		<TD><?php echo $thisPassword; ?></TD>
	<TD><a href="editUser.php?userIdField=<?php echo $thisUserId; ?>">Edit</a></TD>
	<TD><a href="confirmDeleteUser.php?userIdField=<?php echo $thisUserId; ?>">Delete</a></TD>
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