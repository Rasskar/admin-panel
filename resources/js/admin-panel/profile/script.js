document.addEventListener('DOMContentLoaded', () => {
    const updateProfileInfoForm = document.getElementById('updateProfileInfoForm');

    updateProfileInfoForm.addEventListener('submit', async(e) => {
        e.preventDefault();

        const button = updateProfileInfoForm.querySelector('.save-button');
        const formData = new FormData(updateProfileInfoForm);
        const data = Object.fromEntries(formData.entries());

        loading(button);

        if (isValidUpdateProfileInfoForm(data)) {

        } else {
            loading(button);
        }

        console.log(data);
    });

    function isValidUpdateProfileInfoForm(data) {
        updateProfileInfoForm.querySelectorAll('.error').forEach(el => el.classList.remove('error'));
        updateProfileInfoForm.querySelectorAll('.invalid-feedback').forEach(el => el.textContent = '');

        const regexEmail = /^[^\s@]+@[^\s@]+\.[^\s@]+$/;
        let isValid = true;

        if (!data.name || data.name.trim().length < 3) {
            setFieldError("name", "Name must be at least 3 characters long.");
            isValid = false;
        }

        if (!data.email || !regexEmail.test(data.email)) {
            setFieldError("email", "Invalid email address.");
            isValid = false;
        }

        if (!data.role) {
            setFieldError("role", "Please select a user role.");
            isValid = false;
        }

        return isValid;
    }

    function setFieldError(fieldName, errorMessage) {
        const input = document.querySelector(`[name="${fieldName}"]`);
        const next = input.nextElementSibling;

        input.classList.add('error');
        next.textContent = errorMessage;
    }

    function loading(button) {
        if (!button.classList.contains('loader')) {
            button.classList.add('loader');
            button.disabled = true;
        } else {
            button.classList.remove('loader');
            button.disabled = false;
        }
    }
});
