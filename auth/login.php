<?php
session_start();
require_once __DIR__ . "/../config/baseURL.php";
require_once __DIR__ . '/../config/security.php';

$csrf_token = generateCSRFToken();

if ($valid_login) {
    $_SESSION['name'] = $username;
    header("Location: ../index.php");
    exit;
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1" />
  <title>Login</title>
  <meta http-equiv="Content-Security-Policy" content="default-src 'self'; style-src 'self' https://cdn.jsdelivr.net; script-src 'none';" />
  <link rel="stylesheet" href="<?= BASE_URL ?>src/css/output.css" />
</head>
<body class="bg-gray-100 min-h-screen flex items-center justify-center px-4">
  <div class="w-full max-w-md bg-white rounded-2xl shadow-xl p-8">
    <div class="text-center mb-6">
      <i class="bi bi-lock-fill text-blue-600 text-4xl"></i>
      <h1 class="text-2xl font-semibold mt-2">Login</h1>
      <p class="text-gray-500">Silakan masuk ke akun Anda</p>
    </div>
    <form action="<?= BASE_URL ?>functions/proses_login.php" method="POST" class="space-y-5" autocomplete="on" novalidate>
      <input type="hidden" name="csrf_token" value="<?= $_SESSION['csrf_token']; ?>" />
      <div>
        <label class="block mb-1 font-medium text-sm text-gray-700" for="email">Email</label>
        <input
          id="email"
          type="email"
          name="email"
          required
          autocomplete="on"
          placeholder="yourmail@gmail.com"
          class="w-full px-4 py-2 border text-black border-gray-300 rounded-xl focus:outline-none focus:ring-2 focus:ring-blue-500"
        />
      </div>
      <div>
        <label class="block mb-1 font-medium text-sm text-gray-700" for="password">Password</label>
        <input
          id="password"
          type="password"
          name="password"
          required
          placeholder="Example : @name123"
          class="w-full px-4 py-2 border text-black border-gray-300 rounded-xl focus:outline-none focus:ring-2 focus:ring-blue-500"
        />
      </div>
      <div class="flex items-center justify-between">
        <label class="flex items-center" for="remember_me">
          <input
            id="remember_me"
            type="checkbox"
            name="remember_me"
            checked="checked"
            class="checkbox checkbox-info mr-2"
          />
          <span class="text-sm text-gray-600">Ingat saya</span>
        </label>
        <a href="#" class="text-sm text-blue-600 hover:underline">Lupa password?</a>
      </div>
      <button
        type="submit"
        class="w-full bg-blue-600 text-white py-2 rounded-xl hover:bg-blue-700 transition"
      >
        Login
      </button>
    </form>
    <p class="text-center text-sm text-gray-600 mt-6">
      Belum punya akun?
      <a href="<?= BASE_URL ?>auth/register.php" class="text-blue-600 hover:underline">Daftar sekarang</a>
    </p>
  </div>
</body>
</html>
