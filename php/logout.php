<?php
	session_start();
	session_destroy();
	echo "<script>
			window.alert('You have successfully logged out!');
			window.location.href='../index.html';
			</script>";
?>