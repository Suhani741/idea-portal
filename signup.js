function showForm() {
    const role = document.getElementById('role').value;
    const studentForm = document.getElementById('studentForm');
    const facultyForm = document.getElementById('facultyForm');

    studentForm.classList.add('hidden');
    facultyForm.classList.add('hidden');

    if (role === 'student') {
        studentForm.classList.remove('hidden');
    } else if (role === 'faculty') {
        facultyForm.classList.remove('hidden');
    }
}
