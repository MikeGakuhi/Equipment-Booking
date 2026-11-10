<?php session_start(); if(!isset($_SESSION['admin'])){ header("Location: admin.php"); exit(); } include 'db.php'; 
$total=$conn->query("SELECT COUNT(*) as c FROM bookings")->fetch_assoc()['c'];
$pending=$conn->query("SELECT COUNT(*) as c FROM bookings WHERE status='Pending'")->fetch_assoc()['c'];
$approved=$conn->query("SELECT COUNT(*) as c FROM bookings WHERE status='Approved'")->fetch_assoc()['c'];
$students=$conn->query("SELECT COUNT(*) as c FROM users")->fetch_assoc()['c'];
?>
<!DOCTYPE html><html><head><title>Admin - United States International University</title>
<style>
*{margin:0;padding:0;box-sizing:border-box}
body{font-family:'Segoe UI',Arial;background:radial-gradient(circle at 10% 20%, rgba(10,25,49,.06) 0%, transparent 40%),radial-gradient(circle at 90% 80%, rgba(212,175,55,.12) 0%, transparent 40%),linear-gradient(180deg,#f8f9ff 0%,#eef1f8 100%);min-height:100vh}
.nav{background:#0a1931;color:white;padding:14px 25px;display:flex;justify-content:space-between;align-items:center;border-bottom:4px solid #d4af37;box-shadow:0 2px 10px rgba(0,0,0,.15)}
.nav b{font-size:12px}.nav a{color:white;margin-left:18px;text-decoration:none;font-size:11px;font-weight:700;text-transform:uppercase}.nav a:hover{color:#d4af37}
.container{max-width:1150px;margin:22px auto;padding:0 20px}
.stats{display:grid;grid-template-columns:repeat(4,1fr);gap:14px;margin-bottom:20px}
.stat{background:white;padding:20px;border-radius:12px;text-align:center;box-shadow:0 4px 15px rgba(10,25,49,.07);border-left:5px solid #0a1931;transition:.2s}
.stat:hover{transform:translateY(-3px)}
.stat h1{font-size:28px;color:#0a1931}.stat p{font-size:9px;font-weight:800;color:#666;text-transform:uppercase;margin-top:4px}
.stat:nth-child(2){border-left-color:#d4af37}.stat:nth-child(3){border-left-color:#28a745}.stat:nth-child(4){border-left-color:#6f42c1}
.card{background:rgba(255,255,255,.92);border-radius:12px;padding:24px;box-shadow:0 4px 20px rgba(10,25,49,.06);border-top:3px solid #0a1931;margin-bottom:18px}
.card h2{font-size:13px;color:#0a1931;text-transform:uppercase;border-left:4px solid #d4af37;padding-left:10px;margin-bottom:14px}
.btn{display:inline-block;background:#0a1931;color:white;padding:10px 18px;border-radius:6px;text-decoration:none;font-size:11px;font-weight:700;text-transform:uppercase}
.btn-gold{background:#d4af37;color:#0a1931;margin-left:8px}
table{width:100%;border-collapse:collapse}th{background:#0a1931;color:white;padding:10px;font-size:9px;text-transform:uppercase;text-align:left}td{padding:10px;border-bottom:1px solid #eef1f8;font-size:11px}
.badge{padding:4px 9px;border-radius:20px;font-size:9px;font-weight:800;text-transform:uppercase}.Pending{background:#fff3cd;color:#856404}.Approved{background:#d4edda;color:#155724}
.grid2{display:grid;grid-template-columns:2fr 1fr;gap:18px}
</style></head><body>
<div class="nav"><div><b>UNITED STATES INTERNATIONAL UNIVERSITY - AFRICA</b> <span style="color:#d4af37;font-size:11px">| ADMIN PANEL - LABORATORY MANAGEMENT</span><br><small style="font-size:10px;color:#a0b0cc">Administrator: admin@usiu.ac.ke</small></div><div><a href="admin_dashboard.php">Dashboard</a><a href="admin_bookings.php">Bookings (<?php echo $total; ?>)</a><a href="logout.php">Logout</a></div></div>

<div class="container">
<div class="stats">
<div class="stat"><h1><?php echo $total; ?></h1><p>Total Bookings</p></div>
<div class="stat"><h1><?php echo $pending; ?></h1><p>Pending Approval</p></div>
<div class="stat"><h1><?php echo $approved; ?></h1><p>Approved</p></div>
<div class="stat"><h1><?php echo $students; ?></h1><p>Registered Students</p></div>
</div>

<div class="grid2">
<div>
<div class="card" style="background:linear-gradient(135deg,#0a1931 0%,#1a3a5f 100%);color:white;border-top-color:#d4af37">
<h2 style="color:white;border-left-color:#d4af37">Admin Dashboard - Overview</h2>
<p style="font-size:12px;color:#c0cfe8;line-height:1.7">Welcome Administrator. You have <b style="color:#d4af37"><?php echo $pending; ?> pending requests</b> requiring your review. Manage laboratory equipment reservations for School of Science and Technology.</p>
<div style="margin-top:16px"><a class="btn" href="admin_bookings.php">Manage Bookings →</a><a class="btn btn-gold" href="admin_bookings.php">Review Pending (<?php echo $pending; ?>)</a></div>
</div>

<div class="card"><h2>Recent Student Requests</h2>
<table><tr><th>Ref</th><th>Student</th><th>Equipment</th><th>Date</th><th>Status</th></tr>
<?php $r=$conn->query("SELECT * FROM bookings ORDER BY id DESC LIMIT 6"); while($row=$r->fetch_assoc()){ echo "<tr><td><b>#USIU00".$row['id']."</b></td><td>".$row['email']."</td><td>".$row['equipment']."</td><td>".$row['book_date']."</td><td><span class='badge ".$row['status']."'>".$row['status']."</span></td></tr>"; } ?>
</table>
</div>
</div>

<div>
<div class="card"><h2>Quick Stats</h2>
<div style="background:#f8f9ff;padding:12px;border-radius:8px;margin-bottom:10px;border-left:3px solid #0a1931;font-size:11px"><b>Most Requested:</b><br>Microscope Olympus CX23 (8x this week)</div>
<div style="background:#fffbe6;padding:12px;border-radius:8px;margin-bottom:10px;border-left:3px solid #d4af37;font-size:11px"><b>Lab Alert:</b><br>Chem Lab closed tomorrow for maintenance</div>
<div style="background:#f0fff4;padding:12px;border-radius:8px;border-left:3px solid #28a745;font-size:11px"><b>Returns Today:</b><br>2 equipment due for return</div>
</div>

<div class="card"><h2>Lab Inventory</h2><ul style="font-size:11px;color:#555;line-height:2;padding-left:15px"><li>Microscope - 8 units</li><li>Projector - 5 units</li><li>DSLR Camera - 4 units</li><li>Chemistry Kit - 12 units</li><li>Laptop - 10 units</li><li>Spectrophotometer - 2 units</li></ul></div>
</div>
</div>
</div>
</body></html>
