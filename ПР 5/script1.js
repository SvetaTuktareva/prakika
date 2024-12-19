
function isDecreasingGeometricSequence(num) {
    const digits = Math.abs(Math.trunc(num)).toString().split('').map(Number);
    if (digits.length < 2) return false;
    
    const ratio = digits[0] / digits[1];
    for (let i = 1; i < digits.length - 1; i++) {
        if (digits[i] / digits[i + 1] !== ratio || ratio <= 1) {
            return false;
        }
    }
    return true;
}


function processArray(arr) {
    
    let lastNegativeSinIndex = -1;
    for (let i = arr.length - 1; i >= 0; i--) {
        if (Math.sin(arr[i]) < 0) {
            lastNegativeSinIndex = i;
            break;
        }
    }


    let product = 1;
    if (lastNegativeSinIndex !== -1) {
        for (let i = lastNegativeSinIndex; i < arr.length; i++) {
            product *= arr[i];
        }
    }

    
    const filteredArray = arr.filter(num => !isDecreasingGeometricSequence(num));

    return {
        originalArray: arr,
        product: product,
        filteredArray: filteredArray,
        lastNegativeSinIndex: lastNegativeSinIndex
    };
}


function calculateAndDisplay() {
    const input = document.getElementById('arrayInput').value;
    const numbers = input.split(',').map(num => parseFloat(num.trim()));
    
    if (numbers.some(isNaN)) {
        alert('Пожалуйста, введите корректные числа, разделенные запятыми');
        return;
    }

    const result = processArray(numbers);
    
    document.getElementById('originalArray').textContent = 
        `Исходный массив: [${result.originalArray.join(', ')}]`;
    
    document.getElementById('product').textContent = 
        `Произведение элементов после последнего отрицательного синуса: ${result.product}`;
    
    document.getElementById('filteredArray').textContent = 
        `Массив после удаления элементов: [${result.filteredArray.join(', ')}]`;
}