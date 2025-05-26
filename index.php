<?php 
require __DIR__ . '/config/connect.php';
require_once __DIR__ . "/config/baseURL.php";
?>

<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0"/>
  <title>Penjadwalan Kegiatan Sekolah</title>
  <link rel="stylesheet" href="<?= BASE_URL?>src/css/output.css" />
</head>
<body class="bg-base-100 text-base-content dark:bg-base-100 dark:text-base-content">

  <!-- Navbar -->
  <?php include "./includes/header.php" ?>

  <!-- Hero Section -->
  <div class="relative h-screen w-full">
    <div class="flex flex-col justify-center items-center h-full px-4 text-center">
      <div class="bg-base-200 bg-opacity-70 dark:bg-base-200 dark:bg-opacity-80 p-10 rounded-2xl shadow-xl">
        <h1 class="text-4xl md:text-5xl font-bold text-primary mb-4">Welcome to</h1>
        <h2 class="text-3xl md:text-4xl font-bold text-base-content mb-6">Penjadwalan Kegiatan Sekolah</h2>
        <p class="text-lg text-base-content opacity-80 mb-6 max-w-xl">
          Dengan website ini, para siswa dapat mengetahui jadwal kegiatan ekstrakurikuler 
          dan juga komunitas yang ada pada SMK Bina Mandiri Multimedia.
        </p>
        <a href="<?= BASE_URL ?>auth/login.php" class="btn btn-primary btn-lg">
          Get Started →
        </a>
      </div>
    </div>
  </div>

  <!-- Events Section -->
  <section class="max-w-6xl mx-auto px-4 py-16">
    <h2 class="text-2xl font-bold mb-6">📅 Events</h2>
    <div class="overflow-x-auto">
      <table class="table table-zebra w-full text-sm">
        <thead class="text-base-content">
          <tr>
            <th>Nama Event</th>
            <th>Deskripsi</th>
          </tr>
        </thead>
        <tbody>
          <?php
          $result = mysqli_query($mysqli, "SELECT name, description FROM events");
          while ($event = mysqli_fetch_assoc($result)):
          ?>
          <tr>
            <td><?= htmlspecialchars($event['name']) ?></td>
            <td><?= htmlspecialchars($event['description']) ?></td>
          </tr>
          <?php endwhile; ?>
        </tbody>
      </table>
    </div>
  </section>

  <!-- Schedule Section -->
  <section class="max-w-6xl mx-auto px-4 py-16">
    <h2 class="text-2xl font-bold mb-6">🗓️ Schedules</h2>
    <div class="overflow-x-auto">
      <table class="table table-zebra w-full text-sm">
        <thead class="text-base-content">
          <tr>
            <th>Nama Event</th>
            <th>Hari</th>
            <th>Waktu Mulai</th>
            <th>Waktu Selesai</th>
            <th>Lokasi</th>
          </tr>
        </thead>
        <tbody>
          <?php
          $query = "
              SELECT e.name AS event_name, s.day_of_week, s.start_time, s.end_time, s.location
              FROM schedules s
              JOIN events e ON s.event_id = e.id
          ";
          $result = mysqli_query($mysqli, $query);
          while ($row = mysqli_fetch_assoc($result)):
          ?>
          <tr>
            <td><?= htmlspecialchars($row['event_name']) ?></td>
            <td><?= htmlspecialchars($row['day_of_week']) ?></td>
            <td><?= htmlspecialchars($row['start_time']) ?></td>
            <td><?= htmlspecialchars($row['end_time']) ?></td>
            <td><?= htmlspecialchars($row['location']) ?></td>
          </tr>
          <?php endwhile; ?>
        </tbody>
      </table>
    </div>
  </section>

  <!-- Students Section -->
  <section class="max-w-6xl mx-auto px-4 py-16">
    <h2 class="text-2xl font-bold mb-6">🎓 Students</h2>
    <div class="overflow-x-auto">
      <table class="table table-zebra w-full text-sm">
        <thead class="text-base-content">
          <tr>
            <th>Nama Siswa</th>
            <th>Kelas</th>
          </tr>
        </thead>
        <tbody>
          <?php
          $result = mysqli_query($mysqli, "SELECT name, class FROM students");
          while ($student = mysqli_fetch_assoc($result)):
          ?>
          <tr>
            <td><?= htmlspecialchars($student['name']) ?></td>
            <td><?= htmlspecialchars($student['class']) ?></td>
          </tr>
          <?php endwhile; ?>
        </tbody>
      </table>
    </div>
  </section>

</body>
</html>