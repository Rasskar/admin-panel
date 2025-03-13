document.addEventListener('DOMContentLoaded', () => {
    const updateProfileInfoForm = document.getElementById('updateProfileInfoForm');

    updateProfileInfoForm.addEventListener('submit', async(e) => {
        e.preventDefault();

        const csrfToken = document.querySelector('meta[name="csrf-token"]').getAttribute('content');
        const resultSubmit = updateProfileInfoForm.querySelector('.result-submit');
        const button = updateProfileInfoForm.querySelector('.save-button');
        const formData = new FormData(updateProfileInfoForm);
        const data = Object.fromEntries(formData.entries());

        loading(button);

        if (isValidUpdateProfileInfoForm(data)) {
            const response = await fetch(updateProfileInfoForm.action, {
                method: 'POST',
                headers: {
                    'Accept': 'application/json',
                    'Content-Type': 'application/json',
                    'X-CSRF-TOKEN': csrfToken,
                },
                body: JSON.stringify(data),
            });

            const result = await response.json();

            if (!response.ok && response.status === 422) {
                Object.entries(result.errors).forEach(([key, value]) => {
                    value.forEach((value) => {
                        setFieldError(key, value);
                    });
                });
            } else {
                resultSubmit.classList.remove('success', 'error');
                resultSubmit.textContent = result.message;

                if (!response.ok) {
                    resultSubmit.classList.add('error');
                } else {
                    resultSubmit.classList.add('success');

                    setTimeout(() => {
                        resultSubmit.textContent = '';
                        resultSubmit.classList.remove('success');
                    }, 10000);
                }
            }
        }

        loading(button);
    });

    function isValidUpdateProfileInfoForm(data) {
        updateProfileInfoForm.querySelector('.result-submit').textContent = '';
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

        if (!data.roleId) {
            setFieldError("roleId", "Please select a user role.");
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
