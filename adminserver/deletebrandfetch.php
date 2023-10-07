<?php

include('../dbconn.php');

$id = $_GET['id'];

$sql = "SELECT * FROM tb_brand WHERE id = ?";
$stmt = $db->prepare($sql);

if ($stmt) {
    $stmt->bind_param("i", $id);
    $stmt->execute();
    $result = $stmt->get_result();

    if ($result->num_rows > 0) {
        $row = $result->fetch_assoc();
        ?> 
              <form method="POST" action="../adminserver/branddeleteserver.php" enctype="multipart/form-data">
                <div class="modal-body">
                    
                    <div class="mb-3">
                    <h1>Do you want to delete product?</h1>    
                    <input type="hidden" value="<?php echo $row["id"]?>" name="id" >
                </div></div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">NO</button>
                    <button type="submit" name="deleteproduct" class="btn btn-primary">YES</button>

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
