<?php
include_once("../common/dbConnection.php");
include_once("../common/header.php");
?>
<h2>Enter Post</h2>
<form name="postEnterForm" method="POST" action="insertNewPost.php">

<table cellspacing="2" cellpadding="2" border="0" width="100%">
	<tr valign="top" height="20">
		<td align="right"> <b> PostId :  </b> </td>
		<td> <input type="text" name="thisPostIdField" size="20" value="">  </td> 
	</tr>
	<tr valign="top" height="20">
		<td align="right"> <b> UserId :  </b> </td>
		<td> <input type="text" name="thisUserIdField" size="20" value="">  </td> 
	</tr>
	<tr valign="top" height="20">
		<td align="right"> <b> Title :  </b> </td>
		<td> <input type="text" name="thisTitleField" size="20" value="">  </td> 
	</tr>
	<tr valign="top" height="20">
		<td align="right"> <b> Post_type :  </b> </td>
		<td> <input type="text" name="thisPost_typeField" size="20" value="">  </td> 
	</tr>
	<tr valign="top" height="20">
		<td align="right"> <b> Image_path :  </b> </td>
		<td> <input type="text" name="thisImage_pathField" size="20" value="">  </td> 
	</tr>
	<tr valign="top" height="20">
		<td align="right"> <b> Text_body :  </b> </td>
		<td> <input type="text" name="thisText_bodyField" size="20" value="">  </td> 
	</tr>
	<tr valign="top" height="20">
		<td align="right"> <b> Date_created :  </b> </td>
		<td> <input type="text" name="thisDate_createdField" size="20" value="<?php echo date("Y-m-d");?>">  </td> 
	</tr>
</table>

<input type="submit" name="submitEnterPostForm" value="Enter Post">
<input type="reset" name="resetForm" value="Clear Form">

</form>

<?php
include_once("../common/footer.php");
?>