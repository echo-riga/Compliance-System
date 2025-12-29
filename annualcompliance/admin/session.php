<?php
session_start();
if (!isset($_SESSION['users_id']) AND !isset($_SESSION['type'])) {
	echo "<script>window.location.href='../admin/index.php';</script>";
}
?>