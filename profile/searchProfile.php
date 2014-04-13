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
$sqlQuery = "SELECT *  FROM profile WHERE userId like '%$thisKeyword%'  OR profileId like '%$thisKeyword%'  OR status like '%$thisKeyword%'  OR fname like '%$thisKeyword%'  OR lname like '%$thisKeyword%'  OR email like '%$thisKeyword%'  OR dob like '%$thisKeyword%'  OR profile_pic like '%$thisKeyword%' ";
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
			<a href="<?php echo $PHP_SELF; ?>?sortBy=profileId&sortOrder=<?php echo $newSortOrder; ?>&startLimit=<?php echo $startLimit; ?>&rows=<?php echo $limitPerPage; ?>">
				<B>ProfileId</B>
			</a>
</TD>
		<TD>
			<a href="<?php echo $PHP_SELF; ?>?sortBy=status&sortOrder=<?php echo $newSortOrder; ?>&startLimit=<?php echo $startLimit; ?>&rows=<?php echo $limitPerPage; ?>">
				<B>Status</B>
			</a>
</TD>
		<TD>
			<a href="<?php echo $PHP_SELF; ?>?sortBy=fname&sortOrder=<?php echo $newSortOrder; ?>&startLimit=<?php echo $startLimit; ?>&rows=<?php echo $limitPerPage; ?>">
				<B>Fname</B>
			</a>
</TD>
		<TD>
			<a href="<?php echo $PHP_SELF; ?>?sortBy=lname&sortOrder=<?php echo $newSortOrder; ?>&startLimit=<?php echo $startLimit; ?>&rows=<?php echo $limitPerPage; ?>">
				<B>Lname</B>
			</a>
</TD>
		<TD>
			<a href="<?php echo $PHP_SELF; ?>?sortBy=email&sortOrder=<?php echo $newSortOrder; ?>&startLimit=<?php echo $startLimit; ?>&rows=<?php echo $limitPerPage; ?>">
				<B>Email</B>
			</a>
</TD>
		<TD>
			<a href="<?php echo $PHP_SELF; ?>?sortBy=dob&sortOrder=<?php echo $newSortOrder; ?>&startLimit=<?php echo $startLimit; ?>&rows=<?php echo $limitPerPage; ?>">
				<B>Dob</B>
			</a>
</TD>
		<TD>
			<a href="<?php echo $PHP_SELF; ?>?sortBy=profile_pic&sortOrder=<?php echo $newSortOrder; ?>&startLimit=<?php echo $startLimit; ?>&rows=<?php echo $limitPerPage; ?>">
				<B>Profile_pic</B>
			</a>
</TD>
	</TR>
<?php 
$highlightColor = "#FFFF99"; 

	while ($i<$numberOfRows)
	{

		if (($i%2)==0) { $bgColor = "#FFFFFF"; } else { $bgColor = "#C0C0C0"; }

	$thisUserId = MYSQL_RESULT($result,$i,"userId");
	$thisProfileId = MYSQL_RESULT($result,$i,"profileId");
	$thisStatus = MYSQL_RESULT($result,$i,"status");
	$thisFname = MYSQL_RESULT($result,$i,"fname");
	$thisLname = MYSQL_RESULT($result,$i,"lname");
	$thisEmail = MYSQL_RESULT($result,$i,"email");
	$thisDob = MYSQL_RESULT($result,$i,"dob");
	$thisProfile_pic = MYSQL_RESULT($result,$i,"profile_pic");
	$thisUserId = highlightSearchTerms($thisUserId, $thisKeyword, $highlightColor); 
	$thisProfileId = highlightSearchTerms($thisProfileId, $thisKeyword, $highlightColor); 
	$thisStatus = highlightSearchTerms($thisStatus, $thisKeyword, $highlightColor); 
	$thisFname = highlightSearchTerms($thisFname, $thisKeyword, $highlightColor); 
	$thisLname = highlightSearchTerms($thisLname, $thisKeyword, $highlightColor); 
	$thisEmail = highlightSearchTerms($thisEmail, $thisKeyword, $highlightColor); 
	$thisDob = highlightSearchTerms($thisDob, $thisKeyword, $highlightColor); 
	$thisProfile_pic = highlightSearchTerms($thisProfile_pic, $thisKeyword, $highlightColor); 

?>
	<TR BGCOLOR="<?php echo $bgColor; ?>">
		<TD><?php echo $thisUserId; ?></TD>
		<TD><?php echo $thisProfileId; ?></TD>
		<TD><?php echo $thisStatus; ?></TD>
		<TD><?php echo $thisFname; ?></TD>
		<TD><?php echo $thisLname; ?></TD>
		<TD><?php echo $thisEmail; ?></TD>
		<TD><?php echo $thisDob; ?></TD>
		<TD><?php echo $thisProfile_pic; ?></TD>
	<TD><a href="editProfile.php?userIdField=<?php echo $thisUserId; ?>">Edit</a></TD>
	<TD><a href="confirmDeleteProfile.php?userIdField=<?php echo $thisUserId; ?>">Delete</a></TD>
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