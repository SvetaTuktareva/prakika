 let display = document.getElementById('display');
        let currentNumber = '';
        let previousNumber = '';
        let operation = null;
        let shouldResetDisplay = false;

        function addNumber(num) {
            if (shouldResetDisplay) {
                display.value = '';
                shouldResetDisplay = false;
            }
            display.value += num;
            currentNumber = display.value;
        }

        function addDecimal() {
            if (!display.value.includes('.')) {
                display.value += '.';
                currentNumber = display.value;
            }
        }

        function addOperator(op) {
            if (currentNumber !== '') {
                if (previousNumber !== '') {
                    calculate();
                }
                previousNumber = currentNumber;
                operation = op;
                shouldResetDisplay = true;
            }
        }

        function calculate() {
            if (previousNumber !== '' && currentNumber !== '') {
                let result;
                const prev = parseFloat(previousNumber);
                const current = parseFloat(currentNumber);

                switch(operation) {
                    case '+': result = prev + current; break;
                    case '-': result = prev - current; break;
                    case '*': result = prev * current; break;
                    case '/': result = current !== 0 ? prev / current : 'Error'; break;
                }

                display.value = result;
                currentNumber = result.toString();
                previousNumber = '';
                operation = null;
                shouldResetDisplay = true;
            }
        }

        function clearAll() {
            display.value = '';
            currentNumber = '';
            previousNumber = '';
            operation = null;
        }

        function clearEntry() {
            display.value = '';
            currentNumber = '';
        }

        function backspace() {
            display.value = display.value.slice(0, -1);
            currentNumber = display.value;
        }

        function toggleSign() {
            if (display.value !== '') {
                display.value = (-parseFloat(display.value)).toString();
                currentNumber = display.value;
            }
        }

        function reciprocal() {
            if (display.value !== '0' && display.value !== '') {
                display.value = (1 / parseFloat(display.value)).toString();
                currentNumber = display.value;
            }
        }

        function squareRoot() {
            if (display.value !== '') {
                display.value = Math.sqrt(parseFloat(display.value)).toString();
                currentNumber = display.value;
            }
        }

        function percentage() {
            if (display.value !== '') {
                display.value = (parseFloat(display.value) / 100).toString();
                currentNumber = display.value;
            }
        }