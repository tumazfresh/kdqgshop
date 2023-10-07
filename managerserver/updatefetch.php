<?php

include('../dbconn.php');

$id = $_POST['id'];

$sql = "SELECT * FROM tb_product WHERE id = ?";
$stmt = $db->prepare($sql);

if ($stmt) {
    $stmt->bind_param("i", $id);
    $stmt->execute();
    $result = $stmt->get_result();

    if ($result->num_rows > 0) {
        $row = $result->fetch_assoc();
        ?> 
        
     <script src="../js/productupdate.js"></script>  
              <form method="POST" action="./managerserver/productupdateserver.php" enctype="multipart/form-data">
                <div class="modal-body">
                    <div id="errorMessage" class="alert alert-warning d-none">All fields are mandatory.</div>
                    <div class="mb-3">
                        <label for="">Brand</label>
                        <select name="brand" class="form-control"  >
                        <option value="<?php echo $row["brand"]?>" selected><?php echo $row["brand"]?></option>
                           
                      <?php 
                      
                    $resultb = mysqli_query($db,"SELECT * FROM tb_brand ");
                     
                    if (mysqli_num_rows($resultb) > 0) {
                     
                    $i=0;
                    while($rowb = mysqli_fetch_array($resultb)) {
                    ?>
                    <option value="<?php echo $rowb["brandname"]; ?>" ><?php echo $rowb["brandname"]; ?></option>     
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
                        <option value="<?php echo $row["category"]?>" selected><?php echo $row["category"]?></option>
                              <?php 
                      
                    $resultc = mysqli_query($db,"SELECT * FROM tb_category ");
                     
                    if (mysqli_num_rows($resultc) > 0) {
                     
                    $i=0;
                    while($rowc = mysqli_fetch_array($resultc)) {
                    ?>
                    <option value="<?php echo $rowc["catename"]; ?>" ><?php echo $rowc["catename"]; ?></option>     
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
                        <label for="">Color</label>
                        <select name="color" class="form-control"  >
                        <option value="<?php echo $row["color"]?>" selected><?php echo $row["color"]?></option>
                              <?php 
                      
                    $resultd = mysqli_query($db,"SELECT * FROM tb_color ");
                     
                    if (mysqli_num_rows($resultd) > 0) {
                     
                    $i=0;
                    while($rowd = mysqli_fetch_array($resultd)) {
                    ?>
                    <option value="<?php echo $rowd["colorname"]; ?>" ><?php echo $rowd["colorname"]; ?></option>     
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
                        <select name="memory" class="form-control"  >
                        <option value="<?php echo $row["memory"]?>" selected><?php echo $row["memory"]?></option>
                              <?php 
                      
                    $resulte = mysqli_query($db,"SELECT * FROM tb_memory ");
                     
                    if (mysqli_num_rows($resulte) > 0) {
                     
                    $i=0;
                    while($rowe = mysqli_fetch_array($resulte)) {
                    ?>
                    <option value="<?php echo $rowe["memoryname"]; ?>" ><?php echo $rowe["memoryname"]; ?></option>     
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
                        <label for="">Branch</label>
                        <select name="branch" class="form-control"  >
                        <option value="<?php echo $row["Branch"]?>" selected><?php echo $row["Branch"]?></option>
                              <?php 
                      
                    $resultf = mysqli_query($db,"SELECT * FROM tb_branch ");
                     
                    if (mysqli_num_rows($resultf) > 0) {
                     
                    $i=0;
                    while($rowf = mysqli_fetch_array($resultf)) {
                    ?>
                    <option value="<?php echo $rowf["branchname"]; ?>" ><?php echo $rowf["branchname"]; ?></option>     
                    <?php
                    $i++;
                    }
                    ?>
                    <?php
                    }
                    else{
                    echo "No Branch Yet!!!";
                    }
                    ?>
                    </select>
                    </div>
                    
                    
                    
                    <div class="mb-3">
                        <label for="">Product Name</label>
                        <input type="text" value="<?php echo $row["product_name"]?>" name="product_name" class="form-control"  >
                    </div>
                    <div class="mb-3">
                        <label for="">Product Description</label>
                        <input type="text" value="<?php echo $row["product_desc"]?>" name="product_desc" class="form-control" />
                    </div>
                    <div class="mb-3">
                        <label for="">Image 1</label> 
                        <input type="file" name="image_01" id="image" class="form-control" accept="image/*" onchange="previewImage(this)">
                        <?php echo "<img src='../uploaded_img/".$row['image_01']."' id='image-preview' class='img-preview form-control'>";?> 
                    </div>
                    
                    
                    <div class="mb-3">
                        <label for="">Image 2</label>
                        <input type="file" name="image_02" id="imageb" class="form-control" accept="image/*" onchange="previewImageb(this)">
                        <?php echo "<img src='../uploaded_img/".$row['image_02']."' id='image-previewb' class='img-preview form-control'>";?> 
                    </div>
                    
                    
                    <div class="mb-3">
                        <label for="">Image 3</label>
                        <input type="file" name="image_03" id="imagec" class="form-control" accept="image/*"   onchange="previewImagec(this)">
                        <?php echo "<img src='../uploaded_img/".$row['image_03']."' id='image-previewc' class='img-preview form-control'>";?> 
                    </div>
                    <div class="mb-3">
                        <label for="">Stock</label>
                        <input type="number" value="<?php echo $row["Stock"]?>" name="Stock" class="form-control" />
                    </div>
                    <div class="mb-3">
                        <label for="">Price</label>
                        <input type="number" value="<?php echo $row["Price"]?>" name="Price" class="form-control" />
                    </div>
                    <div class="mb-3">
                        <label for="">Status</label>
                        <select id="Status" name="Status" class="form-control">
                            <option value="<?php echo $row["Status"]?>" selected><?php echo $row["Status"]?></option>
                            <option value="Active">Active</option>
                            <option value="Inactive">Inactive</option>
                        </select>
                    </div>
                    <input type="hidden" value="<?php echo $row["id"]?>" name="id" >
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">CLOSE</button>
                    <button type="submit" name="updateproduct" class="btn btn-primary">SAVE PRODUCTS</button>

                </div>
            </form> 
            
        <?php
    } else {
        echo "Item not found.";
    }

    $stmt->close();
} else {
    echo "Error in SQL statement";
}

$db->close();

?>
