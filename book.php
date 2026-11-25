<?php session_start();
if (!isset($_SESSION['email'])) {
  header("Location: index.php");
  exit();
}
include 'db.php';
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
  $e = $_SESSION['email'];
  $eq = $_POST['equipment'];
  $bd = $_POST['book_date'];
  $rd = $_POST['return_date'];
  $pu = $_POST['purpose'];
  $conn->query("INSERT INTO bookings (email,equipment,book_date,return_date,purpose) VALUES ('$e','$eq','$bd','$rd','$pu')");
  header("Location: mybookings.php");
  exit();
} ?>
<!DOCTYPE html>
<html>

<head>
  <title>Book Equipment</title>
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

    .wrapper {
      display: grid;
      grid-template-columns: 1.6fr 1fr;
      gap: 20px;
      align-items: start
    }

    .form-card {
      background: white;
      border-radius: 12px;
      padding: 28px;
      box-shadow: 0 2px 10px rgba(0, 0, 0, .04)
    }

    .form-card h2 {
      font-size: 15px;
      margin-bottom: 6px
    }

    .form-card p {
      font-size: 12px;
      color: #666;
      margin-bottom: 18px
    }

    label {
      display: block;
      margin-top: 14px;
      font-size: 11px;
      font-weight: 800;
      text-transform: uppercase;
      color: #111
    }

    input,
    select,
    textarea {
      width: 100%;
      padding: 12px;
      margin-top: 6px;
      border: 1.5px solid #eee;
      border-radius: 8px;
      background: #fdf2f5;
      font-size: 13px
    }

    input:focus,
    select:focus,
    textarea:focus {
      outline: none;
      border-color: #111;
      background: white
    }

    button {
      width: 100%;
      padding: 13px;
      margin-top: 20px;
      background: #111;
      color: white;
      border: none;
      border-radius: 20px;
      font-weight: 800;
      text-transform: uppercase;
      cursor: pointer
    }

    button:hover {
      background: #333
    }

    .side-card {
      background: white;
      border-radius: 12px;
      padding: 20px;
      box-shadow: 0 2px 10px rgba(0, 0, 0, .04)
    }

    .side-card h3 {
      font-size: 12px;
      margin-bottom: 12px
    }

    .avail {
      background: #fdf2f5;
      padding: 10px 12px;
      border-radius: 8px;
      margin-bottom: 8px;
      font-size: 12px;
      border-left: 3px solid #d4af37
    }

    @media(max-width:900px) {
      body {
        flex-direction: column
      }

      .sidebar {
        width: 100%
      }

      .wrapper {
        grid-template-columns: 1fr
      }
    }
  </style>
</head>

<body>

  <div class="sidebar">
    <h1>USIU - AFRICA<br><span>LABORATORY PORTAL</span></h1>
    <p>School of Science and Technology</p>
    <a href="dashboard.php">🏠 Dashboard</a>
    <a href="book.php" class="active">📦 Book Equipment</a>
    <a href="mybookings.php">📋 My Bookings</a>
    <a href="logout.php" class="logout">↩ Logout</a>
  </div>

  <div class="main">
    <div class="topbar">
      <div>
        <h2>Book Equipment</h2><span>United States International University - Africa</span>
      </div>
      <div><span>School of Science and Technology</span></div>
    </div>

    <div class="wrapper">
      <div class="form-card">
        <h2>Laboratory Equipment Requisition Form</h2>
        <p>School of Science and Technology - All fields required.</p>
        <form method="POST"><label>Select Laboratory Equipment *</label><select name="equipment" required>
            <option value="">-- Choose Equipment --</option>
            <option>Microscope Olympus CX23 - Bio Lab 2</option>
            <option>Projector Epson EB-X51 - Media Lab</option>
            <option>DSLR Camera Canon 250D - ICT Lab</option>
            <option>Chemistry Kit Advanced - Chem Lab</option>
            <option>Laptop Dell Latitude 5430 - Computer Lab</option>
            <option>Spectrophotometer UV-Vis - Research Lab</option>
          </select>
          <div style="display:grid;grid-template-columns:1fr 1fr;gap:12px">
            <div><label>Collection Date *</label><input type="date" name="book_date" required></div>
            <div><label>Return Date *</label><input type="date" name="return_date" required></div>
          </div><label>Purpose / Research Activity *</label><textarea name="purpose" rows="4" placeholder="e.g. Final Year Project - BIO 412" required></textarea><button type="submit">Submit Requisition Request</button>
        </form>
      </div>

      <div class="side-card">
        <h3>AVAILABLE TODAY</h3>
        <div class="avail"><b>Microscope</b> - 8 Available</div>
        <div class="avail"><b>Projector</b> - 5 Available</div>
        <div class="avail"><b>DSLR Camera</b> - 4 Available</div>
      </div>
    </div>
  </div>

</body>

</html>