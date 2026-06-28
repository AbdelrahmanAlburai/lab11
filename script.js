const display = document.getElementById("display");
const operation = document.getElementById("operation");

let currentValue = "";

function appendValue(value) {
    currentValue += value;
    display.textContent = currentValue;
    operation.textContent = "Typing...";
}

function clearDisplay() {
    currentValue = "";
    display.textContent = "0";
    operation.textContent = "Ready";
}

function deleteLast() {
    currentValue = currentValue.slice(0, -1);

    if (currentValue === "") {
        display.textContent = "0";
        operation.textContent = "Ready";
    } else {
        display.textContent = currentValue;
    }
}

function calculateResult() {
    try {
        const result = eval(currentValue);

        if (result === Infinity || isNaN(result)) {
            display.textContent = "Error";
            operation.textContent = "Invalid calculation";
            currentValue = "";
        } else {
            operation.textContent = currentValue + " =";
            display.textContent = result;
            currentValue = result.toString();
        }

    } catch (error) {
        display.textContent = "Error";
        operation.textContent = "Check your input";
        currentValue = "";
    }
}