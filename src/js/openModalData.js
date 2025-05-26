function openDeleteModal(table, id) {
    document.getElementById("deleteTable").value = table;
    document.getElementById("deleteId").value = id;
    document.getElementById("deleteModal").classList.remove("hidden");
}

function openEditModal(table, id, data) {
    document.getElementById("editTable").value = table;
    document.getElementById("editId").value = id;
    document.getElementById("editName").value = data.name;
    document.getElementById("editDescription").value = data.description;
    document.getElementById("editModal").classList.remove("hidden");
}

function closeModal(modalId) {
    document.getElementById(modalId).classList.add("hidden");
}