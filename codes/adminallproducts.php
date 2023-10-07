<?php
error_reporting(0);
$per_page_record =8;
if (isset($_GET["page"]))
{
    $page = $_GET["page"];
}
else
{
    $page=1;
}
$start_from = ($page-1) * $per_page_record;
$result = mysqli_query($db, "SELECT * FROM tb_product ORDER BY id ASC LIMIT $start_from, $per_page_record ");

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
                                                <button class="btn btn-primary search-button" type="submit" id="button-addon2"><i class="bi bi-search"></i></button>
                                            </div>
                                        </div>
                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>

            <div class="container">
        <div class="row">
            <div class="col-12">
                <div class="card">
                    <div class="card-header">
                        <h4 class="card-title">PRODUCTS LIST</h4>
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
                    <th style="width: 10%;">SubCategory</th>
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
                    if (mysqli_num_rows($result) > 0)
                    {
                        $i=0;
                    while ($row = mysqli_fetch_array($result))
                    {
                        ?>
    
  
                                        <tr>
                                            <td><?php echo $row['id'] ?></td>
                                            <td><?php echo $row['brand'] ?></td>
                                            <td><?php echo $row['category'] ?></td>
                                            <td><?php echo $row['subcategory'] ?></td>
                                            <td class="truncate"><?php echo $row['product_name'] ?></td>
                                            <td class="truncate"><?php echo $row['product_desc'] ?></td>
                                            <td class="truncaten">
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
                ?></td>
                                            <td class="truncaten">
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
                ?></td>
                                            <td><img src="../uploaded_img/<?php echo $row['image_01'] ?>" class="img-thumbnail" style="max-height: 50px;"></td>
                                            <td><img src="../uploaded_img/<?php echo $row['image_02'] ?>" class="img-thumbnail" style="max-height: 50px;"></td>
                                            <td><img src="../uploaded_img/<?php echo $row['image_03'] ?>" class="img-thumbnail" style="max-height: 50px;"></td>
                                            <td><?php echo $row['Stock'] ?></td> 
                                            <td><?php echo $row['Price'] ?></td>
                                            <td><?php echo $row['Status'] ?></td>
                                        <td>
                                         <button type="button" class="viewProductModalBtn btn btn-info btn-sm" data-toggle="modal" data-target="#veiwModal" data-id="<?php echo $row['id']; ?>">
       <i class="fas fa-eye"></i> VIEW</button>   
                                            
                                            <button type="button" class="editProductBtn btn btn-success btn-sm" data-toggle="modal" data-target="#editModal" data-id="<?php echo $row['id']; ?>"><i class="fas fa-edit"></i> UPDATE</button>

                                             <button type="button" data-toggle="modal" data-target="#delModal" data-id="<?php echo $row['id']; ?>" class="deleteProductBtn btn btn-danger btn-sm"><i class="fas fa-trash-alt"></i> DELETE</button>
                                        </td>
                                    </tr>
                              


    
                               <?php
                               $i++;
                            }
                            }
                            else
                            {
                                echo "No Product Yet!";
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
                echo "<li class='page-item'><a href='admin_products.php?page=".($page-1)."' class='page-link'>Prev </a></li>";
            }
            for ($i=1; $i<=$total_pages; $i++)
            {
                if ($i == $page)
                {
                    $pageLink .="<li class='page-item'><a class='page-link' href='admin_products.php?page=".$i."'>".$i."</a></li>";
                }
                else
                {
                    $pageLink .="<li class='page-item'><a class='page-link' href='admin_products.php?page=".$i."'>".$i."</a></li>";
                }
            };
            echo $pageLink;
            if($page<$total_pages)
            {
                echo "<li class='apage-item'><a href='admin_products.php?page=".($page+1)."' class='page-link'>Next </a></li>";
            }
            ?>
        </ul>
    </nav> 
    
    