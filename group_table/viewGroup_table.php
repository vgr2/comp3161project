<?php
include_once("../common/dbConnection.php");
include_once '../common/setup.php';
include_once("../common/header.php");
?>
<?php
$thisG_id = $_REQUEST['g_idField']
?>
<?php
$groupPosts = $db->get_results("select * from group_post where userId = '".$user->userId."' and g_id = '".$thisG_id."' order by date_created");

$sql = "select   * from group_table where g_id = '$thisG_id'";
$result = $db->get_row($sql);
$numberOfRows = count($result);
if ($numberOfRows==0) {  
?>

Sorry. No records found !!

<?php
}
else if ($numberOfRows>0) {

	$i=0;
	$thisG_id = $result->g_id;
	$thisUserId = $result->userId;
	$thisGroup_name = $result->group_name;
	$thisDate_created = $result->date_created;

}
?>

<h2>View Group</h2>

<table>
<tr height="30">
	<td align="right"><b>Group_name : </b></td>
	<td><?php echo $thisGroup_name; ?></td>
</tr>
<tr height="30">
	<td align="right"><b>Date_created : </b></td>
	<td><?php echo $thisDate_created; ?></td>
</tr>
</table>
<?php
echo '<hr>';
echo addGroupEditorForm();
echo '<hr>';
$usr = functionName();
if ($usr){		
    echo showItemsPanel('Group Posts', showPersonalPosts($groupPosts), newPostForm($user->userId));
} 

echo showPersonalPosts($groupPosts);



function addGroupEditorForm() {
    global $db;
    global $user;
    global $thisG_id;
    
    //$friends = $db->get_results("select * from fri where userId = '".$user->userId."'");
    
    $friends = $db->get_results("select user.userId, firstname, lastname, user.username from profile join user on user.userId = profile.userId join friends_of on profile.userId = friends_of.friends_owner where friends_of.friend = '".$user->userId."'");
    
    $ret = '<form name="group_editorsEnterForm" method="POST" action="../group_editors/insertNewGroup_editors.php">

                <input type="hidden" name="thisG_idField" size="20" value="'.$thisG_id.'">  
 		<td align="right"> <b> Select a content editor :  </b> </td>
		<td>  ';
                $ret .= '<select name="thisUser_addedField">';
                    foreach ($friends as $f) {
                        $ret .= '<option value="'.$f->userId.'">'.$f->username.'</option>';
                    }
                    $ret .= '</select>
                <input type="hidden" name="thisDate_addedField" size="20" value="'.date("Y-m-d").'">             
    <input type="submit" name="submitEnterGroup_editorsForm" value="Add Group Editor">

</form>';
                    return $ret;
}
include_once("../common/footer.php");

function showPersonalPosts($personalPosts){
    global $db;
    global $user;
    $p = '';
    if (isset($personalPosts)){
        foreach ($personalPosts as $post) {
            $p .= '<div style="width:94%;">
                        <div>
                            <strong>'.$post->title.'</strong>
                        </div>'.$post->text_body.'
                        <div class="pull-right">'.$post->date_created.'</div>';
//                $postComments = $db->get_results("select comment.userId, comment.content, comment.date_commented from comment join post on comment.postId = post.postId where post.postId = '".$post->postId."'");
//                $db->vardump($postComments);
//                
//                if (isset($postComments)){
//                    $p .= '<ul>';
//                    foreach ($postComments as $comment) {
//                        $p .= '<li><em>'.$comment->content.' - <span style="color:#039">'.  commentAuthor($comment->userId).'</span></em></li>';
//                    }
//                    $p .= '</ul>';
//                } else {
//                    $p .= '<ul>';
//                    $p .= '<li>No comments yet</li>';
//                    $p .= '</ul>';
//                }
//                $p .= "<div>".  addNewComment($post->userId, $post->postId)."</div>";
            $p .= '</div>';
                
        }
    } else {
        $p.= "<div>No posts, yet...</div>";
    }
    return $p;
}

function showPanel($name,$item){
	$v = 	'<div class="panel panel-default">
	            <div class="panel-heading"><h4>'.$name.'</h4></div>
	            <div class="panel-body">';
	$v .= 	        $item;
	$v .= '		</div>
			</div>';
	return $v;
}
function showItemsPanel($name,$item,$newItem=null){
	$v = 	'<div class="panel panel-default">
	            <div class="panel-heading"><h4>'.$name.'</h4></div>
	            <div class="panel-body" style="overflow:auto;">';
	            $v .= ($newItem) ? $newItem."<hr>" : "" ;
//                    $v .= "<hr>";
	$v .= 	        $item;
	$v .= '     </div>
		</div>';
	return $v;
}
function functionName() {
    global $db;
    global $user;
    return $db->get_var("select user_added from group_editors where user_added = '".$user->userId."'");
}
    
?>