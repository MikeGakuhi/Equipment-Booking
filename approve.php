<?php include 'db.php'; $id=$_GET['id']; $s=$_GET['s']; $conn->query("UPDATE bookings SET status='$s' WHERE id=$id"); header("Location: admin_bookings.php"); ?>
