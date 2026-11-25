<?php session_start();
if (!isset($_SESSION['email'])) {
  header("Location: index.php");
  exit();
}
include 'db.php';

$email = $_SESSION['email'];

// Get real name from users table, show first name only - Mike, not mgnduati
$row = $conn->query("SELECT name FROM users WHERE email='$email'")->fetch_assoc();
$fullName = $row['name'] ?? 'Mike';
$name = ucfirst(strtolower(explode(' ', trim($fullName))[0]));

$total = $conn->query("SELECT COUNT(*) as c FROM bookings WHERE email='$email'")->fetch_assoc()['c'];
$pending = $conn->query("SELECT COUNT(*) as c FROM bookings WHERE email='$email' AND status='Pending'")->fetch_assoc()['c'];
$approved = $conn->query("SELECT COUNT(*) as c FROM bookings WHERE email='$email' AND status='Approved'")->fetch_assoc()['c'];
?>
<!DOCTYPE html>
<html>

<head>
  <title>Dashboard - USIU Equipment Booking System</title>
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

    /* Sidebar */
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

    .banner {
      background: #111;
      color: white;
      border-radius: 14px;
      padding: 24px;
      display: flex;
      justify-content: space-between;
      align-items: center;
      margin-bottom: 20px
    }

    .banner h2 {
      font-size: 22px;
      margin-bottom: 6px
    }

    .banner p {
      font-size: 13px;
      color: #ccc;
      line-height: 1.6
    }

    .btn {
      display: inline-block;
      background: white;
      color: #111;
      padding: 11px 18px;
      border-radius: 20px;
      text-decoration: none;
      font-size: 12px;
      font-weight: 700
    }

    .layout {
      display: grid;
      grid-template-columns: 2fr 1fr;
      gap: 18px;
      align-items: start
    }

    .stats {
      display: grid;
      grid-template-columns: repeat(3, 1fr);
      gap: 14px;
      grid-column: 1/-1
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
      box-shadow: 0 2px 10px rgba(0, 0, 0, .04);
      margin-bottom: 18px
    }

    .card h2 {
      font-size: 14px;
      margin-bottom: 12px
    }

    table {
      width: 100%;
      border-collapse: collapse
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

    .info {
      background: #fdf2f5;
      padding: 12px;
      border-radius: 8px;
      margin-bottom: 10px;
      border-left: 3px solid #111;
      font-size: 12px;
      line-height: 1.6
    }

    ul {
      font-size: 12px;
      color: #555;
      line-height: 1.9;
      padding-left: 16px
    }

    @media(max-width:900px) {
      body {
        flex-direction: column
      }

      .sidebar {
        width: 100%
      }

      .layout {
        grid-template-columns: 1fr
      }

      .stats {
        grid-template-columns: repeat(3, 1fr)
      }

      .banner {
        flex-direction: column;
        align-items: flex-start;
        gap: 14px
      }
    }
  </style>
</head>

<body>

  <div class="sidebar">
    <h1>USIU - AFRICA<br><span>EQUIPMENT BOOKING</span></h1>
    <p>University Equipment Booking System</p>
    <a href="dashboard.php" class="active">🏠 Dashboard</a>
    <a href="book.php">📦 Book Equipment</a>
    <a href="mybookings.php">📋 My Bookings</a>
    <a href="logout.php" class="logout">↩ Logout</a>
  </div>

  <div class="main">
    <div class="topbar">
      <div>
        <h2>Dashboard</h2><span>University Equipment Booking System</span>
      </div>
      <div style="text-align:right"><b><?php echo $name; ?></b><br><span><?php echo $email; ?></span></div>
    </div>

    <div class="layout">
      <div>
        <div class="banner">
          <div>
            <h2>Good morning, <?php echo $name; ?> 👋</h2>
            <p>Welcome back to USIU Equipment Booking System.<br>You have <b style="color:#d4af37"><?php echo $pending; ?> pending request(s)</b>. Book equipment easily and track your requests here.</p>
          </div>
          <div>
            <a class="btn" href="book.php">+ Book Equipment</a>
          </div>
        </div>

        <div class="stats">
          <div class="stat">
            <h1><?php echo $total; ?></h1>
            <p>My Bookings</p>
          </div>
          <div class="stat">
            <h1><?php echo $pending; ?></h1>
            <p>Pending</p>
          </div>
          <div class="stat">
            <h1><?php echo $approved; ?></h1>
            <p>Approved</p>
          </div>
        </div>

        <div class="card" style="margin-top:18px">
          <h2>My Recent Bookings</h2>
          <table>
            <tr>
              <th>Ref</th>
              <th>Equipment</th>
              <th>Date</th>
              <th>Status</th>
            </tr>
            <?php $r = $conn->query("SELECT * FROM bookings WHERE email='$email' ORDER BY id DESC LIMIT 5");
            while ($row = $r->fetch_assoc()) {
              echo "<tr><td><b>#USIU00" . $row['id'] . "</b></td><td>" . $row['equipment'] . "</td><td>" . $row['book_date'] . "</td><td><span class='badge " . $row['status'] . "'>" . $row['status'] . "</span></td></tr>";
            } ?>
          </table>
        </div>
      </div>

      <div>
        <div class="card">
          <h2>Quick Info</h2>
          <div class="info"><b>Most Requested:</b><br>Microscope Olympus CX23 (8x this week)</div>
          <div class="info" style="border-left-color:#d4af37"><b>Notice:</b><br>Please return equipment on time to avoid penalties</div>
          <div class="info" style="border-left-color:#28a745"><b>Returns Today:</b><br>2 equipment due for return</div>
        </div>
        <div class="card">
          <h2>Available Equipment</h2>
          <ul>
            <li>Microscope - 8 units</li>
            <li>Projector - 5 units</li>
            <li>DSLR Camera - 4 units</li>
            <li>Chemistry Kit - 12 units</li>
            <li>Laptop - 10 units</li>
            <li>Spectrophotometer - 2 units</li>
          </ul>
        </div>
      </div>
    </div>
  </div>

</body>

</html>