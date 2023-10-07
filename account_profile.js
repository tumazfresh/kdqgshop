  <script>
$(document).ready(function() {
  const updateProfileForm = document.getElementById('updateProfileForm');
  const nameInput = document.getElementById('name');
  const emailInput = document.getElementById('email');
  const nameError = document.getElementById('nameError');
  const phoneInput = document.getElementById('phone');
  const addressInput = document.getElementById('address');
  const errorMessageUpdate = document.getElementById('errorMessageUpdate');

  updateProfileForm.addEventListener('submit', function(event) {
    event.preventDefault();

    errorMessageUpdate.innerText = '';
    nameError.innerText = '';

    // Function to validate the name
    function validateName() {
      const namePattern = /^[A-Za-z\s]+$/;
      if (!namePattern.test(nameInput.value.trim())) {
        displayError('Please enter a valid name using only alphabets and spaces.', 'nameError');
        return false;
      }
      return true; // Name is valid
    }

    // Validate Name (First Name and Last Name)
    if (nameInput.value.trim() === '') {
      displayError('Name is required.', 'nameError');
      return;
    }

    // Function to validate email
    function validateEmail(email) {
      const emailPattern = /^[a-zA-Z0-9._-]+@[a-zA-Z0-9.-]+\.[a-zA-Z]{2,4}$/;
      return emailPattern.test(email);
    }

    // Validate Email
    if (!validateEmail(emailInput.value.trim())) {
      displayError('Please enter a valid email address.', 'emailError');
      return;
    }

    // Function to validate Phone Number (11 digits starting with 09)
    function validatePhoneNumber(phone) {
      // Remove any spaces, dashes, or other non-digit characters from the input
      phone = phone.replace(/\D/g, '');
    
      // Check if the phone number is exactly 11 digits long and starts with '09'
      return /^09\d{9}$/.test(phone);
    }


    // Validate Phone Number
    const phoneValue = phoneInput.value.trim();
    if (!validatePhoneNumber(phoneValue)) {
      displayError('Please enter a valid 11-digit phone number starting with 09.', 'phoneError');
      return;
    }

    // Function to display an error message
    function displayError(errorMessage, errorElementId) {
      const errorElement = document.getElementById(errorElementId);
      errorElement.innerText = errorMessage;
    }

    // Continue with form submission if all validations pass
    this.submit();
  });
});

    // Validate Address (Not Empty)
    if (addressInput.value.trim() === '') {
      displayError('Address is required.', 'addressError');
      return;
    }

    // Validate Address for the complete address
    const addressParts = addressInput.value.trim().split(',');
    if (addressParts.length < 2) {
      displayError('Please enter a complete address with multiple parts (e.g., street, city).', 'addressError');
      return;
    }

    // Continue with form submission if all validations pass
    this.submit();
  });

  function displayError(errorMessage, errorElementId) {
    errorMessageUpdate.innerText = errorMessage;
    const errorElement = document.getElementById(errorElementId);
    if (errorElement) {
      errorElement.innerText = errorMessage;
    }
  }
});
</script>