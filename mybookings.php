<?php session_start();
if (!isset($_SESSION['email'])) {
  header("Location: index.php");
  exit();
}
include 'db.php';
$email = $_SESSION['email'];
$total = $conn->query("SELECT COUNT(*) as c FROM bookings WHERE email='$email'")->fetch_assoc()['c'];
$pending = $conn->query("SELECT COUNT(*) as c FROM bookings WHERE email='$email' AND status='Pending'")->fetch_assoc()['c'];
$approved = $conn->query("SELECT COUNT(*) as c FROM bookings WHERE email='$email' AND status='Approved'")->fetch_assoc()['c'];
$rejected = $conn->query("SELECT COUNT(*) as c FROM bookings WHERE email='$email' AND status='Rejected'")->fetch_assoc()['c'];
?>
<!DOCTYPE html>
<html>

<head>
  <title>My Bookings - United States International University</title>
  <meta http-equiv="Cache-Control" content="no-cache, no-store, must-revalidate">
  <style>
    * {
      margin: 0;
      padding: 0;
      box-sizing: border-box
    }

    body {
      font-family: 'Segoe UI', Arial;
      background: #fdf2f5;
      color: #222;
      display: flex;
      min-height: 100vh
    }

    /* Sidebar - same as dashboard */
    .sidebar {
      width: 230px;
      background: #1e1e1e;
      color: white;
      padding: 22px 18px;
      flex-shrink: 0
    }

    .sidebar h1 {
      font-size: 19px;
      line-height: 1.2;
      margin-bottom: 4px
    }

    .sidebar h1 span {
      color: #d4af37
    }

    .sidebar p {
      font-size: 11px;
      color: #aaa;
      margin-bottom: 28px
    }

    .sidebar a {
      display: block;
      color: #ddd;
      text-decoration: none;
      padding: 11px 12px;
      border-radius: 8px;
      font-size: 13px;
      margin-bottom: 6px
    }

    .sidebar a.active,
    .sidebar a:hover {
      background: #333;
      color: white
    }

    .sidebar .logout {
      margin-top: 30px;
      color: #ff9a9a
    }

    /* Main */
    .main {
      flex: 1;
      padding: 22px 26px
    }

    .topbar {
      display: flex;
      justify-content: space-between;
      align-items: center;
      margin-bottom: 18px
    }

    .topbar h2 {
      font-size: 20px
    }

    .topbar span {
      font-size: 12px;
      color: #888
    }

    .top-stats {
      display: grid;
      grid-template-columns: repeat(4, 1fr);
      gap: 14px;
      margin-bottom: 18px
    }

    .stat {
      background: white;
      padding: 18px;
      border-radius: 12px;
      text-align: center;
      box-shadow: 0 2px 10px rgba(0, 0, 0, .04)
    }

    .stat h1 {
      font-size: 26px;
      color: #111
    }

    .stat p {
      font-size: 10px;
      font-weight: 800;
      color: #888;
      text-transform: uppercase;
      margin-top: 4px
    }

    .card {
      background: white;
      border-radius: 12px;
      padding: 20px;
      box-shadow: 0 2px 10px rgba(0, 0, 0, .04)
    }

    .card h2 {
      font-size: 14px;
      margin-bottom: 8px
    }

    .card small {
      font-size: 11px;
      color: #888
    }

    table {
      width: 100%;
      border-collapse: collapse;
      margin-top: 12px
    }

    th {
      text-align: left;
      padding: 10px;
      font-size: 11px;
      color: #888;
      border-bottom: 1px solid #eee;
      text-transform: uppercase
    }

    td {
      padding: 11px 10px;
      border-bottom: 1px solid #f5f5f5;
      font-size: 12px
    }

    .badge {
      padding: 5px 10px;
      border-radius: 20px;
      font-size: 10px;
      font-weight: 800;
      text-transform: uppercase
    }

    .Pending {
      background: #fff3cd;
      color: #856404
    }

    .Approved {
      background: #d4edda;
      color: #155724
    }

    .Rejected {
      background: #f8d7da;
      color: #721c24
    }

    .alert {
      padding: 11px 14px;
      border-radius: 8px;
      margin-bottom: 12px;
      font-size: 12px;
      font-weight: 700
    }

    .btn {
      display: inline-block;
      padding: 10px 16px;
      border-radius: 20px;
      text-decoration: none;
      font-size: 12px;
      font-weight: 700;
      background: #111;
      color: white
    }

    @media(max-width:900px) {
      body {
        flex-direction: column
      }

      .sidebar {
        width: 100%
      }

      .top-stats {
        grid-template-columns: repeat(2, 1fr)
      }
    }
  </style>
</head>

<body>

  <div class="sidebar">
    <h1>USIU - AFRICA<br><span>LABORATORY PORTAL</span></h1>
    <p>School of Science and Technology</p>
    <a href="dashboard.php">🏠 Dashboard</a>
    <a href="book.php">📦 Book Equipment</a>
    <a href="mybookings.php" class="active">📋 My Bookings</a>
    <a href="logout.php" class="logout">↩ Logout</a>
  </div>

  <div class="main">
    <div class="topbar">
      <div>
        <h2>My Bookings</h2><span>United States International University - Africa</span>
      </div>
      <div><a class="btn" href="book.php">+ Book New</a></div>
    </div>

    <?php if ($approved > 0) {
      echo "<div class='alert' style='background:#d4edda;color:#155724'>✅ You have $approved APPROVED request(s) - Ready for collection at Block C, Room 12</div>";
    } ?>
    <?php if ($rejected > 0) {
      echo "<div class='alert' style='background:#f8d7da;color:#721c24'>❌ You have $rejected REJECTED request(s) - Please visit Lab Admin Office for clarification</div>";
    } ?>

    <div class="top-stats">
      <div class="stat">
        <h1><?php echo $total; ?></h1>
        <p>Total</p>
      </div>
      <div class="stat">
        <h1><?php echo $pending; ?></h1>
        <p>Pending</p>
      </div>
      <div class="stat">
        <h1><?php echo $approved; ?></h1>
        <p>Approved</p>
      </div>
      <div class="stat">
        <h1><?php echo $rejected; ?></h1>
        <p>Rejected</p>
      </div>
    </div>

    <div class="card">
      <h2>My Laboratory Requests</h2>
      <small>Last updated: <?php echo date('d M Y H:i:s'); ?> | Showing for: <b><?php echo $email; ?></b> | <a href="mybookings.php">↻ Refresh</a></small>
      <table>
        <tr>
          <th>Ref No</th>
          <th>Equipment</th>
          <th>Collection</th>
          <th>Return</th>
          <th>Purpose</th>
          <th>Status</th>
        </tr>
        <?php $r = $conn->query("SELECT * FROM bookings WHERE email='$email' ORDER BY id DESC");
        if ($r->num_rows == 0) {
          echo "<tr><td colspan=6 style='text-align:center;padding:30px;color:#888'>No bookings yet for <b>$email</b><br><small>Your email is: $email</small></td></tr>";
        }
        while ($row = $r->fetch_assoc()) {
          $color = $row['status'] == 'Approved' ? '#d4edda' : ($row['status'] == 'Rejected' ? '#f8d7da' : '#fff');
          echo "<tr style='background:$color'><td><b>#USIU00" . $row['id'] . "</b></td><td><b>" . $row['equipment'] . "</b></td><td>" . $row['book_date'] . "</td><td>" . $row['return_date'] . "</td><td>" . substr($row['purpose'], 0, 50) . "</td><td><span class='badge " . $row['status'] . "'>" . $row['status'] . "</span></td></tr>";
        } ?>
      </table>
    </div>
  </div>

</body>

</html>