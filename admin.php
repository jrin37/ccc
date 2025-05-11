<?php
session_start();

// Koneksi ke database (ganti sesuai konfigurasi Anda)
$host = 'localhost';
$user = 'root';
$pass = '';
$db = 'mikrotik_manager';

$conn = new mysqli($host, $user, $pass, $db);
if ($conn->connect_error) {
  die('Koneksi database gagal: ' . $conn->connect_error);
}

// Proses penyimpanan jika form disubmit
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
  $session_name = $_POST['session_name'];
  $ip = $_POST['ip'];
  $username = $_POST['username'];
  $password = $_POST['password'];
  $hotspot_name = $_POST['hotspot_name'];
  $dns_name = $_POST['dns_name'];
  $currency = $_POST['currency'];
  $autoload = $_POST['autoload'];
  $idle_timeout = $_POST['idle_timeout'];
  $live_report = $_POST['live_report'];

  $stmt = $conn->prepare("INSERT INTO routers (session_name, ip, username, password, hotspot_name, dns_name, currency, autoload, idle_timeout, live_report) VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?)");
  $stmt->bind_param("ssssssssss", $session_name, $ip, $username, $password, $hotspot_name, $dns_name, $currency, $autoload, $idle_timeout, $live_report);
  $stmt->execute();
  $stmt->close();

  echo "<p>Router berhasil ditambahkan!</p>";
}
?>

<!DOCTYPE html>
<html>
<head>
  <title>Admin - Tambah Router</title>
  <style>
    body {
      font-family: sans-serif;
      background: #f4f4f4;
      padding: 20px;
    }
    form {
      background: white;
      padding: 30px;
      border-radius: 10px;
      max-width: 600px;
      margin: auto;
      box-shadow: 0 2px 10px rgba(0,0,0,0.1);
    }
    input, select {
      width: 100%;
      padding: 10px;
      margin: 8px 0 20px;
      border: 1px solid #ccc;
      border-radius: 5px;
    }
    input[type="submit"] {
      background: #007bff;
      color: white;
      border: none;
      cursor: pointer;
    }
    input[type="submit"]:hover {
      background: #0056b3;
    }
  </style>
</head>
<body>

<h2 style="text-align:center;">Tambah Router Baru</h2>
<form method="POST">
  <label>Session Name</label>
  <input type="text" name="session_name" required>

  <label>IP Address</label>
  <input type="text" name="ip" required>

  <label>Username</label>
  <input type="text" name="username" required>

  <label>Password</label>
  <input type="password" name="password" required>

  <label>Hotspot Name</label>
  <input type="text" name="hotspot_name">

  <label>DNS Name</label>
  <input type="text" name="dns_name">

  <label>Currency</label>
  <input type="text" name="currency">

  <label>Autoload</label>
  <select name="autoload">
    <option value="yes">Yes</option>
    <option value="no">No</option>
  </select>

  <label>Idle Timeout</label>
  <input type="text" name="idle_timeout">

  <label>Live Report</label>
  <select name="live_report">
    <option value="yes">Yes</option>
    <option value="no">No</option>
  </select>

  <input type="submit" value="Simpan Router">
</form>

</body>
</html>
