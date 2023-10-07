<?php
include('dbconn.php');
include('./managercodes/managerlogin.php');
include('./managercodes/managerheader.php');
include('./managercodes/managernavbar.php');
include('./managercodes/managersidebar.php');
include('./managercodes/managerallproducts.php');
?>

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
                    url: './managerserver/fetch_item_details.php',
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

              <form method="POST" action="./managerserver/managerproductsserver.php" enctype="multipart/form-data">
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
                    url: './managerserver/updatefetch.php',
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
                    url: './managerserver/deletefetch.php',
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
?>
