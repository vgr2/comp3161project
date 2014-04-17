<?php
include_once("../common/dbConnection.php");
include_once("../common/header.php");
?>
<h2>Enter Comment</h2>
<form name="commentEnterForm" method="POST" action="insertNewComment.php">

<table cellspacing="2" cellpadding="2" border="0" width="100%">
	<tr valign="top" height="20">
		<td align="right"> <b> CommentId :  </b> </td>
		<td> <input type="text" name="thisCommentIdField" size="20" value="">  </td> 
	</tr>
	<tr valign="top" height="20">
		<td align="right"> <b> PostId :  </b> </td>
		<td> <input type="text" name="thisPostIdField" size="20" value="">  </td> 
	</tr>
	<tr valign="top" height="20">
		<td align="right"> <b> UserId :  </b> </td>
		<td> <input type="text" name="thisUserIdField" size="20" value="">  </td> 
	</tr>
	<tr valign="top" height="20">
		<td align="right"> <b> Content :  </b> </td>
		<td> <textarea name="thisContentField"> </textarea>  </td> 
	</tr>
	<tr valign="top" height="20">
		<td align="right"> <b> Date_commented :  </b> </td>
		<td> <input type="text" name="thisDate_commentedField" size="20" value="">  </td> 
	</tr>
</table>

<input type="submit" name="submitEnterCommentForm" value="Enter Comment">
<input type="reset" name="resetForm" value="Clear Form">

</form>

<?php
include_once("../common/footer.php");
?>