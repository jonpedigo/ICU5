
Hello, <?php echo $user_data['username']; ?>&nbsp;
<a href="information.php">My Information</a>&nbsp;
<a href="myposts.php">My Posts</a>&nbsp;
<a href="mymessages.php">My Messages</a>&nbsp;
<a href='feed.php'>My Feed</a>&nbsp;
<a href='notifications.php'>Notifications (<?php echo(count_notifications($session_user_id)); ?>)</a>&nbsp;


<a href="logout.php">Log out</a>

