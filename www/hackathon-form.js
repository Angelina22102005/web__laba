document.getElementById('hackathonForm').addEventListener('submit', function(e) {
    e.preventDefault();
    
    // Собираем данные формы
    const formData = new FormData(this);
    const data = {};
    
    for (const [name, value] of formData.entries()) {
        if (name === 'previousExperience' || name === 'workshop' || name === 'mentoring' || name === 'newsletter') {
            data[name] = value === 'yes' ? 'Да' : 'Нет';
        } else {
            data[name] = value;
        }
    }

    // Валидация
    if (!data.fullName || !data.age || !data.direction || !data.teamRole || !data.email) {
        showResult('Пожалуйста, заполните все обязательные поля!', 'error');
        return;
    }

    // Валидация email
    const emailRegex = /^[^\\s@]+@[^\\s@]+\\.[^\\s@]+$/;
    if (!emailRegex.test(data.email)) {
        showResult('Пожалуйста, введите корректный email адрес!', 'error');
        return;
    }

    // Форматируем вывод
    let output = '<h3>🎉 Регистрация успешно завершена!</h3>';
    output += '<div style=\"margin: 15px 0; padding: 15px; background: #d4edda; border-radius: 8px;\">';
    output += '<p><strong>ID заявки:</strong> HACK-' + generateHackathonId() + '</p>';
    output += '<p><strong>Дата регистрации:</strong> ' + new Date().toLocaleDateString('ru-RU') + '</p>';
    output += '</div>';
    
    output += '<h4>Ваши данные:</h4>';
    output += '<p><strong>Имя:</strong> ' + data.fullName + '</p>';
    output += '<p><strong>Возраст:</strong> ' + data.age + ' лет</p>';
    output += '<p><strong>Email:</strong> ' + data.email + '</p>';
    output += '<p><strong>Направление:</strong> ' + getDirectionName(data.direction) + '</p>';
    output += '<p><strong>Роль в команде:</strong> ' + getRoleName(data.teamRole) + '</p>';
    output += '<p><strong>Опыт участия:</strong> ' + (data.previousExperience || 'Нет') + '</p>';
    
    // Дополнительные опции
    const additionalOptions = [];
    if (data.workshop === 'Да') additionalOptions.push('Воркшопы');
    if (data.mentoring === 'Да') additionalOptions.push('Менторство');
    if (data.newsletter === 'Да') additionalOptions.push('Рассылка мероприятий');
    
    if (additionalOptions.length > 0) {
        output += '<p><strong>Дополнительные опции:</strong> ' + additionalOptions.join(', ') + '</p>';
    }

    output += '<hr style=\"margin: 20px 0; border: none; border-top: 2px dashed #ccc;\">';
    output += '<div style=\"text-align: center; padding: 15px; background: #e3f2fd; border-radius: 8px;\">';
    output += '<p><strong>Следующие шаги:</strong></p>';
    output += '<p>1. Подтверждение регистрации придет на email в течение 24 часов</p>';
    output += '<p>2. Подготовьте презентацию вашей идеи (2-3 слайда)</p>';
    output += '<p>3. Будьте готовы к командной работе!</p>';
    output += '</div>';

    showResult(output, 'success');
    
    // Очищаем форму через 8 секунд
    setTimeout(() => {
        this.reset();
        document.getElementById('result').style.display = 'none';
    }, 8000);
});

// Функции для преобразования значений
function getDirectionName(direction) {
    const directions = {
        'web-development': 'Веб-разработка',
        'mobile-development': 'Мобильная разработка',
        'ai-ml': 'Искусственный интеллект и ML',
        'blockchain': 'Блокчейн технологии',
        'iot': 'Интернет вещей (IoT)',
        'cybersecurity': 'Кибербезопасность',
        'data-science': 'Data Science',
        'game-dev': 'Разработка игр'
    };
    return directions[direction] || direction;
}

function getRoleName(role) {
    const roles = {
        'backend': 'Backend-разработчик',
        'frontend': 'Frontend-разработчик',
        'fullstack': 'Fullstack-разработчик',
        'designer': 'UI/UX дизайнер',
        'data': 'Data Scientist'
    };
    return roles[role] || role;
}

function generateHackathonId() {
    return Math.random().toString(36).substr(2, 6).toUpperCase() + 
           Date.now().toString(36).substr(-4).toUpperCase();
}

function showResult(message, type) {
    const resultDiv = document.getElementById('result');
    resultDiv.innerHTML = message;
    resultDiv.style.display = 'block';
    
    if (type === 'error') {
        resultDiv.className = 'result error';
    } else {
        resultDiv.className = 'result';
    }
    
    // Прокрутка к результату
    resultDiv.scrollIntoView({ behavior: 'smooth', block: 'nearest' });
}

// Добавляем интерактивность
document.addEventListener('DOMContentLoaded', function() {
    const inputs = document.querySelectorAll('input, select');
    inputs.forEach(input => {
        input.addEventListener('focus', function() {
            this.style.transform = 'scale(1.02)';
            this.style.boxShadow = '0 0 0 3px rgba(102, 126, 234, 0.2)';
        });
        
        input.addEventListener('blur', function() {
            this.style.transform = 'scale(1)';
            this.style.boxShadow = 'none';
        });
        
        // Валидация в реальном времени
        input.addEventListener('input', function() {
            if (this.checkValidity()) {
                this.style.borderColor = '#2ecc71';
            } else {
                this.style.borderColor = '#e74c3c';
            }
        });
    });
});

// Анимация появления формы
document.addEventListener('DOMContentLoaded', function() {
    const form = document.getElementById('hackathonForm');
    form.style.opacity = '0';
    form.style.transform = 'translateY(20px)';
    
    setTimeout(() => {
        form.style.transition = 'all 0.6s ease';
        form.style.opacity = '1';
        form.style.transform = 'translateY(0)';
    }, 300);
});