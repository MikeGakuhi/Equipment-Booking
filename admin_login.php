<?php session_start(); 
if($_POST['email']=="admin@usiu.ac.ke" && $_POST['password']=="admin123"){ 
 $_SESSION['admin']=$_POST['email']; 
 header("Location: admin_dashboard.php"); 
 exit();
}else{ ?>
<!DOCTYPE html><html><head><title>Login Failed</title><style>body{font-family:'Segoe UI',Arial;background:linear-gradient(135deg,#eef1f8 0%,#d6e4f0 100%);display:flex;align-items:center;justify-content:center;height:100vh;margin:0}.card{background:rgba(255,255,255,0.95);padding:35px;border-radius:16px;box-shadow:0 15px 35px rgba(10,25,49,.15);border-top:5px solid #dc3545;text-align:center;backdrop-filter:blur(10px);min-width:320px}.btn{background:#0a1931;color:#FFC72C;padding:12px 20px;border-radius:8px;text-decoration:none;display:inline-block;margin-top:18px;font-weight:600;border:1px solid #FFC72C}</style></head><body><div class="card"><h2 style="color:#721c24;margin:0">❌ Wrong Admin Credentials</h2><p style="font-size:12px;color:#666;margin-top:12px">Use: admin@usiu.ac.ke / admin123</p><a class="btn" href="admin.php">← Back to Admin Login</a></div></body></html>
<?php } ?>
