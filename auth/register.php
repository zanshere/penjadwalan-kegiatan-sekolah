<?php 
    session_start();
    require_once __DIR__ . "/../config/baseURL.php";
    require_once __DIR__ . '/../config/security.php';

    $csrf_token = generateCSRFToken();

?>

<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>Register</title>
  <!-- Tailwindcss + Bootstrap Icon -->
  <link rel="stylesheet" href="<?= BASE_URL ?>src/css/output.css">
</head>
<body class="bg-gray-100 flex items-center justify-center min-h-screen">
  <div class="w-full max-w-md bg-white rounded-2xl shadow-xl p-8">
    <div class="text-center mb-6">
      <i class="bi bi-person-plus-fill text-green-600 text-4xl"></i>
      <h1 class="text-2xl font-semibold mt-2">Register</h1>
      <p class="text-gray-500">Buat akun baru untuk mulai</p>
    </div>
    <form action="<?= BASE_URL ?>functions/proses_register.php" method="POST" class="space-y-5">
    <input type="hidden" name="csrf_token" value="<?= $_SESSION['csrf_token']; ?>">
      <div>
        <label class="block mb-1 font-medium text-sm text-gray-700">Nama</label>
        <input type="text" name="name" required class="w-full px-4 py-2 border text-black border-gray-300 rounded-xl focus:outline-none focus:ring-2 focus:ring-green-500" placeholder="John Doe">
      </div>
      <div>
        <label class="block mb-1 font-medium text-sm text-gray-700">Email</label>
        <input type="email" name="email" required class="w-full px-4 py-2 border text-black border-gray-300 rounded-xl focus:outline-none focus:ring-2 focus:ring-green-500" placeholder="Example : yourmail@gmail.com">
      </div>
      <div>
        <label class="block mb-1 font-medium text-sm text-gray-700">Password</label>
        <input type="password" name="password" required class="w-full px-4 py-2 border text-black border-gray-300 rounded-xl focus:outline-none focus:ring-2 focus:ring-green-500" placeholder="Example : @Name123">
      </div>
      <button type="submit" class="w-full bg-green-600 text-white py-2 rounded-xl hover:bg-green-700 transition">Register</button>
    </form>
    <p class="text-center text-sm text-gray-600 mt-6">
      Sudah punya akun?
      <a href="<?= BASE_URL ?>auth/login.php" class="text-green-600 hover:underline">Login sekarang</a>
    </p>
  </div>
</body>
</html>
