<?php
include('dbconn.php');
include('./codes/adminheader.php');
include('./codes/adminnavbar.php');
include('./codes/adminsidebar.php');

$query = $_GET['query'];
$min_length = 3;
$per_page_record =100;
if (isset($_GET["page"]))
{
    $page = $_GET["page"];
}
else
{
    $page=1;
}

if(strlen($query) >= $min_length)
{
    $query = htmlspecialchars($query);
    $query = ($query);
$start_from = ($page-1) * $per_page_record;

    $raw_results = mysqli_query($db, "SELECT * FROM tb_product WHERE (`brand` LIKE '%".$query."%') OR (`category` LIKE '%".$query."%') OR (`product_name` LIKE '%".$query."%') OR (`product_desc` LIKE '%".$query."%') OR (`color` LIKE '%".$query."%') OR (`memory` LIKE '%".$query."%') OR (`Stock` LIKE '%".$query."%') OR (`Price` LIKE '%".$query."%') OR (`Status` LIKE '%".$query."%') OR (`Branch` LIKE '%".$query."%') ORDER BY id DESC LIMIT $start_from, $per_page_record ") or die(mysql_error());
    ?>
    

<div class="container mt-4">
    <div class="col">
        <div class="col-md-9">
            <div class="container text-center">
                <div class="row justify-content-start">
                    <div class="col-sm-6 col-md-4 text-left">
                        <a href="store_manager_products.php" class="store-manager-button">
                            <i class="fas fa-store"></i>
                            Store Manager
                        </a>
                    </div>
                </div>
            </div>
</div>

           

                    <div class="container">
                    <div class="row">
                        <div class="col-12">
                            <div class="search-container">
                            <form action="./adminproductsearch.php" method="GET">
                                <div class="input-group">
                                    <input type="text" name="query" class="form-control search-input" placeholder="Search..." aria-label="Search..." aria-describedby="button-addon2">
                                    <div class="input-group-append">
                                        <button class="btn btn-primary search-button" type="submit" id="button-addon2"><i class="bi bi-search"></i> </button>
                                    </div>
                                    </div>
                                </form>
                            
                        </div>
                   

            <div class="container">
        <div class="row">
            <div class="col-12">
                <div class="card">
                    <div class="card-header">
                        <h4 class="card-title">INVENTORY LIST</h4>
                        <button type="button" class="btn btn-custom" data-bs-toggle="modal" data-bs-target="#productAddModal">
                            <i class="fas fa-plus"></i> ADD PRODUCT
                        </button>
                        </h4>
                
                        <?php
                          if(isset($_SESSION['successMsg']))
                          {
                          ?><div class="alert alert-primary" role="alert"><?php echo $_SESSION['successMsg']; ?>
</div>
                                 
                        <?php
                        unset($_SESSION['successMsg']);
                          }

                        if(isset($_SESSION['errorMsg']))
                        {
                            ?>
                                <div class="alert alert-danger" role="alert"><?php echo $_SESSION['errorMsg']; ?> 
</div> 
                          <?php
                          unset($_SESSION['errorMsg']);
                            }
                          ?>
          </div>
          <div class="card-body">
            <div class="table-responsive">
              <table id="myTable" class="table table-bordered table-striped">
                <thead>
                  <tr>
                    <th style="width: 5%;">Product ID</th>
                    <th style="width: 10%;">Brand</th>
                    <th style="width: 10%;">Category</th>
                    <th style="width: 10%;">Product Name</th>
                    <th style="width: 15%;">Product Description</th>
                    <th style="width: 15%;">Color</th>
                    <th style="width: 15%;">Memory</th>
                    <th style="width: 8%;">Image 1</th>
                    <th style="width: 8%;">Image 2</th>
                    <th style="width: 8%;">Image 3</th>
                    <th style="width: 5%;">Stock</th>
                    <th style="width: 5%;">Price</th>
                    <th style="width: 5%;">Status</th>
                    <th style="width: 16%;">Action</th>
                  </tr>
                </thead>
                <tbody>
                    <?php
    if(mysqli_num_rows($raw_results) > 0)
    {
        $i=0;
        while($row = mysqli_fetch_array($raw_results))
        {
            ?>
            
                                        <tr>
                                            <td><?php echo $row['id'] ?></td>
                                            <td><?php echo $row['brand'] ?></td>
                                            <td><?php echo $row['category'] ?></td>
                                            <td class="truncate"><?php echo $row['product_name'] ?></td>
                                            <td class="truncate"><?php echo $row['product_desc'] ?></td>
                                            <td class="truncate"><?php echo $row['color'] ?></td>
                                            <td class="truncate"><?php echo $row['memory'] ?></td>
                                            <td><img src="uploaded_img/<?php echo $row['image_01'] ?>" class="img-thumbnail" style="max-height: 50px;"></td>
                                            <td><img src="uploaded_img/<?php echo $row['image_02'] ?>" class="img-thumbnail" style="max-height: 50px;"></td>
                                            <td><img src="uploaded_img/<?php echo $row['image_03'] ?>" class="img-thumbnail" style="max-height: 50px;"></td>
                                            <td><?php echo $row['Stock'] ?></td> 
                                            <td><?php echo $row['Price'] ?></td>
                                            <td><?php echo $row['Status'] ?></td>
                                        <td>
                                            
                                            
    <button type="button" class="viewProductModalBtn btn btn-info btn-sm" data-toggle="modal" data-target="#exampleModal" data-id="<?php echo $row['id']; ?>">
       <i class="fas fa-eye"></i> VIEW</button>
                                            <button type="button" value="<?php echo $row['id']; ?>" class="editProductBtn btn btn-success btn-sm" data-toggle="modal" data-target="#productEditModal" data-id="<?php echo $row['id']; ?>"><i class="fas fa-edit"></i> UPDATE</button>

                                             <button type="button" value="<?php echo $row['id']; ?>" data-toggle="modal" data-target="#productDeletetModal" data-id="<?php echo $row['id']; ?>" class="deleteProductBtn btn btn-danger btn-sm"><i class="fas fa-trash-alt"></i> DELETE</button>
                                        </td>
                                    </tr>
                              


    
            <?php
            $i++;
        }
    }
    else
    {
        echo "Result not found!";
    }
}
 
?>



                            </tbody>
                        </table>

                    </div>
                </div>
            </div>
        </div>
    </div>
    
    <nav aria-label="navigation">
        <ul class="pagination justify-content-center">
            <?php
            $query = "SELECT COUNT(*) FROM tb_product";
            $rs_result = mysqli_query($db, $query);
            $row = mysqli_fetch_row($rs_result);
            $total_records = $row[0];
            echo "<br/>";
            $total_pages = ceil($total_records / $per_page_record);
            $pageLink = "";
            if($page>=2)
            {
                echo "<li class='page-item'><a href='adminproductsearch.php?page=".($page-1)."' class='page-link'>Prev </a></li>";
            }
            for ($i=1; $i<=$total_pages; $i++)
            {
                if ($i == $page)
                {
                    $pageLink .="<li class='page-item'><a class='page-link' href='adminproductsearch.php?page=".$i."'>".$i."</a></li>";
                }
                else
                {
                    $pageLink .="<li class='page-item'><a class='page-link' href='adminproductsearch.php?page=".$i."'>".$i."</a></li>";
                }
            };
            echo $pageLink;
            if($page<$total_pages)
            {
                echo "<li class='apage-item'><a href='adminproductsearch.php?page=".($page+1)."' class='page-link'>Next </a></li>";
            }
            ?>
        </ul>
    </nav> 
    
    
    


    <!-- View Product Modal -->
    <div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Product Details</h5>
                    <button type="button" class="btn-close" data-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <div id="item-details"></div>
                </div>
            </div>
        </div>
    </div>
 
    <script>
        $(document).ready(function(){
            $('#exampleModal').on('show.bs.modal', function (event) {
                var button = $(event.relatedTarget);
                var itemId = button.data('id'); 
                $.ajax({
                    url: './adminserver/fetch_item_details.php',
                    type: 'POST',
                    data: {id: itemId},
                    success: function(response){
                        $('#item-details').html(response);
                    }
                });
            });
        });
    </script>



    <!-- Add Product -->
    <div class="modal fade" id="productAddModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">ADD PRODUCT</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>

            <div id="alertMessage" class="alert d-none"></div>

              <form method="POST" action="./adminserver/adminproductsserver.php" enctype="multipart/form-data">
                <div class="modal-body">
                    <div id="errorMessage" class="alert alert-warning d-none">All fields are mandatory.</div>
                    <div class="mb-3">
                        <label for="">Brand</label>
                        <select name="brand" class="form-control" required>
                        <option value="" selected>Select Brand</option>
                           
                      <?php 
                      
                    $result = mysqli_query($db,"SELECT * FROM tb_brand ");
                     
                    if (mysqli_num_rows($result) > 0) {
                     
                    $i=0;
                    while($row = mysqli_fetch_array($result)) {
                    ?>
                    <option value="<?php echo $row["brandname"]; ?>" ><?php echo $row["brandname"]; ?></option>     
                    <?php
                    $i++;
                    }
                    ?>
                    <?php
                    }
                    else{
                    echo "No Brand Yet!!!";
                    }
                    ?>

                    </select>
                    </div>
                    <div class="mb-3">
                        <label for="">Category</label>
                        <select name="category" class="form-control" required>
                        <option value="" selected>Select Category</option>
                              <?php 
                      
                    $result = mysqli_query($db,"SELECT * FROM tb_category ");
                     
                    if (mysqli_num_rows($result) > 0) {
                     
                    $i=0;
                    while($row = mysqli_fetch_array($result)) {
                    ?>
                    <option value="<?php echo $row["catename"]; ?>" ><?php echo $row["catename"]; ?></option>     
                    <?php
                    $i++;
                    }
                    ?>
                    <?php
                    }
                    else{
                    echo "No Category Yet!!!";
                    }
                    ?>
                    </select>
                    </div>
                    <div class="mb-3">
                        <label for="">Product Name</label>
                        <input type="text" name="product_name" class="form-control" required>
                    </div>
                    <div class="mb-3">
                        <label for="">Product Description</label>
                        <input type="text" name="product_desc" class="form-control" />
                    </div>
                    <div class="mb-3">
                        <label for="">Color</label>
                        <select name="color" class="form-control" required>
                        <option value="" selected>Select Color</option>
                              <?php 
                      
                    $result = mysqli_query($db,"SELECT * FROM tb_color ");
                     
                    if (mysqli_num_rows($result) > 0) {
                     
                    $i=0;
                    while($row = mysqli_fetch_array($result)) {
                    ?>
                    <option value="<?php echo $row["colorname"]; ?>" ><?php echo $row["colorname"]; ?></option>     
                    <?php
                    $i++;
                    }
                    ?>
                    <?php
                    }
                    else{
                    echo "No Color Yet!!!";
                    }
                    ?>
                    </select>
                    </div>
                    
                    <div class="mb-3">
                        <label for="">Memory</label>
                        <select name="memory" class="form-control" required>
                        <option value="" selected>Select Memory</option>
                              <?php 
                      
                    $result = mysqli_query($db,"SELECT * FROM tb_memory ");
                     
                    if (mysqli_num_rows($result) > 0) {
                     
                    $i=0;
                    while($row = mysqli_fetch_array($result)) {
                    ?>
                    <option value="<?php echo $row["memoryname"]; ?>" ><?php echo $row["memoryname"]; ?></option>     
                    <?php
                    $i++;
                    }
                    ?>
                    <?php
                    }
                    else{
                    echo "No Memory Yet!!!";
                    }
                    ?>
                    </select>
                    </div>
                    
                    <div class="mb-3">
                        <label for="">Branch</label></label>
                        <select name="branch" class="form-control" required>
                        <option value="" selected>Select Branch</option>
                              <?php 
                      
                    $result = mysqli_query($db,"SELECT * FROM tb_branch ");
                     
                    if (mysqli_num_rows($result) > 0) {
                     
                    $i=0;
                    while($row = mysqli_fetch_array($result)) {
                    ?>
                    <option value="<?php echo $row["branchname"]; ?>" ><?php echo $row["branchname"]; ?></option>     
                    <?php
                    $i++;
                    }
                    ?>
                    <?php
                    }
                    else{
                    echo "No Memory Yet!!!";
                    }
                    ?>
                    </select>
                    </div>
                    <div class="mb-3">
                        <label for="">Image 1</label>
                        <input type="file" name="image_01" class="form-control" accept="image/*" required onchange="previewImage(event, 'image01_preview')">
                        <img id="image01_preview" class="img-preview form-control" src="" alt="">
                    </div>
                    <div class="mb-3">
                        <label for="">Image 2</label>
                        <input type="file" name="image_02" class="form-control" accept="image/*" required onchange="previewImage(event, 'image02_preview')">
                        <img id="image02_preview" class="img-preview form-control" src="" alt="">
                    </div>
                    <div class="mb-3">
                        <label for="">Image 3</label>
                        <input type="file" name="image_03" class="form-control" accept="image/*" required onchange="previewImage(event, 'image03_preview')">
                        <img id="image03_preview" class="img-preview form-control" src="" alt="">
                    </div>
                    <div class="mb-3">
                        <label for="">Stock</label>
                        <input type="number" name="Stock" class="form-control" />
                    </div>
                    <div class="mb-3">
                        <label for="">Price</label>
                        <input type="number" name="Price" class="form-control" />
                    </div>
                    <div class="mb-3">
                        <label for="">Status</label>
                        <select id="Status" name="Status" class="form-control">
                            <option value="Active">Active</option>
                            <option value="Inactive">Inactive</option>
                        </select>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">CLOSE</button>
                    <button type="submit" name="addproduct" class="btn btn-primary">SAVE PRODUCTS</button>

                </div>
            </form>
        </div>
    </div>
</div>




    <!-- Edit Product Modal --> 
    
    <div class="modal fade" id="productEditModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabelu" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabelu">Product Details</h5>
                    <button type="button" class="btn-close" data-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <div id="item-detailsu"></div>
                </div>
            </div>
        </div>
    </div>
 
    <script>
        $(document).ready(function(){
            $('#productEditModal').on('show.bs.modal', function (event) {
                var button = $(event.relatedTarget);
                var itemId = button.data('id'); 
                $.ajax({
                    url: './adminserver/updatefetch.php',
                    type: 'POST',
                    data: {id: itemId},
                    success: function(response){
                        $('#item-detailsu').html(response);
                    }
                });
            });
        });
    </script>




    <!-- Delete Product Modal -->

  
    <div class="modal fade" id="productDeletetModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabeld" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabeld">Delete</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <div id="item-detailsd"></div>
                </div>
            </div>
        </div>
    </div>
 
    <script>
        $(document).ready(function(){
            $('#productDeletetModal').on('show.bs.modal', function (event) {
                var button = $(event.relatedTarget);
                var itemId = button.data('id'); 
                $.ajax({
                    url: './adminserver/deletefetch.php',
                    type: 'POST',
                    data: {id: itemId},
                    success: function(response){
                        $('#item-detailsd').html(response);
                    }
                });
            });
        });
    </script>

 










<?php
include('./codes/adminfooter.php');
?>

    