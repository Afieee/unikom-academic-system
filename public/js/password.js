function togglePasswordVisibility() {
    const passwordInput = document.getElementById('password');
    const checkbox = document.getElementById('showPasswordCheckbox');
    // Change the type based on checkbox status
    if (checkbox.checked) {
        passwordInput.type = 'text';
    } else {
        passwordInput.type = 'password';
    }

}
