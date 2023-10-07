// faqs
$(document).ready(function() {
    $('.question').click(function() {
        var toggleSign = $(this).find('.toggle-sign');
        $(this).next('.answer').slideToggle();
        toggleSign.text(toggleSign.text() === '+' ? '-' : '+');
    });
});

// notification
document.addEventListener('DOMContentLoaded', function() {
    var notification = document.querySelector('.notification');
    var closeButton = document.querySelector('.notification-close');
  
    // Show the notification
    function showNotification() {
      notification.style.display = 'block';
    }
  
    // Hide the notification
    function hideNotification() {
      notification.style.display = 'none';
    }
  
    // Event listener for the close button
    closeButton.addEventListener('click', function() {
      hideNotification();
    });
  
    // Example usage: show the notification after 3 seconds
    setTimeout(function() {
      showNotification();
    }, 3000);
  });

  // checkout
  window.addEventListener('DOMContentLoaded', function () {
    const paymentMethodDropdown = document.querySelector('.dropdown-content');
    const paymentMethodSelect = document.querySelector('#payment-method');
    const cashOnDeliveryParagraph = document.querySelector('.cash-on-delivery-reminder');

    paymentMethodSelect.addEventListener('change', function () {
      if (paymentMethodSelect.value === 'cod') {
        cashOnDeliveryParagraph.style.display = 'block';
      } else {
        cashOnDeliveryParagraph.style.display = 'none';
      }
    });
  });

  

  // order-receipt
// Get the cancel order button and modal elements
var cancelOrderButton = document.querySelector('.cancel-order-button');
var cancelOrderModal = document.getElementById('cancel-order-modal');
var cancelOrderYes = document.getElementById('cancel-yes');
var cancelOrderNo = document.getElementById('cancel-no');
var modalClose = document.querySelector('.close');

// Open the cancel order modal
cancelOrderButton.addEventListener('click', function() {
  cancelOrderModal.style.display = 'block';
});

// Close the cancel order modal when clicking on the close button or outside the modal
modalClose.addEventListener('click', function() {
  cancelOrderModal.style.display = 'none';
});

window.addEventListener('click', function(event) {
  if (event.target == cancelOrderModal) {
    cancelOrderModal.style.display = 'none';
  }
});

// Handle cancel order actions
cancelOrderYes.addEventListener('click', function() {
  // Perform cancel order logic here
  var cancelReasons = document.getElementById('cancel-reasons').value;
  console.log('Order canceled with reasons:', cancelReasons);
  cancelOrderModal.style.display = 'none';
});

cancelOrderNo.addEventListener('click', function() {
  // Do nothing, close the modal
  cancelOrderModal.style.display = 'none';
});


  //chatbox
  // Get the necessary DOM elements
const chatboxContainer = document.querySelector(".chatbox-container");
const chatboxPopup = chatboxContainer.querySelector(".chatbox-popup");
const closeBtn = chatboxPopup.querySelector(".close-button");
const messageInput = chatboxPopup.querySelector("input[type='text']");
const sendButton = chatboxPopup.querySelector(".send-button");
const messageContainer = chatboxPopup.querySelector(".message-container");

// Close the chatbox when close button is clicked
closeBtn.addEventListener("click", () => {
  chatboxContainer.style.display = "none";
});

// Send a message when send button is clicked or enter key is pressed
sendButton.addEventListener("click", sendMessage);
messageInput.addEventListener("keypress", (event) => {
  if (event.key === "Enter") {
    sendMessage();
  }
});

// Function to send a new message
function sendMessage() {
  const messageText = messageInput.value.trim();

  if (messageText !== "") {
    const message = createMessageElement(messageText, "outgoing");
    messageContainer.appendChild(message);
    messageInput.value = "";
    messageContainer.scrollTop = messageContainer.scrollHeight;
    // Simulate a response from the customer support
    setTimeout(sendResponse, 1000);
  }
}

// Function to create a new message element
function createMessageElement(text, className) {
  const messageElement = document.createElement("div");
  messageElement.classList.add("message", className);
  const messageText = document.createElement("p");
  messageText.textContent = text;
  messageElement.appendChild(messageText);
  return messageElement;
}

// Simulate a response from the customer support
function sendResponse() {
  const responseText = "Thank you for reaching out! How can I assist you?";
  const response = createMessageElement(responseText, "incoming");
  messageContainer.appendChild(response);
  messageContainer.scrollTop = messageContainer.scrollHeight;
}

// Show the chatbox when the page is loaded
window.addEventListener("load", () => {
  chatboxContainer.style.display = "block";
});

// Close the chatbox when close button is clicked
closeBtn.addEventListener("click", () => {
  chatboxContainer.style.display = "none";
});

// Show the chatbox when the page is loaded
window.addEventListener("load", () => {
  chatboxContainer.style.display = "block";
});

// Function to send a new message
function sendMessage() {
  const messageText = messageInput.value.trim();

  if (messageText !== "") {
    const message = createMessageElement(messageText, "outgoing");
    messageContainer.appendChild(message);
    messageInput.value = "";
    messageContainer.scrollTop = messageContainer.scrollHeight;
    const time = getTime();
    message.appendChild(createTimeElement(time));
    // Simulate a response from the customer support
    setTimeout(() => sendResponse(time), 1000);
  }
}

// Function to create a new message element
function createMessageElement(text, className) {
  const messageElement = document.createElement("div");
  messageElement.classList.add("message", className);
  const messageText = document.createElement("p");
  messageText.textContent = text;
  messageElement.appendChild(messageText);
  return messageElement;
}

// Function to create a time element
function createTimeElement(time) {
  const timeElement = document.createElement("span");
  timeElement.classList.add("time");
  timeElement.textContent = time;
  return timeElement;
}

// Function to get the current time
function getTime() {
  const date = new Date();
  const hours = date.getHours();
  const minutes = date.getMinutes();
  const formattedTime = `${hours}:${minutes < 10 ? "0" : ""}${minutes}`;
  return formattedTime;
}

// Function to simulate a response from the customer support
function sendResponse(time) {
  const responseText = "Thank you for reaching out! How can I assist you?";
  const response = createMessageElement(responseText, "incoming");
  response.appendChild(createTimeElement(time));
  messageContainer.appendChild(response);
  messageContainer.scrollTop = messageContainer.scrollHeight;
}


//cart-wishlist
function addToCart(productName) {
  // Add the product to the cart
  console.log(productName + ' added to cart!');
}


  //cartpage
  // Get all the quantity buttons
  const minusButtons = document.querySelectorAll('.quantity-btn.minus');
  const plusButtons = document.querySelectorAll('.quantity-btn.plus');

  // Add event listeners to each quantity button
  minusButtons.forEach(button => {
    button.addEventListener('click', () => {
      const input = button.parentElement.querySelector('.quantity-input');
      const currentValue = parseInt(input.value);
      if (currentValue > 1) {
        input.value = currentValue - 1;
      }
    });
  });

  plusButtons.forEach(button => {
    button.addEventListener('click', () => {
      const input = button.parentElement.querySelector('.quantity-input');
      const currentValue = parseInt(input.value);
      input.value = currentValue + 1;
    });
  });