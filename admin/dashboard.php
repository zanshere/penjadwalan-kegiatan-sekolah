<?php 
require_once __DIR__ . "/../config/baseURL.php";
include "../includes/header.php";

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dashboard - Admin</title>
</head>
<body>
    <!-- Hero Section -->
  <div class="relative h-screen w-full overflow-hidden">

    <!-- Overlay -->
    <div class="absolute inset-0 bg-black/40 z-10"></div>

    <!-- Content -->
    <div class="relative z-20 h-full flex items-center justify-center px-4 sm:px-6 lg:px-8">
      <div class="text-center max-w-2xl space-y-6 backdrop-blur-xl bg-white/5 dark:bg-gray-900/40 p-8 rounded-3xl 
                shadow-2xl border border-white/10 dark:border-gray-700 hover:bg-white/10 dark:hover:bg-gray-800/50 transition-all duration-300">
        <h1 class="text-4xl sm:text-5xl font-black text-transparent bg-clip-text 
                  bg-gradient-to-r from-blue-300 to-blue-100 dark:from-blue-400 dark:to-blue-200 animate-fade-in">
          Welcome to
        </h1>
        
        <div class="mb-8">
          <span id="typing" class="text-3xl sm:text-4xl font-bold text-white dark:text-blue-300 block">
            Admin Dashboard
          </span>
        </div>

        <p class="text-lg text-blue-100/90 dark:text-blue-200 leading-relaxed max-w-xl mx-auto">
          Di dashboard, anda dapat menambahkan, mengedit dan menghapus events, schedules dan students
        </p>
      </div>
    </div>
  </div>
</body>
</html>