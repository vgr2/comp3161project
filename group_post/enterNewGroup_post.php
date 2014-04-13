<?php
include_once("../common/dbConnection.php");
include_once("../common/header.php");
?>
<h2>Enter Group_post</h2>
<form name="group_postEnterForm" method="POST" action="insertNewGroup_post.php">

<table cellspacing="2" cellpadding="2" border="0" width="100%">
	<tr valign="top" height="20">
		<td align="right"> <b> G_id :  </b> </td>
		<td> <input type="text" name="thisG_idField" size="20" value="">  </td> 
	</tr>
	<tr valign="top" height="20">
		<td align="right"> <b> UserId :  </b> </td>
		<td> <input type="text" name="thisUserIdField" size="20" value="">  </td> 
	</tr>
	<tr valign="top" height="20">
		<td align="right"> <b> GpostId :  </b> </td>
		<td> <input type="text" name="thisGpostIdField" size="20" value="">  </td> 
	</tr>
	<tr valign="top" height="20">
		<td align="right"> <b> Title :  </b> </td>
		<td> <input type="text" name="thisTitleField" size="20" value="">  </td> 
	</tr>
	<tr valign="top" height="20">
		<td align="right"> <b> G_post_type :  </b> </td>
		<td> <input type="text" name="thisG_post_typeField" size="20" value="">  </td> 
	</tr>
	<tr valign="top" height="20">
		<td align="right"> <b> G_image_path :  </b> </td>
		<td> <input type="text" name="thisG_image_pathField" size="20" value="">  </td> 
	</tr>
	<tr valign="top" height="20">
		<td align="right"> <b> Text_body :  </b> </td>
		<td> <input type="text" name="thisText_bodyField" size="20" value="">  </td> 
	</tr>
	<tr valign="top" height="20">
		<td align="right"> <b> Date_created :  </b> </td>
		<td> <input type="text" name="thisDate_createdField" size="20" value="">  </td> 
	</tr>
</table>

<input type="submit" name="submitEnterGroup_postForm" value="Enter Group_post">
<input type="reset" name="resetForm" value="Clear Form">

</form>

<?php
include_once("../common/footer.php");
?>