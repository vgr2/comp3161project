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
$sqlQuery = "SELECT *  FROM friendtype_friendof WHERE friendtype_friendofId like '%$thisKeyword%'  OR friendId like '%$thisKeyword%'  OR friend_typeId like '%$thisKeyword%' ";
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
			<a href="<?php echo $PHP_SELF; ?>?sortBy=friendtype_friendofId&sortOrder=<?php echo $newSortOrder; ?>&startLimit=<?php echo $startLimit; ?>&rows=<?php echo $limitPerPage; ?>">
				<B>Friendtype_friendofId</B>
			</a>
</TD>
		<TD>
			<a href="<?php echo $PHP_SELF; ?>?sortBy=friendId&sortOrder=<?php echo $newSortOrder; ?>&startLimit=<?php echo $startLimit; ?>&rows=<?php echo $limitPerPage; ?>">
				<B>FriendId</B>
			</a>
</TD>
		<TD>
			<a href="<?php echo $PHP_SELF; ?>?sortBy=friend_typeId&sortOrder=<?php echo $newSortOrder; ?>&startLimit=<?php echo $startLimit; ?>&rows=<?php echo $limitPerPage; ?>">
				<B>Friend_typeId</B>
			</a>
</TD>
	</TR>
<?php 
$highlightColor = "#FFFF99"; 

	while ($i<$numberOfRows)
	{

		if (($i%2)==0) { $bgColor = "#FFFFFF"; } else { $bgColor = "#C0C0C0"; }

	$thisFriendtype_friendofId = MYSQL_RESULT($result,$i,"friendtype_friendofId");
	$thisFriendId = MYSQL_RESULT($result,$i,"friendId");
	$thisFriend_typeId = MYSQL_RESULT($result,$i,"friend_typeId");
	$thisFriendtype_friendofId = highlightSearchTerms($thisFriendtype_friendofId, $thisKeyword, $highlightColor); 
	$thisFriendId = highlightSearchTerms($thisFriendId, $thisKeyword, $highlightColor); 
	$thisFriend_typeId = highlightSearchTerms($thisFriend_typeId, $thisKeyword, $highlightColor); 

?>
	<TR BGCOLOR="<?php echo $bgColor; ?>">
		<TD><?php echo $thisFriendtype_friendofId; ?></TD>
		<TD><?php echo $thisFriendId; ?></TD>
		<TD><?php echo $thisFriend_typeId; ?></TD>
	<TD><a href="editFriendtype_friendof.php?friendtype_friendofIdField=<?php echo $thisFriendtype_friendofId; ?>">Edit</a></TD>
	<TD><a href="confirmDeleteFriendtype_friendof.php?friendtype_friendofIdField=<?php echo $thisFriendtype_friendofId; ?>">Delete</a></TD>
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