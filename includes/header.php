<?php 
session_start(); // Pastikan session sudah start
require_once __DIR__ . "/../config/baseURL.php";
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1" />
    <title>Penjadwalan Kegiatan Sekolah</title>
    <script src="<?= BASE_URL ?>src/js/darkToggle.js"></script>
    <link rel="stylesheet" href="<?= BASE_URL ?>src/css/output.css" />
</head>
<body class="bg-white dark:bg-gray-900 text-gray-800 dark:text-gray-100 transition-colors duration-200">

    <!-- Navbar -->
    <nav class="navbar bg-white dark:bg-gray-900 border-b border-gray-200 dark:border-gray-700 px-4 sm:px-6 lg:px-8">
        <div class="navbar-start">
            <!-- Mobile Menu -->
            <div class="dropdown">
                <div tabindex="0" role="button" class="btn btn-ghost lg:hidden text-gray-600 dark:text-gray-300">
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h8m-8 6h16" />
                    </svg>
                </div>
                <ul tabindex="0" class="menu menu-sm dropdown-content mt-3 z-[1] p-2 shadow bg-white dark:bg-gray-800 rounded-box w-52">
                    <?php if (isset($_SESSION['user_id'])): ?>
                        <li><a href="<?= BASE_URL ?>admin/dashboard.php" class="px-4 py-2 text-gray-700 dark:text-gray-300 hover:bg-gray-100 dark:hover:bg-gray-700 rounded-lg">Home</a></li>
                        <li><a href="<?= BASE_URL ?>admin/add.php" class="text-gray-700 dark:text-gray-200 hover:bg-gray-100 dark:hover:bg-gray-700">Add Data</a></li>
                        <li><a href="<?= BASE_URL ?>admin/data.php" class="text-gray-700 dark:text-gray-200 hover:bg-gray-100 dark:hover:bg-gray-700">See Data</a></li>
                    <?php endif; ?>
                </ul>
            </div>
            <a href="<?= BASE_URL ?>" class="btn btn-ghost text-xl text-gray-800 dark:text-gray-200">daisyUI</a>
        </div>

        <!-- Desktop Menu -->
        <div class="navbar-center hidden lg:flex">
            <ul class="menu menu-horizontal px-1 gap-2">
                <?php if (isset($_SESSION['user_id'])): ?>
                    <li><a href="<?= BASE_URL ?>admin/dashboard.php" class="px-4 py-2 text-gray-700 dark:text-gray-300 hover:bg-gray-100 dark:hover:bg-gray-700 rounded-lg">Home</a></li>
                    <li><a href="<?= BASE_URL ?>admin/add.php" class="px-4 py-2 text-gray-700 dark:text-gray-300 hover:bg-gray-100 dark:hover:bg-gray-700 rounded-lg">Add Data</a></li>
                    <li><a href="<?= BASE_URL ?>admin/data.php" class="px-4 py-2 text-gray-700 dark:text-gray-300 hover:bg-gray-100 dark:hover:bg-gray-700 rounded-lg">See Data</a></li>
                <?php endif; ?>
            </ul>
        </div>

        <!-- Navbar End -->
        <div class="navbar-end gap-3 items-center">
            <?php if (isset($_SESSION['user_id'])): ?>
                <!-- Jika user sudah login -->
                <div class="relative group">
                    <div class="flex items-center gap-2 cursor-pointer">
                        <i class="bi bi-person-circle text-2xl text-gray-700 dark:text-gray-300"></i>
                        <span class="text-gray-700 dark:text-gray-300 font-medium"><?= htmlspecialchars($_SESSION['name']) ?></span>
                        <i class="bi bi-caret-down-fill text-sm text-gray-700 dark:text-gray-300"></i>
                    </div>
                    <div class="absolute right-0 mt-2 hidden group-hover:block bg-white dark:bg-gray-800 border border-gray-300 dark:border-gray-600 rounded shadow-lg py-2 w-40 z-10">
                        <a href="<?= BASE_URL ?>auth/profile.php" class="flex items-center gap-2 px-4 py-2 text-gray-700 dark:text-gray-200 hover:bg-gray-100 dark:hover:bg-gray-700">
                            <i class="bi bi-person"></i> Profile
                        </a>
                        <a href="<?= BASE_URL ?>auth/logout.php" class="flex items-center gap-2 px-4 py-2 text-red-600 hover:bg-gray-100 dark:hover:bg-gray-700">
                            <i class="bi bi-box-arrow-right"></i> Logout
                        </a>
                    </div>
                </div>
            <?php else: ?>
                <!-- Jika user belum login -->
                <a href="<?= BASE_URL ?>auth/login.php" class="px-4 py-2 border border-gray-300 dark:border-gray-600 rounded-lg hover:bg-gray-800 hover:text-white dark:hover:bg-gray-100 dark:hover:text-gray-900 transition-colors duration-200 text-gray-700 dark:text-gray-300">
                    Login
                </a>
                <p class="text-gray-500 dark:text-gray-400">Atau</p>
                <a href="<?= BASE_URL ?>auth/register.php" class="px-4 py-2 border border-gray-300 dark:border-gray-600 rounded-lg hover:bg-gray-800 hover:text-white dark:hover:bg-gray-100 dark:hover:text-gray-900 transition-colors duration-200 text-gray-700 dark:text-gray-300">
                    Register
                </a>
            <?php endif; ?>

            <!-- Dark Mode Toggle -->
            <label class="swap swap-rotate px-2 cursor-pointer">
                <input type="checkbox" class="theme-controller" value="dark" />
                <svg class="swap-off w-6 h-6 text-gray-700 dark:text-gray-300" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M12 3v2.25m6.364.386l-1.591 1.591M21 12h-2.25m-.386 6.364l-1.591-1.591M12 18.75V21m-4.773-4.227l-1.591 1.591M5.25 12H3m4.227-4.773L5.636 5.636M15.75 12a3.75 3.75 0 11-7.5 0 3.75 3.75 0 017.5 0z" />
                </svg>
                <svg class="swap-on w-6 h-6 text-gray-700 dark:text-gray-300" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M21.752 15.002A9.718 9.718 0 0118 15.75c-5.385 0-9.75-4.365-9.75-9.75 0-1.33.266-2.597.748-3.752A9.753 9.753 0 003 11.25C3 16.635 7.365 21 12.75 21a9.753 9.753 0 009.002-5.998z" />
                </svg>
            </label>
        </div>
    </nav>

</body>
</html>
