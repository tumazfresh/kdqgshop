// add products

const sidebar = document.querySelector('.add-products-sidebar');

sidebar.addEventListener('mouseenter', function() {
    this.classList.add('expanded');
});

sidebar.addEventListener('mouseleave', function() {
    this.classList.remove('expanded');
});

//dashboard
const dashboardCards = document.querySelectorAll('.dashboard-card');
        
        // Add click event listeners to dashboard cards
        dashboardCards.forEach(card => {
            card.addEventListener('click', () => {
                // Perform desired action when a card is clicked
                console.log('Card clicked:', card);
            });
        });

        //products

        