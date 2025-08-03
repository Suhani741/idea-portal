document.addEventListener("DOMContentLoaded", () => {
    const domainDropdown = document.getElementById("domain");
    const facultyDropdown = document.getElementById("faculty");

    domainDropdown.addEventListener("change", (event) => {
        const selectedDomain = event.target.value;

        // Clear existing faculty options
        facultyDropdown.innerHTML = `<option value="">Select Faculty</option>`;

        // Fetch and display faculty based on the selected domain
        fetch('fetch_faculty.php?domain=' + selectedDomain)
            .then(response => response.json())
            .then(data => {
                data.forEach(facultyMember => {
                    const option = document.createElement("option");
                    option.value = facultyMember.faculty_id;
                    option.textContent = facultyMember.faculty_name;
                    facultyDropdown.appendChild(option);
                });
            })
            .catch(error => console.error('Error fetching faculty:', error));
    });
});
