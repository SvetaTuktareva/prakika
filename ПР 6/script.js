document.getElementById('repairForm').addEventListener('submit', function(event) {
        event.preventDefault(); // Предотвращаем стандартное поведение формы

        // Сбрасываем ошибки
        const errors = document.querySelectorAll('.error');
        errors.forEach(error => error.textContent = '');

        let isValid = true;

        // Получаем значения полей
const name = document.getElementById('name').value.trim();
        const email = document.getElementById('email').value.trim();
        const phone = document.getElementById('phone').value.trim();
        const device = document.getElementById('device').value.trim();
        const issue = document.getElementById('issue').value.trim();
        const urgency = document.getElementById('urgency').value;

        // Проверка на заполнение обязательных полей
        if (!name) {
            document.getElementById('nameError').textContent = 'Пожалуйста, введите ваше имя.';
            isValid = false;
        }
        
        if (!email) {
            document.getElementById('emailError').textContent = 'Пожалуйста, введите ваш email.';
            isValid = false;
        }

        if (!phone.match(/^d{10}$/)) {
            document.getElementById('phoneError').textContent = 'Введите корректный номер телефона (10 цифр).';
            isValid = false;
        }

        if (!device) {
            document.getElementById('deviceError').textContent = 'Пожалуйста, введите модель ноутбука.';
            isValid = false;
        }

        if (!issue) {
            document.getElementById('issueError').textContent = 'Пожалуйста, опишите проблему.';
            isValid = false;
        }

        if (!urgency) {
            document.getElementById('urgencyError').textContent = 'Пожалуйста, выберите срочность ремонта.';
            isValid = false;
        }

        if (!document.getElementById('consent').checked) {
            document.getElementById('consentError').textContent = 'Необходимо согласие на обработку данных.';
            isValid = false;
        }

        // Если форма валидна, выводим данные и очищаем поля
        if (isValid) {
            const resultDiv = document.getElementById('result');
            resultDiv.innerHTML = 
                <h3>Заявка успешно отправлена!</h3>
                <p><strong>Имя:</strong> ${name}</p>
                <p><strong>Email:</strong> ${email}</p>
                <p><strong>Телефон:</strong> ${phone}</p>
                <p><strong>Модель ноутбука:</strong> ${device}</p>
                <p><strong>Описание проблемы:</strong> ${issue}</p>
                <p><strong>Срочность ремонта:</strong> ${urgency}</p>
            ;

            // Очищаем поля формы
            document.getElementById('repairForm').reset();
        }
    });