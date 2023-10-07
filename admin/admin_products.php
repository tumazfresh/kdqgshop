<?php
include('../dbconn.php');
include('../codes/adminlogin.php');
include('../codes/adminheader.php');
include('../codes/adminnavbar.php');
include('../codes/adminsidebar.php');
include('../codes/adminallproducts.php');
?>

<!--Product View starts-->
<div class="modal" id="veiwModal">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">View Details</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
                <div class="modal-body" id="veiwmodalBody">
                </div>
                <div class="modal-footer">
                     <button type="button" class="btn btn-danger" data-dismiss="modal">Close</button>
                </div>
            </div>
        </div>
    </div>
    
     <script>
         $(document).ready(function()
         {
             $('button').click(function()
             {
                 var id = $(this).data('id');
                 $.ajax({
                     url: '../adminserver/fetch_item_details.php?id=' + id,
                     type: 'GET',
                     success: function(data)
                     {
                         $('#veiwmodalBody').html(data);
                     }
                 });
             });
         });
     </script>
    <!--Product view ends -->
 
 

 
    

    <!-- Add Product -->
    <div class="modal fade" id="productAddModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">ADD PRODUCT</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>

            <div id="alertMessage" class="alert d-none"></div>

              <form method="POST" action="../adminserver/adminproductsserver.php" enctype="multipart/form-data">
                <div class="modal-body">
                    <div id="errorMessage" class="alert alert-warning d-none">All fields are mandatory.</div>
                    <div class="mb-3">
                        <label for="">Brand</label>
                        <select name="brand" class="form-control"  >
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
                        <select name="category" class="form-control"  >
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
                        <label for="">SubCategory</label>
                        <select name="subcategory" class="form-control"  >
                        <option value="" selected>Select SubCategory</option>
                              <?php 
                      
                    $result = mysqli_query($db,"SELECT * FROM subcategory ");
                     
                    if (mysqli_num_rows($result) > 0) {
                     
                    $i=0;
                    while($row = mysqli_fetch_array($result)) {
                    ?>
                    <option value="<?php echo $row["name"]; ?>" ><?php echo $row["name"]; ?></option>     
                    <?php
                    $i++;
                    }
                    ?>
                    <?php
                    }
                    else{
                    echo "No SubCategory Yet!!!";
                    }
                    ?>
                    </select>
                    </div>
                    
                    <div class="mb-3">
                        <label for="">Product Name</label>
                        <input type="text" name="product_name" class="form-control"  >
                    </div>
                    <div class="mb-3">
                        <label for="">Product Description</label>
                        <input type="text" name="product_desc" class="form-control" />
                    </div>
                    <div class="mb-3">
                        <label for="">Color</label>
                        <select name="color[]" class="form-control" multiple  >
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
                        <select name="memory[]" class="form-control" multiple  >
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
                        <select name="branch" class="form-control"  >
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
                        <input type="file" name="image_01" class="form-control" accept="image/*"   onchange="previewImage(event, 'image01_preview')">
                        <img id="image01_preview" class="img-preview form-control" src="" alt="">
                    </div>
                    <div class="mb-3">
                        <label for="">Image 2</label>
                        <input type="file" name="image_02" class="form-control" accept="image/*"   onchange="previewImage(event, 'image02_preview')">
                        <img id="image02_preview" class="img-preview form-control" src="" alt="">
                    </div>
                    <div class="mb-3">
                        <label for="">Image 3</label>
                        <input type="file" name="image_03" class="form-control" accept="image/*"   onchange="previewImage(event, 'image03_preview')">
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



<!--Product edit starts-->
<div class="modal" id="editModal">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">Product Details</h5>
                    <button type="button" class="btn-close" data-dismiss="modal">&times;</button>
                </div>
                <div class="modal-body" id="editmodalBody">
                </div>
                <div class="modal-footer">
                     <button type="button" class="btn btn-danger" data-dismiss="modal">Close</button>
                </div>
            </div>
        </div>
    </div>
    
     <script>
         $(document).ready(function()
         {
             $('button').click(function()
             {
                 var id = $(this).data('id');
                 $.ajax({
                     url: '../adminserver/updatefetch.php?id=' + id,
                     type: 'GET',
                     success: function(data)
                     {
                         $('#editmodalBody').html(data);
                     }
                 });
             });
         });
     </script>
    <!--Product edit ends -->

 


    <!-- Delete Product Modal -->
<div class="modal" id="delModal">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">Product Delete</h5>
                    <button type="button" class="btn-close" data-dismiss="modal">&times;</button>
                </div>
                <div class="modal-body" id="delmodalBody">
                </div>
               
               
            </div>
        </div>
    </div>
    
     <script>
         $(document).ready(function()
         {
             $('button').click(function()
             {
                 var id = $(this).data('id');
                 $.ajax({
                     url: '../adminserver/deletefetch.php?id=' + id,
                     type: 'GET',
                     success: function(data)
                     {
                         $('#delmodalBody').html(data);
                     }
                 });
             });
         });
     </script>
  

 










<?php
include('../codes/adminfooter.php');
?>
