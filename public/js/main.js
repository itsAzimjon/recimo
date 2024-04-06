var win = navigator.platform.indexOf('Win') > -1;
if (win && document.querySelector('#sidenav-scrollbar')) {
    var options = {
    damping: '0.5'
    }
    Scrollbar.init(document.querySelector('#sidenav-scrollbar'), options);
}

setTimeout(function() {
    var errorAlert = document.getElementById('alert');
    if (errorAlert) {
        errorAlert.classList.add('fade-out');
        setTimeout(function() {
            errorAlert.style.display = 'none';
        }, 500); 
    }
}, 7000);

// Function to calculate total price initially and whenever a row's price changes
document.addEventListener('DOMContentLoaded', function () {
    function calculateTotalPrice() {
        const calculatedPrices = document.querySelectorAll('.calculated-price');
        let totalPrice = 0;
        calculatedPrices.forEach(function(calculatedPrice) {
            totalPrice += parseFloat(calculatedPrice.textContent.replace(/,/g, ''));
        });

        const totalPriceSpan = document.getElementById('total-price');
        totalPriceSpan.textContent = totalPrice.toLocaleString();

        const totalPriceInput = document.getElementById('total-price-input');
        totalPriceInput.value = totalPrice.toFixed(2).replace(/[,.]/g, '');

        if (Number.isInteger(totalPrice)) {
            totalPriceInput.value = totalPriceInput.value.slice(0, -2);
        }
    }


    // Function to update price for a row based on type and sale input
    function updateRowPrice() {
        const row = this.closest('.product-row');
        const price = row.querySelector('.type-id').selectedOptions[0].getAttribute('data-price');
        const sale = row.querySelector('.sale').value;
        const totalPrice = price * sale;
        row.querySelector('.calculated-price').textContent = totalPrice.toLocaleString();

        calculateTotalPrice(); 
    }

    // Attach event listeners for type and sale inputs
    const typeInputs = document.querySelectorAll('.type-id');
    typeInputs.forEach(function(input) {
        input.addEventListener('change', updateRowPrice);
    });

    const saleInputs = document.querySelectorAll('.sale');
    saleInputs.forEach(function(input) {
        input.addEventListener('input', updateRowPrice);
    });

    calculateTotalPrice();

    // Function to add a new row
    document.getElementById('add-row').addEventListener('click', function () {
        const productRow = document.querySelector('.product-row');
        const newRow = productRow.cloneNode(true);

        // Clear input values of the new row
        newRow.querySelector('.type-search').value = '';
        newRow.querySelector('.sale').value = '';

        // Update name attributes to ensure uniqueness
        const rowCount = document.querySelectorAll('.product-row').length;
        newRow.querySelector('select[name="type_id[]"]').setAttribute('name', 'type_id[' + rowCount + ']');
        newRow.querySelector('input[name="sale[]"]').setAttribute('name', 'sale[' + rowCount + ']');

        // Create remove button for the new row
        const removeButton = document.createElement('button');
        removeButton.classList.add('btn', 'btn-sm','mt-1','px-4', 'py-0','m-0', 'btn-secondary', 'remove-row');
        removeButton.textContent = 'X';
        removeButton.addEventListener('click', function() {
            newRow.remove();
            calculateTotalPrice(); 
        });

        const col = document.createElement('div');
        col.classList.add('col-md-1');
        col.appendChild(removeButton);
        newRow.appendChild(col);

        document.getElementById('product-rows').appendChild(newRow);

        newRow.querySelector('.type-id').addEventListener('change', updateRowPrice);
        newRow.querySelector('.sale').addEventListener('input', updateRowPrice);

        calculateTotalPrice();
    });
});



 //Confirmation button to send base token
 document.querySelectorAll('.edit-btn').forEach(button => {
    button.addEventListener('click', function() {
        const status = this.getAttribute('data-status');
        document.getElementById('statusInput').value = status;
        document.getElementById('editForm').submit();
    });
});

// Function to start the timer
function startTimer() {
var timerDisplay = document.getElementById('timer');
var secondsLeft = localStorage.getItem('secondsLeft');

if (secondsLeft > 0) {
    timerDisplay.textContent = secondsLeft;
    timerDisplay.style.display = 'block';

    document.getElementById('sendOtpBtn').disabled = true;

    var countdown = setInterval(function() {
        secondsLeft--;
        localStorage.setItem('secondsLeft', secondsLeft);
        timerDisplay.textContent = secondsLeft;
        
        if (secondsLeft <= 0) {
            clearInterval(countdown);
            timerDisplay.style.display = 'none';
            document.getElementById('sendOtpBtn').disabled = false;
            localStorage.removeItem('secondsLeft');
        }
    }, 1000);
}
}

// Check if timer is active
startTimer();

document.getElementById('sendOtpBtn').addEventListener('click', function() {
var phoneNumber = document.getElementById('phone_number').value;
document.getElementById('otpPhoneNumber').value = phoneNumber;

var timerDuration = 60;

var endTime = Date.now() + timerDuration * 1000;
localStorage.setItem('timerEndTime', endTime);

startTimer();

this.disabled = true;

document.getElementById('sendOtpForm').submit();
});

//  to check if timer should be active on page reload
window.addEventListener('load', function() {
var endTime = localStorage.getItem('timerEndTime');
if (endTime) {
    var secondsLeft = Math.ceil((endTime - Date.now()) / 1000);
    if (secondsLeft > 0) {
        localStorage.setItem('secondsLeft', secondsLeft);
        startTimer(); // Display the timer
        document.getElementById('sendOtpBtn').disabled = true;
    } else {
        localStorage.removeItem('timerEndTime');
    }
}
});

//phone number remember after reload
document.addEventListener('DOMContentLoaded', function() {
var phoneNumberInput = document.getElementById('phone_number');
var lastPhoneNumber = localStorage.getItem('last_phone_number');

if (lastPhoneNumber) {
    phoneNumberInput.value = lastPhoneNumber;
}

document.getElementById('sendOtpBtn').addEventListener('click', function() {
    var phoneNumber = phoneNumberInput.value;
    document.getElementById('otpPhoneNumber').value = phoneNumber;
    localStorage.setItem('last_phone_number', phoneNumber);
});
});

// Update phone number in the OTP form when user enters it in the main form
document.getElementById('phone_number').addEventListener('input', function() {
document.getElementById('otpPhoneNumber').value = this.value;
});

// Trigger OTP form submission when "Send OTP" button is clicked
document.getElementById('sendOtpBtn').addEventListener('click', function() {
document.getElementById('sendOtpForm').submit();
});

//order name attachment
document.getElementById('attachmentSelect').addEventListener('change', function() {
    document.getElementById('attachOrderForm').submit();
});