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
$result = mysqli_query($db, "SELECT * FROM tb_category ORDER BY id ASC LIMIT $start_from, $per_page_record ");

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
                                    <form action="../admin/admincategorysearch.php" method="GET">
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
                        <h4 class="card-title">CATEGORY LIST</h4>
                        <button type="button" class="btn btn-custom" data-bs-toggle="modal" data-bs-target="#productAddModal">
                            <i class="fas fa-plus"></i> ADD CATEGORY
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
                    <th style="width: 5%;">Category</th>
                    <th style="width: 5%;">Action</th>
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
                                            <td><?php echo $row['catename'] ?></td>
                                            
                                        <td>
                                            
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
            $query = "SELECT COUNT(*) FROM tb_category";
            $rs_result = mysqli_query($db, $query);
            $row = mysqli_fetch_row($rs_result);
            $total_records = $row[0];
            echo "<br/>";
            $total_pages = ceil($total_records / $per_page_record);
            $pageLink = "";
            if($page>=2)
            {
                echo "<li class='page-item'><a href='admin_brands.php?page=".($page-1)."' class='page-link'>Prev </a></li>";
            }
            for ($i=1; $i<=$total_pages; $i++)
            {
                if ($i == $page)
                {
                    $pageLink .="<li class='page-item'><a class='page-link' href='admin_brands.php?page=".$i."'>".$i."</a></li>";
                }
                else
                {
                    $pageLink .="<li class='page-item'><a class='page-link' href='admin_brands.php?page=".$i."'>".$i."</a></li>";
                }
            };
            echo $pageLink;
            if($page<$total_pages)
            {
                echo "<li class='apage-item'><a href='admin_brands.php?page=".($page+1)."' class='page-link'>Next </a></li>";
            }
            ?>
        </ul>
    </nav> 
    
      <!-- Add Product -->
    <div class="modal fade" id="productAddModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">ADD PRODUCT</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>

            <div id="alertMessage" class="alert d-none"></div>

              <form method="POST" action="../adminserver/admincategoryserver.php" enctype="multipart/form-data">
                <div class="modal-body">
                    <div id="errorMessage" class="alert alert-warning d-none">All fields are mandatory.</div>
                    <div class="mb-3">
                        <label for="">category name</label>
                        <input type="text" name="category" class="form-control" required>
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
                    <h5 class="modal-title" id="exampleModalLabelu">Category Details</h5>
                    <button type="button" class="btn-close" data-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <div id="item-detailsu"></div>
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
                     url: '../adminserver/updatecategoryfetch.php?id=' + id,
                     type: 'GET',
                     success: function(data)
                     {
                         $('#item-detailsu').html(data);
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
         $(document).ready(function()
         {
             $('button').click(function()
             {
                 var id = $(this).data('id');
                 $.ajax({
                     url: '../adminserver/deletecategoryfetch.php?id=' + id,
                     type: 'GET',
                     success: function(data)
                     {
                         $('#item-detailsd').html(data);
                     }
                 });
             });
         });
     </script>







    
    