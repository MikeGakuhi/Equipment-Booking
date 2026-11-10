<?php session_start(); if(!isset($_SESSION['email'])){ header("Location: index.php"); exit(); } include 'db.php'; $email=$_SESSION['email']; 
$total=$conn->query("SELECT COUNT(*) as c FROM bookings WHERE email='$email'")->fetch_assoc()['c']; 
$pending=$conn->query("SELECT COUNT(*) as c FROM bookings WHERE email='$email' AND status='Pending'")->fetch_assoc()['c']; 
$approved=$conn->query("SELECT COUNT(*) as c FROM bookings WHERE email='$email' AND status='Approved'")->fetch_assoc()['c']; 
$rejected=$conn->query("SELECT COUNT(*) as c FROM bookings WHERE email='$email' AND status='Rejected'")->fetch_assoc()['c']; 
?>
<!DOCTYPE html><html><head><title>My Bookings - United States International University</title>
<meta http-equiv="Cache-Control" content="no-cache, no-store, must-revalidate">
<style>*{margin:0;padding:0;box-sizing:border-box}body{font-family:'Segoe UI',Arial;background:#eef1f8;min-height:100vh}.nav{background:#0a1931;color:white;padding:14px 25px;display:flex;justify-content:space-between;border-bottom:4px solid #d4af37}.nav a{color:white;margin-left:15px;text-decoration:none;font-size:11px;font-weight:700;text-transform:uppercase}.container{max-width:1100px;margin:20px auto;padding:0 20px}.top-stats{display:grid;grid-template-columns:repeat(4,1fr);gap:15px;margin-bottom:20px}.stat{background:white;padding:18px;border-radius:10px;text-align:center;box-shadow:0 4px 15px rgba(0,0,0,.08);border-left:5px solid #0a1931}.stat h1{font-size:26px;color:#0a1931}.stat p{font-size:9px;font-weight:800;text-transform:uppercase;color:#666}.card{background:white;border-radius:12px;padding:24px;box-shadow:0 4px 15px rgba(0,0,0,.08);border-top:5px solid #d4af37}th{background:#0a1931;color:white;padding:12px 10px;font-size:9px;text-transform:uppercase;text-align:left}td{padding:12px 10px;border-bottom:1px solid #eef1f8;font-size:11px}.badge{padding:5px 10px;border-radius:20px;font-size:9px;font-weight:800;text-transform:uppercase}.Pending{background:#fff3cd;color:#856404;border:1px solid #ffe69c}.Approved{background:#d4edda;color:#155724;border:1px solid #a3d9b1}.Rejected{background:#f8d7da;color:#721c24;border:1px solid #f1aeb5}.alert{padding:12px;border-radius:8px;margin-bottom:15px;font-size:11px;font-weight:700}
</style></head><body>
<div class="nav"><div><b>UNITED STATES INTERNATIONAL UNIVERSITY - AFRICA</b> <span style="color:#d4af37">| MY BOOKINGS</span></div><div><a href="dashboard.php">Dashboard</a><a href="book.php">Book New</a><a href="logout.php">Logout</a></div></div>
<div class="container">

<?php if($approved>0){ echo "<div class='alert' style='background:#d4edda;color:#155724;border:1px solid #a3d9b1'>✅ You have $approved APPROVED request(s) - Ready for collection at Block C, Room 12</div>"; } ?>
<?php if($rejected>0){ echo "<div class='alert' style='background:#f8d7da;color:#721c24;border:1px solid #f1aeb5'>❌ You have $rejected REJECTED request(s) - Please visit Lab Admin Office for clarification</div>"; } ?>

<div class="top-stats"><div class="stat"><h1><?php echo $total; ?></h1><p>Total</p></div><div class="stat" style="border-left-color:#d4af37"><h1><?php echo $pending; ?></h1><p>Pending</p></div><div class="stat" style="border-left-color:#28a745"><h1><?php echo $approved; ?></h1><p>Approved</p></div><div class="stat" style="border-left-color:#dc3545"><h1><?php echo $rejected; ?></h1><p>Rejected</p></div></div>

<div class="card">
<h2 style="color:#0a1931;border-left:4px solid #d4af37;padding-left:10px;text-transform:uppercase;font-size:13px;margin-bottom:10px">My Laboratory Requests - Live Status</h2>
<p style="font-size:10px;color:#888;margin-bottom:15px">Last updated: <?php echo date('d M Y H:i:s'); ?> | Showing for: <b><?php echo $email; ?></b> | <a href="mybookings.php" style="color:#0a1931">↻ Refresh</a></p>
<table><tr><th>Ref No</th><th>Equipment</th><th>Collection</th><th>Return</th><th>Purpose</th><th>Status</th></tr>
<?php $r=$conn->query("SELECT * FROM bookings WHERE email='$email' ORDER BY id DESC"); if($r->num_rows==0){ echo "<tr><td colspan=6 style='text-align:center;padding:30px;color:#888'>No bookings yet for <b>$email</b><br><small>Your email is: $email</small></td></tr>"; } while($row=$r->fetch_assoc()){ 
$color = $row['status']=='Approved' ? '#d4edda' : ($row['status']=='Rejected' ? '#f8d7da' : '#fff'); 
echo "<tr style='background:$color'><td><b>#USIU00".$row['id']."</b></td><td><b>".$row['equipment']."</b></td><td>".$row['book_date']."</td><td>".$row['return_date']."</td><td>".substr($row['purpose'],0,50)."</td><td><span class='badge ".$row['status']."'>".$row['status']."</span></td></tr>"; } ?>
</table>
</div>
</div>
</body></html>
