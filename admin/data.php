<?php
require_once __DIR__ . "/../config/baseURL.php";
include "../config/connect.php";
include "../includes/header.php";
include "../functions/delete_data.php";
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1" />
    <title>Admin Dashboard</title>
    <link rel="stylesheet" href="<?= BASE_URL ?>src/css/output.css" />
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.5/font/bootstrap-icons.css" rel="stylesheet" />
</head>

<body class="bg-gray-100 dark:bg-gray-900">
    <div class="container mx-auto px-4 py-8">
        <h1 class="text-3xl font-bold mb-8 text-gray-800 dark:text-white">Dashboard Admin</h1>

        <!-- EVENTS SECTION -->
        <section class="mb-12" id="events-section">
            <div class="card bg-white dark:bg-gray-800 rounded-lg shadow-md overflow-hidden mb-6">
                <div class="p-6 flex items-center justify-between">
                    <div class="flex items-center">
                        <div class="p-3 rounded-full bg-blue-100 dark:bg-blue-900 mr-4">
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-8 w-8 text-blue-600 dark:text-blue-300"
                                fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z" />
                            </svg>
                        </div>
                        <div>
                            <h2 class="text-xl font-semibold text-gray-800 dark:text-white">Events</h2>
                            <p class="text-gray-600 dark:text-gray-300">Manage all events</p>
                        </div>
                    </div>
                </div>
            </div>
            <div class="bg-white dark:bg-gray-800 rounded-lg shadow-md overflow-hidden">
                <div class="overflow-x-auto">
                    <table class="min-w-full divide-y divide-gray-200 dark:divide-gray-700">
                        <thead class="bg-gray-50 dark:bg-gray-700">
                            <tr>
                                <th
                                    class="px-6 py-3 text-left text-xs font-medium text-gray-500 dark:text-gray-300 uppercase tracking-wider">
                                    Event Name
                                </th>
                                <th
                                    class="px-6 py-3 text-left text-xs font-medium text-gray-500 dark:text-gray-300 uppercase tracking-wider">
                                    Description
                                </th>
                                <th
                                    class="px-6 py-3 text-left text-xs font-medium text-gray-500 dark:text-gray-300 uppercase tracking-wider">
                                    Actions
                                </th>
                            </tr>
                        </thead>
                        <tbody class="bg-white dark:bg-gray-800 divide-y divide-gray-200 dark:divide-gray-700">
                            <?php
                            $result = $mysqli->query("SELECT * FROM events");
                            while ($row = $result->fetch_assoc()) {
                                $jsonData = htmlspecialchars(json_encode($row), ENT_QUOTES, 'UTF-8');
                                echo "<tr>
                                    <td class='px-6 py-4 whitespace-nowrap text-sm font-medium text-gray-900 dark:text-white'>{$row['name']}</td>
                                    <td class='px-6 py-4 whitespace-nowrap text-sm text-gray-500 dark:text-gray-300'>{$row['description']}</td>
                                    <td class='px-6 py-4 whitespace-nowrap text-sm font-medium'>
                                        <button onclick=\"openDeleteModal('events', {$row['id']})\" class='text-red-600 dark:text-red-300 hover:text-red-900 dark:hover:text-red-400'>
                                            <i class='bi bi-trash'></i> Delete
                                        </button>
                                        <button onclick='openEditModal(\"events\", {$row['id']}, {$jsonData})' class='text-blue-600 dark:text-blue-300 hover:text-blue-900 dark:hover:text-blue-400 ml-2'>
                                            <i class='bi bi-pencil-square px-2'></i> Edit
                                        </button>
                                    </td>
                                </tr>";
                            }
                            ?>
                        </tbody>
                    </table>
                </div>
            </div>
        </section>

        <!-- SCHEDULES SECTION -->
        <section class="mb-12" id="schedules-section">
            <div class="card bg-white dark:bg-gray-800 rounded-lg shadow-md overflow-hidden mb-6">
                <div class="p-6 flex items-center justify-between">
                    <div class="flex items-center">
                        <div class="p-3 rounded-full bg-green-100 dark:bg-green-900 mr-4">
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-8 w-8 text-green-600 dark:text-green-300" fill="none"
                                viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z" />
                            </svg>
                        </div>
                        <div>
                            <h2 class="text-xl font-semibold text-gray-800 dark:text-white">Schedules</h2>
                            <p class="text-gray-600 dark:text-gray-300">Manage all schedules</p>
                        </div>
                    </div>
                </div>
            </div>
            <div class="bg-white dark:bg-gray-800 rounded-lg shadow-md overflow-hidden">
                <div class="overflow-x-auto">
                    <table class="min-w-full divide-y divide-gray-200 dark:divide-gray-700">
                        <thead class="bg-gray-50 dark:bg-gray-700">
                            <tr>
                                <th
                                    class="px-6 py-3 text-left text-xs font-medium text-gray-500 dark:text-gray-300 uppercase tracking-wider">
                                    Event Name
                                </th>
                                <th
                                    class="px-6 py-3 text-left text-xs font-medium text-gray-500 dark:text-gray-300 uppercase tracking-wider">
                                    Day Event
                                </th>
                                <th
                                    class="px-6 py-3 text-left text-xs font-medium text-gray-500 dark:text-gray-300 uppercase tracking-wider">
                                    Start Time
                                </th>
                                <th
                                    class="px-6 py-3 text-left text-xs font-medium text-gray-500 dark:text-gray-300 uppercase tracking-wider">
                                    End Time
                                </th>
                                <th
                                    class="px-6 py-3 text-left text-xs font-medium text-gray-500 dark:text-gray-300 uppercase tracking-wider">
                                    Location
                                </th>
                                <th
                                    class="px-6 py-3 text-left text-xs font-medium text-gray-500 dark:text-gray-300 uppercase tracking-wider">
                                    Actions
                                </th>
                            </tr>
                        </thead>
                        <tbody class="bg-white dark:bg-gray-800 divide-y divide-gray-200 dark:divide-gray-700">
                            <?php
                    $result = $mysqli->query("
                        SELECT s.*, e.name as event_name 
                        FROM schedules s
                        LEFT JOIN events e ON s.event_id = e.id
                    ");
                    while ($row = $result->fetch_assoc()) {
                        $jsonData = htmlspecialchars(json_encode($row), ENT_QUOTES, 'UTF-8');
                        echo "<tr>
                            <td class='px-6 py-4 whitespace-nowrap text-sm font-medium text-gray-900 dark:text-white'>{$row['event_name']}</td>
                            <td class='px-6 py-4 whitespace-nowrap text-sm text-gray-500 dark:text-gray-300'>{$row['day_of_week']}</td>
                            <td class='px-6 py-4 whitespace-nowrap text-sm text-gray-500 dark:text-gray-300'>{$row['start_time']}</td>
                            <td class='px-6 py-4 whitespace-nowrap text-sm text-gray-500 dark:text-gray-300'>{$row['end_time']}</td>
                            <td class='px-6 py-4 whitespace-nowrap text-sm text-gray-500 dark:text-gray-300'>{$row['location']}</td>
                            <td class='px-6 py-4 whitespace-nowrap text-sm font-medium'>
                                <button onclick=\"openDeleteModal('schedules', {$row['id']})\" class='text-red-600 dark:text-red-300 hover:text-red-900 dark:hover:text-red-400'>
                                    <i class='bi bi-trash'></i> Delete
                                </button>
                                <button onclick='openEditModal(\"schedules\", {$row['id']}, {$jsonData})' class='text-blue-600 dark:text-blue-300 hover:text-blue-900 dark:hover:text-blue-400 ml-2'>
                                    <i class='bi bi-pencil-square px-2'></i> Edit
                                </button>
                            </td>
                        </tr>";
                    }   
                    ?>
                        </tbody>
                    </table>
                </div>
            </div>
        </section>

        <!-- STUDENTS SECTION -->
        <section id="students-section">
            <div class="card bg-white dark:bg-gray-800 rounded-lg shadow-md overflow-hidden mb-6">
                <div class="p-6 flex items-center justify-between">
                    <div class="flex items-center">
                        <div class="p-3 rounded-full bg-purple-100 dark:bg-purple-900 mr-4">
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-8 w-8 text-purple-600 dark:text-purple-300"
                                fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M5.121 17.804A13.937 13.937 0 0112 15c2.986 0 5.74 1.038 7.879 2.804M15 11a3 3 0 11-6 0 3 3 0 016 0z" />
                            </svg>
                        </div>
                        <div>
                            <h2 class="text-xl font-semibold text-gray-800 dark:text-white">Students</h2>
                            <p class="text-gray-600 dark:text-gray-300">Manage all students</p>
                        </div>
                    </div>
                </div>
            </div>
            <div class="bg-white dark:bg-gray-800 rounded-lg shadow-md overflow-hidden">
                <div class="overflow-x-auto">
                    <table class="min-w-full divide-y divide-gray-200 dark:divide-gray-700">
                        <thead class="bg-gray-50 dark:bg-gray-700">
                            <tr>
                                <th
                                    class="px-6 py-3 text-left text-xs font-medium text-gray-500 dark:text-gray-300 uppercase tracking-wider">
                                    NIS
                                </th>
                                <th
                                    class="px-6 py-3 text-left text-xs font-medium text-gray-500 dark:text-gray-300 uppercase tracking-wider">
                                    Name
                                </th>
                                <th
                                    class="px-6 py-3 text-left text-xs font-medium text-gray-500 dark:text-gray-300 uppercase tracking-wider">
                                    Class
                                </th>
                                <th
                                    class="px-6 py-3 text-left text-xs font-medium text-gray-500 dark:text-gray-300 uppercase tracking-wider">
                                    Actions
                                </th>
                            </tr>
                        </thead>
                        <tbody class="bg-white dark:bg-gray-800 divide-y divide-gray-200 dark:divide-gray-700">
                            <?php
                            $result = $mysqli->query("SELECT * FROM students");
                            while ($row = $result->fetch_assoc()) {
                                $jsonData = htmlspecialchars(json_encode($row), ENT_QUOTES, 'UTF-8');
                                echo "<tr>
                                    <td class='px-6 py-4 whitespace-nowrap text-sm font-medium text-gray-900 dark:text-white'>{$row['nis']}</td>
                                    <td class='px-6 py-4 whitespace-nowrap text-sm text-gray-500 dark:text-gray-300'>{$row['name']}</td>
                                    <td class='px-6 py-4 whitespace-nowrap text-sm text-gray-500 dark:text-gray-300'>{$row['class']}</td>
                                    <td class='px-6 py-4 whitespace-nowrap text-sm font-medium'>
                                        <button onclick=\"openDeleteModal('students', {$row['id']})\" class='text-red-600 dark:text-red-300 hover:text-red-900 dark:hover:text-red-400'>
                                            <i class='bi bi-trash'></i> Delete
                                        </button>
                                        <button onclick='openEditModal(\"students\", {$row['id']}, {$jsonData})' class='text-blue-600 dark:text-blue-300 hover:text-blue-900 dark:hover:text-blue-400 ml-2'>
                                            <i class='bi bi-pencil-square px-2'></i> Edit
                                        </button>
                                    </td>
                                </tr>";
                            }
                            ?>
                        </tbody>
                    </table>
                </div>
            </div>
        </section>
    </div>

    <!-- DELETE MODAL -->
    <div id="deleteModal" class="fixed inset-0 bg-black bg-opacity-50 hidden justify-center items-center z-50">
        <div class="bg-white dark:bg-gray-800 rounded-lg p-6 max-w-md w-full shadow-lg">
            <h2 class="text-xl font-semibold mb-4 text-gray-900 dark:text-white">Confirm Delete</h2>
            <p id="deleteMessage" class="mb-4 text-gray-700 dark:text-gray-300"></p>
            <form id="deleteForm" method="post" action="<?= BASE_URL?>functions/delete_data.php" class="flex justify-end space-x-4">
                <input type="hidden" name="id" id="deleteId" />
                <input type="hidden" name="type" id="deleteType" />
                <button type="button" onclick="closeDeleteModal()"
                    class="px-4 py-2 bg-gray-300 rounded hover:bg-gray-400 dark:bg-gray-700 dark:hover:bg-gray-600">Cancel</button>
                <button type="submit" name="delete"
                    class="px-4 py-2 bg-red-600 text-white rounded hover:bg-red-700">Delete</button>
            </form>
        </div>
    </div>

    <!-- EDIT MODAL -->
    <div id="editModal"
        class="fixed inset-0 bg-black bg-opacity-50 hidden justify-center items-center z-50 overflow-auto">
        <div class="bg-white dark:bg-gray-800 rounded-lg p-6 max-w-3xl w-full shadow-lg">
            <h2 class="text-xl font-semibold mb-4 text-gray-900 dark:text-white">Edit Data</h2>
            <form id="editForm" method="post" action="<?= BASE_URL?>functions/edit_data.php" class="space-y-4">
                <input type="hidden" name="id" id="editId" />
                <input type="hidden" name="type" id="editType" />

                <!-- Fields will be generated dynamically here -->
                <div id="editFields"></div>

                <div class="flex justify-end space-x-4">
                    <button type="button" onclick="closeEditModal()"
                        class="px-4 py-2 bg-gray-300 rounded hover:bg-gray-400 dark:bg-gray-700 dark:hover:bg-gray-600">Cancel</button>
                    <button type="submit" name="edit"
                        class="px-4 py-2 bg-blue-600 text-white rounded hover:bg-blue-700">Save</button>
                </div>
            </form>
        </div>
    </div>

    <script>
    function openDeleteModal(type, id) {
        document.getElementById('deleteType').value = type;
        document.getElementById('deleteId').value = id;

        // Customize message per type
        let msg = '';
        switch (type) {
            case 'events':
                msg = `Are you sure you want to delete this Event (ID: ${id})?`;
                break;
            case 'schedules':
                msg = `Are you sure you want to delete this Schedule (ID: ${id})?`;
                break;
            case 'students':
                msg = `Are you sure you want to delete this Student (ID: ${id})?`;
                break;
            default:
                msg = 'Are you sure you want to delete this item?';
        }
        document.getElementById('deleteMessage').textContent = msg;

        document.getElementById('deleteModal').classList.remove('hidden');
        document.getElementById('deleteModal').classList.add('flex');
    }

    function closeDeleteModal() {
        document.getElementById('deleteModal').classList.add('hidden');
        document.getElementById('deleteModal').classList.remove('flex');
    }

    function openEditModal(type, id, data) {
        document.getElementById('editType').value = type;
        document.getElementById('editId').value = id;

        // Clear previous fields
        const container = document.getElementById('editFields');
        container.innerHTML = '';

        // Generate fields based on type and data
        let fieldsHtml = '';

        // Helper function to create input fields
        function inputField(label, name, value, readonly = false, typeInput = 'text') {
            return `
                <div>
                    <label class="block mb-1 font-medium text-gray-700 dark:text-gray-300" for="${name}">${label}</label>
                    <input type="${typeInput}" id="${name}" name="${name}" value="${value ?? ''}" class="w-full border border-gray-300 rounded px-3 py-2 dark:bg-gray-700 dark:text-white dark:border-gray-600" ${readonly ? 'readonly' : ''} required/>
                </div>`;
        }

        switch (type) {
            case 'events':
                fieldsHtml += inputField('Event Name', 'name', data.name);
                fieldsHtml += inputField('Description', 'description', data.description);
                break;

            case 'schedules':
                fieldsHtml += inputField('Event ID', 'event_id', data.event_id, false, 'number');
                fieldsHtml += inputField('Day of Week', 'day_of_week', data.day_of_week);
                fieldsHtml += inputField('Start Time', 'start_time', data.start_time, false, 'time');
                fieldsHtml += inputField('End Time', 'end_time', data.end_time, false, 'time');
                fieldsHtml += inputField('Location', 'location', data.location);
                break;

            case 'students':
                fieldsHtml += inputField('NIS', 'nis', data.nis);
                fieldsHtml += inputField('Name', 'name', data.name);
                fieldsHtml += inputField('Class', 'class', data.class);
                break;

            default:
                fieldsHtml = '<p>Unknown type for editing.</p>';
        }

        container.innerHTML = fieldsHtml;

        document.getElementById('editModal').classList.remove('hidden');
        document.getElementById('editModal').classList.add('flex');
    }

    function closeEditModal() {
        document.getElementById('editModal').classList.add('hidden');
        document.getElementById('editModal').classList.remove('flex');
    }
    </script>
</body>

</html>