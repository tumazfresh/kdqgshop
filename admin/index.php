<?php
include('../dbconn.php');
include('../codes/adminlogin.php');
include('../codes/adminheader.php');
include('../codes/adminnavbar.php');
include('../codes/adminsidebar.php'); 
?>

        <div class="dashboard-container" style="margin: 20px; padding: 20px;">
                <div class="dashboard-content" style="margin-top: 5px;">
                    <h2>DASHBOARD OVERVIEW</h2>
                    <!--
                    <a href="store_manager_dashboard.php" class="store-manager-button">
                        <i class="fas fa-store"></i> Store Manager
                    </a>
                    -->
                  <div class="dashboard-cards" style="display: flex; flex-direction: row; justify-content: space-between; align-items: center; padding: 10px;">
                      
                    <!-- SmartPhone Stocks card -->
                  <div id="phoneCategory" class="dashboard-card" style="margin: 10px; padding: 10px;">
                    <div class="card-icon">
                        <i class="fas fa-mobile"></i>
                    </div>
                    <div class="card-content" style="margin: 5px; padding: 5px;">
                        <h3 id="phoneCategoryCount" style="margin: 5px; padding: 5px;">0</h3>
                        <span class="label-name" >SmartPhone Stocks</span>
                         <?php if ($lowStockCounts['Smartphone'] > 0): ?>
                            <!-- <div class="alert" id="alertPhone" style="display: none;"> </div> -->
                            <!-- Your alert message content goes here -->
                            <p class="low-stock-message">
                                <i class="fas fa-exclamation-triangle exclamation-icon"></i>
                                <?php echo $lowStockCounts['Smartphone']; ?> products are low stock.
                            </p>
                            
                         <?php endif; ?>
                    </div>
                </div>

                    <!-- Laptop Stocks card -->
                  <div id="laptopCategory" class="dashboard-card" style="margin: 10px; padding: 10px;">
                    <div class="card-icon">
                      <i class="fas fa-laptop"></i>
                    </div>
                    <div class="card-content" style="margin: 5px; padding: 5px;">
                      <h3 id="laptopCategoryCount" style="margin: 5px; padding: 5px;">0</h3>
                      <span class="label-name">Laptop Stocks</span>
                      <?php if ($lowStockCounts['Laptop'] > 0): ?>
                        <!-- <div class="alert" id="alertLaptop" style="display: none;"></div> -->
                            <!-- Your alert message content goes here -->
                            <p class="low-stock-message">
                                <i class="fas fa-exclamation-triangle exclamation-icon"></i>
                                <?php echo $lowStockCounts['Laptop']; ?> products are low stock.
                            </p>
                       
                       <?php endif; ?>
                    </div>
                  </div>
                  
                    <!-- Accessories Stocks card -->
                  <div id="accesoriesCategory" class="dashboard-card" style="margin: 10px; padding: 10px;">
                    <div class="card-icon">
                      <i class="fas fa-headphones"></i>
                    </div>
                    <div class="card-content" style="margin: 5px; padding: 5px;">
                      <h3 id="accessoryCategoryCount" style="margin: 5px; padding: 5px;">0</h3>
                      <span class="label-name">Accessories Stocks</span>
                      <?php if ($lowStockCounts['Accessory'] > 0): ?>
                        <!-- <div class="alert" id="alertAccessory" style="display: none;"> </div> -->
                            <!-- Your alert message content goes here -->
                            <p class="low-stock-message">
                                <i class="fas fa-exclamation-triangle exclamation-icon"></i>
                                <?php echo $lowStockCounts['Accessory']; ?> products are low stock.
                            </p>
                        
                        <?php endif; ?>
                    </div>
                  </div>
                  
                    <!-- Purchase Orders card -->
                  <div id="ordersCategory" class="dashboard-card" style="margin: 10px; padding: 10px;">
                    <div class="card-icon" >
                      <i class="fas fa-shopping-cart"></i>
                    </div>
                    <div class="card-content" style="margin: 5px; padding: 5px;">
                      <h3 id="purchaseOrdersCount" style="margin: 5px; padding: 5px;">0</h3>
                      <span class="label-name">Purchase Orders</span>
                    </div>
                  </div>
                  
                    <!-- Rating and Review card -->
                  <div id="ratingCategory" class="dashboard-card" style="margin: 10px; padding: 10px;">
                    <div class="card-icon">
                      <i class="fas fa-star"></i>
                    </div>
                    <div class="card-content" style="margin: 5px; padding: 5px;">
                      <h3 id="messagesCount" style="margin: 5px; padding: 5px;">0</h3>
                      <span class="label-name">Rating and Review</span>
                    </div>
                  </div>
                  
                    <!-- Inventory alert card -->
                  <div id="inventoryAlertsCategory" class="dashboard-card" style="margin: 10px; padding: 10px;">
                    <div class="card-icon">
                      <i class="fas fa-boxes"></i>
                    </div>
                    <div class="card-content" style="margin: 5px; padding: 5px;">
                      <h3 id="inventoryAlertsCount" style="margin: 5px; padding: 5px;">0</h3>
                      <span class="label-name">Inventory Alerts</span>
                    </div>
                  </div>
            </div>  <!-- dashboard cards endiv-->
            
            <div class="charts">
                <div class="top-products-chart">
                    <h2>Top 5 Products Ordered</h2>
                    <div class="chart">
                         <!--first CHART id?-->
                            <canvas id="myChart"></canvas>
                    </div>
                </div>    
                        <!--first CHART script-->
                        <script>
                        // setup
                            const quantity = <?php echo json_encode($quantity); ?>;
                            const productName = <?php echo json_encode($productName); ?>;
                            const data = {
                                labels: productName,
                                datasets: [{
                                    //label: '# of Orders', NOTE: Might include again, depends
                                    label: 'Quantity Ordered',
                                    data: quantity,
                                    backgroundColor: [
                                        'rgba(255, 99, 132, 0.6)',
                                        'rgba(54, 162, 235, 0.6)',
                                        'rgba(255, 206, 86, 0.6)',
                                        'rgba(75, 192, 192, 0.6)',
                                        'rgba(153, 102, 255, 0.6)'
                                    ],
                                    borderColor: [
                                        'rgba(255, 99, 132, 1)',
                                        'rgba(54, 162, 235, 1)',
                                        'rgba(255, 206, 86, 1)',
                                        'rgba(75, 192, 192, 1)',
                                        'rgba(153, 102, 255, 1)'
                                    ],
                                    borderWidth: 1,
                                }]
                            };
                        
                            // Config
                            const config = {
                                type: 'bar',
                                data,
                                options: {
                                    scales: {
                                        y: {
                                            beginAtZero: true,
                                            grid: {
                                                display: true,
                                                color: 'rgba(0, 0, 0, 0.1)', 
                                            },
                                            title: {
                                                display: true,
                                                text: 'Quantity Ordered', // y-axis label
                                            },
                                        },
                                        x: {
                                            grid: {
                                                display: false,
                                            },
                                            title: {
                                                display: true,
                                                text: 'Products Purchased', // x-axis label
                                            },
                                        },
                                    },
                                    plugins: {
                                        legend: {
                                            display: false,
                                        },
                                    },
                                    responsive: true,
                                    maintainAspectRatio: false, // disable aspect ratio for more control
                                    animation: {
                                        duration: 2000, // animation duration 
                                        easing: 'easeOutBounce', // animation function
                                    },
                                },
                            };
                            
                        //chart render
                            const ctx = document.getElementById('myChart').getContext('2d');
                            const myChart = new Chart(ctx, config);
        
                         // new Chart(ctx, {
                          //});
                        </script>
                        
                        <!--<img src="img/sample_chart1.jpg" alt="Top Products Chart">-->
                        <!--<button class="analytics-button" title="Analytics">
                            <i class="fas fa-chart-bar"></i>
                        </button>-->
                    
                <div class="purchase-sales-chart">
                    <h2>Purchase and Sales Orders</h2>
                    
                    <div class="chart-container">
                         Sample content for purchase and sales chart 
                        <img src="../img/sample_chart1.jpg" alt="Top Products Chart">
                        <button class="analytics-button" title="Analytics">
                            <i class="fas fa-chart-bar"></i>
                        </button>
                    </div>
                </div>
            </div>
        </div> <!--dahboard content end div -->
    </div> <!--dahboard container end div -->
        
<script src="admin_script.js"></script>

<script>
//get count to display on the cards
    // Define an array with URLs to fetch data
    const urlConfigs = [
        { id: 'purchaseOrdersCount', url: 'admin_orders.php' },
        { id: 'messagesCount', url: 'admin_messages.php' },
        { id: 'inventoryAlertsCount', url: 'admin_low_stocks.php' },
        { id: 'phoneCategoryCount', url: 'admin_phone_category.php' },
        { id: 'laptopCategoryCount', url: 'admin_laptop_category.php' },
        { id: 'accessoryCategoryCount', url: 'admin_accessory_category.php' },
    ];

    // Function to update count and element
    function updateCount(elementId, url) {
        $.ajax({
            url: url,
            type: 'GET',
            success: function (data) {
                $('#' + elementId).text(data);
            },
            error: function () {
                // Handle any errors here
                console.error('Error fetching count for ' + elementId);
            }
        });
    }

    // Iterate over the urlConfigs array and set intervals for updates
    $(document).ready(function () {
        for (const config of urlConfigs) {
            updateCount(config.id, config.url);
            setInterval(() => updateCount(config.id, config.url), 60000);
        }
    });
</script>
        
<script>
//to go to pages once clicked
        $(document).ready(function () {
            // Attach a click event handler to the card by its id
            $('#phoneCategory').click(function () {
                // Redirect to a different form or page
                window.location.href = 'admin_productstest.php'; // Replace with the actual URL
            });
        
            $('#laptopCategory').click(function () {
                window.location.href = 'admin_productstest.php'; // Replace with the actual URL
            });
            
            $('#accesoriesCategory').click(function () {
                window.location.href = 'admin_productstest.php'; // Replace with the actual URL
            });
            
            $('#ordersCategory').click(function () {
                window.location.href = 'admin_order_page.php'; // Replace with the actual URL
            });
            
            $('#ratingCategory').click(function () {
                window.location.href = 'admin_order_page.php'; // Replace with the actual URL
            }); 
            
            $('#inventoryAlertsCategory').click(function () {
                window.location.href = 'admin_order_page.php'; // Replace with the actual URL
            });
        });
        
        /* Commenting, might need again
        if (false) {
            // Show the alert message
            document.getElementById('alertAccessory').style.display = 'block';
            document.getElementById('alertLaptop').style.display = 'block';
            document.getElementById('alertPhone').style.display = 'block';
        }*/
</script>
</body>
</html>
