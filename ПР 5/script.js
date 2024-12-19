function isPangram(text) {
    
    const cleanText = text.toLowerCase()
        .replace(/[^а-яё]/g, '');
    
    
    const uniqueLetters = new Set(cleanText);
    
    
    return uniqueLetters.size === 33;
}

function checkText() {
    const input = document.getElementById('textInput').value;
    const resultElement = document.getElementById('result');
    
    if (isPangram(input)) {
        resultElement.textContent = 'Это панграмма!';
        resultElement.className = 'success';
    } else {
        resultElement.textContent = 'Это не панграмма. В тексте не хватает некоторых букв русского алфавита.';
        resultElement.className = 'error';
    }
    
    
    const usedLetters = new Set(input.toLowerCase().replace(/[^а-яё]/g, ''));
    const alphabet = 'абвгдеёжзийклмнопрстуфхцчшщъыьэюя'.split('');
    
    const missingLetters = alphabet.filter(letter => !usedLetters.has(letter));
    
    const missingElement = document.getElementById('missingLetters');
    if (missingLetters.length > 0) {
        missingElement.textContent = 'Отсутствующие буквы: ' + missingLetters.join(', ');
    } else {
        missingElement.textContent = 'Все буквы алфавита присутствуют!';
    }
}