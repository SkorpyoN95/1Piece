<?php
 session_start();
include('controller/chatController.php');
$chat_cont = new ChatController();
if(isset($_REQUEST['page'])) $page = $_REQUEST['page'];
else $page = 0;
$chat_cont->index($page);
?>