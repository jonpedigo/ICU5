<span class = 'feedtitle'></span>

<?php
	
$posts = get_user_feed($session_user_id, 0, 1);

echo('<div id = "posts">');

foreach ($posts[0] as $currentpost) {
	
	/*

	if($currentpost['service'] == "ICU"){
		
		display_post($currentpost['id'], 'post', 'service', 'display_time', 'share_post', 'save_post', 'reply', 'comment_count', 'comment_on', 'point_count', 'give_point');
		
	}
	if($currentpost['service'] == "Bone"){
	
		display_post($currentpost['id'], 'post', 'service', 'display_time', 'share_post', 'reply', 'comment_count', 'comment_on', 'point_count', 'give_point');
	
	}
	
	
	if($currentpost['service'] == "Hole"){
	
		display_post($currentpost['id'], 'post', 'service', 'comment_count', 'comment_on', 'point_count', 'give_point', 'display_time', 'image');
			
	
	}
	
	*/
	
	if($currentpost['service'] == "Events"){
	
		display_post($currentpost['id'], 'title', 'location', 'start_time', 'post', 'service', 'share_post', 'comment_count', 'comment_on', 'point_count', 'give_point', 'image_corner', 'free_food', 'save_post', 'duration', 'start_time_full');
	
	}
	if($currentpost['service'] != "Events"){
		
		create_display_set($currentpost['id'], 'feed', 'load');
	
	
	}
}

if($posts[1]){

	echo('<span class = "btn btn-default" id = "clickmore" onclick = "get_more_feed_posts(10)">More Posts</span>');

}

echo('</div>');
	
?>