<?php

$adminshow = false;

if(isset($_GET['community']) && check_admin_power($session_admin_id) > 0){
	
	$posts = get_posts(1, $_GET['community'], -1, null);
	
	$moretype = 0;

}

if(isset($_GET['codename']) && check_admin_power($session_admin_id) > 0){
	
	$admin_profile_id = admin_id_from_codename($_GET['codename']);
		
	$posts = get_posts(1, null, -2, $admin_profile_id);
		
	$moretype = 1;
	
}

if(isset($_GET['community']) === false && isset($_GET['codename']) === false){

	$posts = get_posts(1, $admin_data['community'], -1, null);
	
	$moretype = 0;
	
}

echo('<div id = "posts">');

foreach ($posts[0] as $currentpost) {
	
	if($moretype == 1){

		display_post($currentpost['id'], 'post', 'site', 'display_time', 'saved_count', 'username', 'direct_replies', 'sustained_replies', 'admin_reply', 'give_points', 'deny', 'delete');

	}else{
		display_post($currentpost['id'], 'post', 'display_time', 'saved_count', 'username', 'direct_replies', 'sustained_replies', 'admin_reply', 'give_points', 'deny', 'delete');
	
	}
			
	echo('<br>');

}

if($posts[1]){

	echo('<span id = "clickmore" onclick = "get_more_approved_posts_admin(30,\''.$admin_data['community'].'\', '.$moretype.')">More Posts</span>');

}

echo('</div>');	
		

?>
