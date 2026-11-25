<!DOCTYPE html>
<html>

<head>
  <title>Admin - United States International University</title>
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
      padding: 16px 25px
    }

    .nav b {
      font-size: 13px
    }

    .nav span {
      color: #d4af37
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
      font-size: 16px
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

  <div class="nav"><b>USIU - AFRICA <span>| ADMINISTRATOR</span></b></div>

  <div class="card">
    <h2>Laboratory Administrator Login</h2>
    <p style="font-size:12px;color:#888;margin:10px 0 18px">Authorized personnel only - School of Science and Technology</p>
    <form method="POST" action="admin_login.php">
      <label>Admin Email</label>
      <input type="email" name="email" value="admin@usiu.ac.ke">
      <label style="margin-top:12px">Password</label>
      <input type="password" name="password" value="admin123">
      <button>Access Admin Panel</button>
    </form>
    <p style="text-align:center;margin-top:14px;font-size:12px"><a href="index.php" style="color:#111;font-weight:700">← Back to Student Portal</a></p>
  </div>

</body>

</html>