document.addEventListener('DOMContentLoaded', () => {
    const updateProfileInfoForm = document.getElementById('updateProfileInfoForm');
    const updateProfilePasswordForm = document.getElementById('updateProfilePasswordForm');
    const csrfToken = document.querySelector('meta[name="csrf-token"]').getAttribute('content');

    // Обновление информации о пользователе
    updateProfileInfoForm.addEventListener('submit', async(e) => {
        e.preventDefault();

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

    // Обновление пароля пользователя
    updateProfilePasswordForm.addEventListener('submit', async(e) => {
       e.preventDefault();

        const resultSubmit = updateProfilePasswordForm.querySelector('.result-submit');
        const button = updateProfilePasswordForm.querySelector('.save-button');
        const formData = new FormData(updateProfilePasswordForm);
        const data = Object.fromEntries(formData.entries());

        loading(button);

        if (isValidUpdateProfilePasswordForm(data)) {
            const response = await fetch(updateProfilePasswordForm.action, {
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

    function isValidUpdateProfilePasswordForm(data) {
        clearErrorForm(updateProfilePasswordForm);

        const passwordRegex = /^(?=.*[a-z])(?=.*[A-Z])(?=.*\d).{8,}$/;
        let isValid = true;

        if (!data.currentPassword || data.currentPassword.trim() === '') {
            setFieldError("currentPassword", "Current password is required.");
            isValid = false;
        }

        if (!data.newPassword || data.newPassword.trim().length === 0) {
            setFieldError("newPassword", "New password is required.");
            isValid = false;
        }

        if (!data.passwordConfirmation || data.passwordConfirmation.trim().length === 0) {
            setFieldError("passwordConfirmation", "Confirm password is required.");
            isValid = false;
        }

        if (data.newPassword.trim().length > 0 && !passwordRegex.test(data.newPassword)) {
            setFieldError("newPassword", "Password must be at least 8 characters long and include a number, an uppercase and a lowercase letter.");
            isValid = false;
        }

        if (data.newPassword.trim().length > 0 &&
            data.passwordConfirmation.trim().length > 0 &&
            data.newPassword !== data.passwordConfirmation) {
            setFieldError("newPassword", "Password confirmation does not match.");
            isValid = false;
        }

        return isValid;
    }

    // Валидируем форму обновления информации пользователя на выходе получаем валидная форма или нет
    function isValidUpdateProfileInfoForm(data) {
        clearErrorForm(updateProfileInfoForm);

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

    // Очистка ошибок в форме
    function clearErrorForm(form) {
        form.querySelector('.result-submit').textContent = '';
        form.querySelectorAll('.error').forEach(el => el.classList.remove('error'));
        form.querySelectorAll('.invalid-feedback').forEach(el => el.textContent = '');
    }

    // Выводим ошибку в поле
    function setFieldError(fieldName, errorMessage) {
        const input = document.querySelector(`[name="${fieldName}"]`);
        const next = input.nextElementSibling;

        input.classList.add('error');
        next.textContent = errorMessage;
    }

    // Запускаем loading кнопки если его небыло и на оборот
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
