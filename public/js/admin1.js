document.getElementById("currentYear").textContent = new Date().getFullYear();
document.addEventListener("DOMContentLoaded", function () {
    var userDropdown = document.getElementById("userDropdown");
    var dropdownMenu = document.querySelector(
        '.dropdown-menu[aria-labelledby="userDropdown"]'
    );

    userDropdown.addEventListener("click", function (e) {
        dropdownMenu.classList.toggle("show");
    });

    document.addEventListener("click", function (event) {
        var isClickInsideDropdown =
            userDropdown.contains(event.target) ||
            dropdownMenu.contains(event.target);
        if (!isClickInsideDropdown) {
            dropdownMenu.classList.remove("show");
        }
    });
});

document.getElementById("sidebarToggle").addEventListener("click", function () {
    document.getElementById("accordionSidebar").classList.toggle("toggled");
});

document.addEventListener("DOMContentLoaded", function () {
    var sidebarToggleBtn = document.getElementById("sidebarToggleTop");
    var sidebar = document.getElementById("accordionSidebar");

    sidebarToggleBtn.addEventListener("click", function () {
        sidebar.classList.toggle("collapsed");
    });
});

document.addEventListener("DOMContentLoaded", function () {
    const rowsPerPage = 5;
    const rows = Array.from(document.querySelectorAll("#dataTable tbody tr"));
    const pagination = document.getElementById("pagination");
    let currentPage = 1;

    function displayRows(startIndex, endIndex) {
        rows.forEach((row, index) => {
            row.style.display =
                index >= startIndex && index < endIndex ? "" : "none";
            if (index >= startIndex && index < endIndex) {
                row.querySelector("td").textContent = index + 1;
            }
        });
    }

    function setupPagination(totalRows, rowsPerPage) {
        pagination.innerHTML = "";
        const totalPages = Math.ceil(totalRows / rowsPerPage);
        for (let i = 1; i <= totalPages; i++) {
            const li = document.createElement("li");
            li.classList.add("page-item");
            li.innerHTML = `<a class="page-link" href="#">${i}</a>`;
            if (i === currentPage) li.classList.add("active");
            li.addEventListener("click", function (e) {
                e.preventDefault();
                currentPage = i;
                updateTable();
            });
            pagination.appendChild(li);
        }
    }

    function updateTable() {
        const startIndex = (currentPage - 1) * rowsPerPage;
        const endIndex = startIndex + rowsPerPage;
        displayRows(startIndex, endIndex);
        setupPagination(rows.length, rowsPerPage);
    }

    updateTable();
});

var closeSuccessAlert = document.getElementById("closeSuccessAlert");
var successAlert = document.getElementById("successAlert");
closeSuccessAlert.addEventListener("click", function () {
    successAlert.style.display = "none";
});

function selectOption(selectElement) {
    var kasusId = selectElement.getAttribute("data-id");
    var fieldType = selectElement.getAttribute("data-field");
    var fieldValue = selectElement.value;

    var url =
        fieldType === "status_kasus"
            ? "/update-status-kasus/"
            : "/update-jenis-kasus/";

    var fieldNames = {
        status_kasus: "Status Kasus",
        jenis_kasus: "Jenis Kasus",
    };

    fetch(url + kasusId, {
        method: "PUT",
        headers: {
            "Content-Type": "application/json",
            "X-CSRF-TOKEN": document
                .querySelector('meta[name="csrf-token"]')
                .getAttribute("content"),
        },
        body: JSON.stringify({
            [fieldType]: fieldValue,
        }),
    })
        .then((response) => response.json())
        .then((data) => {
            if (data.success) {
                alert(fieldNames[fieldType] + " berhasil diperbarui");
            } else {
                alert("Gagal memperbarui " + fieldNames[fieldType]);
            }
        })
        .catch((error) => console.error("Error:", error));
}

function showPassword(inputId) {
    var passwordInput = document.getElementById(inputId);
    if (passwordInput.type === "password") {
        passwordInput.type = "text";
    } else {
        passwordInput.type = "password";
    }
}

