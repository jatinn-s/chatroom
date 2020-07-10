<?php 
   session_start();
   if (isset($_POST['reset'])){
   	$_SESSION['chats'] = array();
   	header("Location: chatapp.php");
   	return;
   }
   if (isset($_POST['message'])){
   	if (! isset($_SESSION['chats'])) {
   		$_SESSION['chats'] = array();
   	}
   	$_SESSION['chats'][]=array($_POST['message'], date(DATE_RFC2822));
   	header("Location: chatapp.php");
   	return;
   }
?>
<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<title>Chat Application</title>
	<script src="https://code.jquery.com/jquery-3.5.1.min.js" integrity="sha256-9/aliU8dGd2tb6OSsuzixeV4y/faTqgFtohetphbbj0=" crossorigin="anonymous"></script>
</head>
<body>
    <h1>CHAT</h1>
    <form method="post">
    	<p>
    		<input type="text" name="message">
    		<input type="submit" value="Chat">
    		<input type="submit" value="Reset" name="reset">
    	</p>
    </form>
    <div id="chatcontent"></div>
    <script src="https://code.jquery.com/jquery-3.5.1.min.js" integrity="sha256-9/aliU8dGd2tb6OSsuzixeV4y/faTqgFtohetphbbj0=" crossorigin="anonymous"></script>
    <script type="text/javascript">
    	function updateMsg(){
    		console.log('Requesting JSON');
    		$.getJSON('chatlist.php',function(rowz){
    			console.log('JSON recieved');
    			console.log('rowz');
    			$('#chatcontent').empty();
    			 for(var i=0; i < rowz.length; i++){
    			 	entry=rowz[i];
    			 	$('#chatcontent').append('<p>'+entry[0]+'<br>')
    			 }
    			setTimeout('updateMsg()',1000);
    		});
    	}
    	$(document).ready(function(){
            $.ajaxSetup({cache:false});
            updateMsg();
    	});
    </script>
</body>
</html>









