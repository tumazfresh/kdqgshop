<?php

include('../dbconn.php');

$id = $_GET['id'];

$sql = "SELECT * FROM tb_category WHERE id = ?";
$stmt = $db->prepare($sql);

if ($stmt) {
    $stmt->bind_param("i", $id);
    $stmt->execute();
    $result = $stmt->get_result();

    if ($result->num_rows > 0) {
        $row = $result->fetch_assoc();
        ?> 
        
     <script src="../js/productupdate.js"></script>  
              <form method="POST" action="../adminserver/categoryupdateserver.php" enctype="multipart/form-data">
                <div class="modal-body">
                    <div id="errorMessage" class="alert alert-warning d-none">All fields are mandatory.</div>
                    <div class="mb-3">
                         <div class="mb-3">
                        <label for="">Category Name</label>
                        <input type="text" value="<?php echo $row["catename"]?>" name="category_name" class="form-control"  >
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
