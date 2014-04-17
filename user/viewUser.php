<?php
include_once("../common/dbConnection.php");
include_once '../common/setup.php';
include_once("../common/header.php");

?>
<?php
$thisUserId = mysql_real_escape_string($_REQUEST['userIdField']);

// dd($user);
$profile = $db->get_row("select * from profile where userId = '".$thisUserId."'");
// dd($profile);
$personalPosts = $db->get_results("select * from post where userId = '".$thisUserId."' order by date_created");
// dd($personalPosts7;
$usersGroups = $db->get_results("select * from group_table where userId = '".$thisUserId."'");
// dd($usersGroups);
$groupsUserIn = $db->get_results("SELECT group_table.group_name FROM group_table JOIN group_members ON group_table.g_id = group_members.g_id WHERE group_members.userID = '".$thisUserId."'");
// dd($groupsUserIn);
$allGroups = $db->get_results("select * from group_table");
// dd($allGroups);
//variable  for storing all existing friends
$friends = $db->get_results("select userId,firstname, lastname from profile join friends_of on profile.userId = friends_of.friends_owner where friends_of.friend = '".$thisUserId."'");
// dd($friends);

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
function showProfile($profile)
{
	$v = '<div class="col-md-4">';
	$v .= '<p>'.$profile->firstname.' '.$profile->lastname.'</p>';
	$v .= '<p>'.$profile->status.'</p>';
	$v .= '<p>'.$profile->email.'</p>';
	$v .= '<p>'.$profile->dob.'</p>';
	$v .= '</div>';
	$v .= '<span class="pull-right"><img src="'.$profile->profile_pic.'" width="100" height="100" /></span>';
	return $v;
}
function relatedData($data)
{
	if (isset($data))
	{
//		dd($data);
                $d = '<ul>';
		foreach ($data as $key => $value) {
//			$d .= '<div>'.$key.': '.$value.'</div>';
		}
		$d .= '</ul>';
		
		return $d;
	}
}



function showPersonalPosts($personalPosts){
//    $p = '';
//    if (isset($personalPosts)){
//        foreach ($personalPosts as $post) {
//            $p .= '<div style="width:94%;">
//                <div><strong>'.$post->title.'</strong></div>'.$post->text_body.'<div class="pull-right">'.$post->date_created.'</div></div>';
//        }
//    } else {
//        $p.= "<div>No posts, yet...</div>";
//    }
//    return $p;
    global $db;
    global $user;
    $p = '';
    if (isset($personalPosts)){
        foreach ($personalPosts as $post) {
            $p .= '<div style="width:94%;">
                        <div>
                            <strong><span>'.$post->title.'</span> </strong>-<span class="pull-right">'.$post->date_created.'</span>
                        </div>'.$post->text_body.'
                        <div class="pull-right"></div>';
                            $postComments = $db->get_results("select comment.userId, comment.content, comment.date_commented from comment join post on comment.postId = post.postId where post.postId = '".$post->postId."'");
//              //                $db->vardump($postComments);
                
                if (isset($postComments)){
                    $p .= '<ul>';
                    foreach ($postComments as $comment) {
                        $p .= '<li><em>'.$comment->content.' - <span style="color:#039">'.  commentAuthor($comment->userId).'</span></em></li>';
                    }
                    $p .= '</ul>';
                } else {
                    $p .= '<ul>';
                    $p .= '<li>No comments yet</li>';
                    $p .= '</ul>';
                }
                $p .= "<div>".  addNewComment($post->userId, $post->postId)."</div>";
            $p .= '</div>';
                
        }
    } else {
        $p.= "<div>No posts, yet...</div>";
    }
    return $p;
}

function showMyGroups($myGroups){
    $p = '';
    if (isset($myGroups)){
        foreach ($myGroups as $group) {
            $p .= '<div style="width:94%;"><span>'.$group->group_name.'</span><span class="pull-right"> '.$group->date_created.' </span></div>';
        }
    } else {
        $p.= "No groups, yet...";
    }
    return $p;
}
function groupsUserIn($param) {
    global $db;
//    $db->vardump($param);
    $p = '';
    if (isset($param)){
        foreach ($param as $group) {
            $p .= '<div style="width:95%;"><span>'.$group->group_name.'</span>
                <span class="pull-right">
                </span></div>';
        }
    } else {
        $p .= "Haven't joined any groups, yet..";
    }
    return $p;
}
function allGroups($param) {
    global $user;
    $p = "";//'<span class="pull-right">[ <a href="group_table/enterNewGroup_table.php">+</a> ]</span>';
    if (isset($param)){
        foreach ($param as $group) {
            $p .= '<div style="width:94%;"><span>'.$group->group_name.'</span><span class="pull-right"> </span></div>';
        }
    } else {
        $p .= "Haven't joined any groups, yet..";
    }
    return $p;
}
function friends($param) {
    $p = '';
    if (isset($param)){
        foreach ($param as $friend) {
            $p .= '<div style="width:95%;"><span>'.$friend->firstname.' '.$friend->lastname.'</span><span class="pull-right"></span></div>';
        }
    } else {
        $p .= "Haven't added any friends, yet..";
    }
    return $p;
}

?>
<?php
$sql = "SELECT   * FROM user WHERE userId = '$thisUserId'";
$result = MYSQL_QUERY($sql);
$numberOfRows = MYSQL_NUMROWS($result);
if ($numberOfRows==0) {  
?>

Sorry. No records found !!

<?php
}
else if ($numberOfRows>0) {

	$i=0;
	$thisUserId = MYSQL_RESULT($result,$i,"userId");
	$thisUsername = MYSQL_RESULT($result,$i,"username");
//	$thisPassword = MYSQL_RESULT($result,$i,"password");

}
?>

<h2>View Profile</h2><br><br>

<table>
<tr height="30">
	<td align="right"><b>Username : </b></td>
	<td><?php echo $thisUsername; ?></td>
</tr>
</table>

<div class="row">
        <!-- center left-->	
      	<div class="col-md-7">
		<?php            
		echo showPanel('User Profile', showProfile($profile));
		echo "<hr>";
		echo showItemsPanel('User Posts', showPersonalPosts($personalPosts));
		echo "<hr>";
		?>
		</div>
		<div class="col-md-5">
		<?php
		echo showItemsPanel('Groups Owned', showMyGroups($usersGroups));
		echo "<hr>";
		echo showItemsPanel('Joined Groups', groupsUserIn($groupsUserIn));
		echo "<hr>";
		echo showItemsPanel('Friends Had', friends($friends));
		echo "<hr>";
		?>	
		</div>
	</div>
<?php


function addNewComment($userId, $postId){
    global $user;
    return '
        <form name="commentEnterForm" method="POST" action="../comment/insertNewComment.php">
            <input type="hidden" name="thisPostIdField" size="20" value="'.$postId.'"> 
            <input type="hidden" name="thisUserIdField" size="20" value="'.$user->userId.'">
            <b> Comment :  </b>
            <textarea name="thisContentField" class="form-control" style="display:block;"> </textarea> 
             <input type="hidden" name="thisDate_commentedField" size="20" value="'.date("Y-m-d").'">
             <input type="hidden" name="refpage" size="20" value="/socialflikx/user/viewUser.php?userIdField='.$userId.'">
        <input type="submit" name="submitEnterCommentForm" value="Add Comment" style="clear:both;"><br>
        <input type="reset" name="resetForm" value="Clear">
        </form>
    ';
}
function commentAuthor($userId){
    global $db;
    return $db->get_var("select username from user join comment on comment.userId = user.userId where comment.userId = '$userId'");
}
include_once("../common/footer.php");
?>