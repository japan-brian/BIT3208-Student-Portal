// Client-side form validation — Week 3
function validateForm() {
    const username = document.getElementById('username').value.trim();
    const password = document.getElementById('password').value;
    const confirm  = document.getElementById('confirm_password')?.value;

    if (username === '') {
        alert('Username is required');
        return false;
    }

    if (password.length < 6) {
        alert('Password must be at least 6 characters');
        return false;
    }

    if (confirm !== undefined && password !== confirm) {
        alert('Passwords do not match');
        return false;
    }

    return true;
}