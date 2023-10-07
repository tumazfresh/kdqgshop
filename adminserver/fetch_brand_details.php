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
         <div class="modal-body">
                <p><strong>Product ID: </strong><span"></span><?php echo $row["id"]?></p>
                <p><strong>Brand: </strong><span><?php echo $row["brand"]?></span></p>
                <p><strong>Category: </strong><span><?php echo $row["category"]?></span></p>
                <p><strong>SubCategory: </strong><span><?php echo $row["subcategory"]?></span></p> 
                <p><strong>Color: </strong><span>
                                                 <?php
                                                 $pidd=$row['id'];
                $sqlw = "SELECT color FROM tb_product WHERE id=$pidd ";
                $resut = $dba->query($sqlw);
                if($resut->num_rows > 0)
                {
                    $rcl = $resut->fetch_assoc();
                    $colors = unserialize($rcl['color']);
                    if(is_array($colors))

                    {
                        foreach ($colors as $color)
                        {
                ?>
                                            <?php echo $color .", "; ?>
                <?php
                }}
                else
                {
                    echo "No color";
                }
                }
                else
                {
                    echo "No result";
                }
                ?></span></p>
                                           <p><strong>Color: </strong><span>
                                                 <?php
                                                 $pidd=$row['id'];
                $sqlw = "SELECT memory FROM tb_product WHERE id=$pidd ";
                $resut = $dba->query($sqlw);
                if($resut->num_rows > 0)
                {
                    $rcl = $resut->fetch_assoc();
                    $memorys = unserialize($rcl['memory']);
                    if(is_array($memorys))

                    {
                        foreach ($memorys as $memory)
                        {
                ?>
                                            <?php echo $memory .", "; ?>
                <?php
                }}
                else
                {
                    echo "No memory";
                }
                }
                else
                {
                    echo "No result";
                }
                ?></span></p>
                                            
                <p><strong>Branch: </strong><span><?php echo $row["Branch"]?></span></p>
                <p><strong>Product Name: </strong><span></span><?php echo $row["product_name"]?></p>
                <p><strong>Product Description: </strong><span><?php echo $row["product_desc"]?></span></p>
                <p><strong>Image 1: </strong><?php echo "<img src='../uploaded_img/".$row['image_01']."' class='img-thumbnail'>";?></p>
                <p><strong>Image 2: </strong><?php echo "<img src='../uploaded_img/".$row['image_02']."' class='img-thumbnail'>";?></p>
                <p><strong>Image 3: </strong> <?php echo "<img src='../uploaded_img/".$row['image_03']."' class='img-thumbnail'>";?> </p>
                <p><strong>Stock: </strong><span><?php echo $row["Stock"]?></span></p>
                <p><strong>Price: </strong><span><?php echo $row["Price"]?></span></p>
                <p><strong>Status: </strong><span><?php echo $row["Status"]?></span></p>
            </div>
            
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
