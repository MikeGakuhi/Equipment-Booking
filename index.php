<!DOCTYPE html>
<html>

<head>
  <title>United States International University - Login</title>
  <style>
    * {
      margin: 0;
      padding: 0;
      box-sizing: border-box
    }

    body {
      font-family: 'Segoe UI', Arial;
      background: #fdf2f5;
      min-height: 100vh;
      color: #222
    }

    .nav {
      background: #1e1e1e;
      color: white;
      padding: 16px 25px;
      display: flex;
      justify-content: space-between;
      align-items: center
    }

    .nav b {
      font-size: 13px
    }

    .nav a {
      color: white;
      text-decoration: none;
      margin-left: 15px;
      font-size: 11px;
      font-weight: 700;
      text-transform: uppercase
    }

    .card {
      background: white;
      max-width: 480px;
      margin: 70px auto;
      padding: 32px;
      border-radius: 14px;
      box-shadow: 0 2px 15px rgba(0, 0, 0, .06)
    }

    h2 {
      font-size: 16px;
      margin-bottom: 6px
    }

    h2 span {
      color: #d4af37
    }

    label {
      font-size: 11px;
      font-weight: 800;
      color: #111;
      text-transform: uppercase;
      display: block
    }

    input {
      width: 100%;
      padding: 12px;
      margin-top: 8px;
      border: 1.5px solid #eee;
      border-radius: 8px;
      background: #fdf2f5;
      font-size: 13px
    }

    input:focus {
      border-color: #111;
      outline: none;
      background: white
    }

    button {
      width: 100%;
      padding: 13px;
      margin-top: 18px;
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
  </style>
</head>

<body>

  <div class="nav">
    <div><b>USIU - AFRICA <span style="color:#d4af37">| LABORATORY PORTAL</span></b></div>
    <div><a href="index.php">Student Portal</a><a href="admin.php" style="color:#d4af37">Admin</a></div>
  </div>

  <div class="card">
    <h2>Student Laboratory Portal</h2>
    <p style="font-size:12px;color:#888;margin-bottom:18px">School of Science and Technology - Equipment Booking System</p>
    <?php if (isset($_GET['error'])) echo "<p style='color:#721c24;font-size:12px;background:#f8d7da;padding:10px;border-radius:8px;margin-bottom:12px'>" . $_GET['error'] . "</p>"; ?>
    <form method="POST" action="login.php">
      <label>University Email</label>
      <input type="email" name="email" placeholder="e.g. mike@usiu.ac.ke" required>
      <label style="margin-top:14px">Password</label>
      <input type="password" name="password" required>
      <button>Login to Portal</button>
    </form>
    <p style="text-align:center;margin-top:16px;font-size:12px">New student? <a href="register.php" style="color:#111;font-weight:700">Create Student Account</a></p>
  </div>

</body>

</html>