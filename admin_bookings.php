<?php session_start();
if (!isset($_SESSION['admin'])) {
  header("Location: admin.php");
  exit();
}
include 'db.php';
if (isset($_GET['approve'])) {
  $id = $_GET['approve'];
  $conn->query("UPDATE bookings SET status='Approved' WHERE id=$id");
}
if (isset($_GET['reject'])) {
  $id = $_GET['reject'];
  $conn->query("UPDATE bookings SET status='Rejected' WHERE id=$id");
}
?>
<!DOCTYPE html>
<html>

<head>
  <title>Manage Bookings - Admin</title>
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

    /* Sidebar - same as admin dashboard */
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

    .card {
      background: white;
      border-radius: 12px;
      padding: 20px;
      box-shadow: 0 2px 10px rgba(0, 0, 0, .04)
    }

    .card h2 {
      font-size: 14px;
      margin-bottom: 14px
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

    .btn {
      padding: 6px 11px;
      border-radius: 20px;
      text-decoration: none;
      font-size: 11px;
      font-weight: 700;
      color: white;
      display: inline-block
    }

    .approve {
      background: #28a745
    }

    .reject {
      background: #dc3545;
      margin-left: 4px
    }

    @media(max-width:900px) {
      body {
        flex-direction: column
      }

      .sidebar {
        width: 100%
      }
    }
  </style>
</head>

<body>

  <div class="sidebar">
    <h1>USIU - AFRICA<br><span>ADMIN PANEL</span></h1>
    <p>Laboratory Management</p>
    <a href="admin_dashboard.php">🏠 Dashboard</a>
    <a href="admin_bookings.php" class="active">📋 Bookings</a>
    <a href="logout.php" class="logout">↩ Logout</a>
  </div>

  <div class="main">
    <div class="topbar">
      <div>
        <h2>Manage Bookings</h2><span>All Equipment Requests - Laboratory Management</span>
      </div>
      <div><span>Administrator</span></div>
    </div>

    <div class="card">
      <h2>All Equipment Requests</h2>
      <table>
        <tr>
          <th>Ref</th>
          <th>Student Email</th>
          <th>Equipment</th>
          <th>Collection</th>
          <th>Return</th>
          <th>Purpose</th>
          <th>Status</th>
          <th>Action</th>
        </tr>
        <?php $r = $conn->query("SELECT * FROM bookings ORDER BY id DESC");
        while ($row = $r->fetch_assoc()) {
          echo "<tr><td><b>#USIU00" . $row['id'] . "</b></td><td>" . $row['email'] . "</td><td>" . $row['equipment'] . "</td><td>" . $row['book_date'] . "</td><td>" . $row['return_date'] . "</td><td>" . substr($row['purpose'], 0, 40) . "</td><td><span class='badge " . $row['status'] . "'>" . $row['status'] . "</span></td><td><a class='btn approve' href='?approve=" . $row['id'] . "'>Approve</a> <a class='btn reject' href='?reject=" . $row['id'] . "'>Reject</a></td></tr>";
        } ?>
      </table>
    </div>
  </div>

</body>

</html>