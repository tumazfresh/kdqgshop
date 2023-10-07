// checkout.js
document.addEventListener("DOMContentLoaded", function () {
  const proofOfPaymentForm = document.getElementById("proof-of-payment-form");

  proofOfPaymentForm.addEventListener("submit", function (event) {
    event.preventDefault(); // Prevent the default form submission

    const formData = new FormData(proofOfPaymentForm);

    $.ajax({
      type: "POST",
      url: "checkout_codes.php",
      data: formData,
      processData: false,
      contentType: false,
      success: function (response) {
        // Handle the success response here, if needed
        document.getElementById("proof-of-payment-modal-container").innerHTML = response;

        // Close the modal after successful submission
        proofOfPaymentModal.style.display = "none";
      },
    });
  });
});
