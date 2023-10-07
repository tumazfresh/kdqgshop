<div class="container text-center">
  <div class="row row-cols-1 row-cols-sm-1 row-cols-md-1">
    <div class="col">PRODUCT VIEW</div>
    <div class="col">
    
    <div class="container text-center">
  <div class="row row-cols-1 row-cols-sm-2 row-cols-md-4">
    <div class="col">Column</div>
    <div class="col">Column</div>
    <div class="col">Column</div>
    <div class="col">Column</div>
  </div>
</div>

</div>
    <div class="col">Column</div>
    <div class="col">Column</div>
  </div>
</div>

<!--Relate products--> 
<div class="container text-center">
  <div class="row row-cols-1 row-cols-sm-1 row-cols-md-1">
    <div class="col">
      <br/><br/><br/>
<h1>RELATED PRODUCTS</h1></div>
    <div class="col"><div class="container-spec">

<div class="review_slider-container">
    <div class="review_slider-brand">
        <div class="review_slide-track">
            <?php
            $slider = mysqli_query($db, "SELECT * FROM tb_product ORDER BY RAND() LIMIT 15");
            if (mysqli_num_rows($slider) > 0)
            {
              $i=0;
              while($prds = mysqli_fetch_array($slider))
              {
                  ?>
                   <div class="review_slide-brand">
                       <a href="product_view.php?pid=<?php echo $prds['id']; ?>">
               <?php echo "<img src='./uploaded_img/".$prds['image_01']."' width='100%'/>";?></a>
            </div>
            <?php
            $i++;
                  
              }
            }
            else
            {
                echo "No product yet";
            }
            ?>  
        </div>

    </div>
</div>

</div></div>

  </div>
</div>

<!--Specifications-->
<div class="container text-start table-responsive">
  <div class="row row-cols-1 row-cols-sm-1 row-cols-md-1">
    <div class="col">
      <br/><br/><br/>
<h1>SPECIFICATIONS</h1></div>
    <div class="col"> 	 

        <table class="table table-bordered table-hover table-striped"> 

  <tbody>
    <tr>
      <th scope="row">Product Name</th>
      <td><?php echo $row['product_name']; ?></td> 
    </tr>
    <tr>
      <th scope="row">Product Color</th>
      <td><?php echo $row['color']; ?></td> 
    </tr>
    <tr>
      <th scope="row">Product Memory</th> 
      <td><?php echo $row['memory']; ?></td>
    </tr>
    <tr>
      <th scope="row">Product Price</th> 
      <td><?php echo $row['Price']; ?></td>
    </tr>
    <tr>
      <th scope="row">Product Brand</th> 
      <td><?php echo $row['brand']; ?></td>
    </tr>
    <tr>
      <th scope="row">Product Category</th> 
      <td><?php echo $row['category']; ?></td>
    </tr>
    <tr>
      <th scope="row">Product Description</th> 
      <td><?php echo $row['product_desc']; ?></td>
    </tr>
  </tbody>
</table> 

</div> 
  </div>
</div>



<!--Ratings-->

      <br/><br/><br/>
<h1>PRODUCT RATING</h1>
<div class="container text-center">
  <div class="row row-cols-1 row-cols-sm-1 row-cols-md-1">
    <div class="col">
        
        
 <div class="container">
    	<h1 class="mt-5 mb-5">PRODUCT RATINGS</h1>
    	<div class="card">
    		<div class="card-header">Reviews</div>
    		<div class="card-body">
    			<div class="row">
    				<div class="col-sm-4 text-center">
    					<h1 class="text-warning mt-4 mb-4">
    					    <?php
    					    
	    				$pid = $row['id'];
    					    $revsql ="SELECT SUM(rating) AS total FROM tb_feedback WHERE pid=$pid";
    					    $allrev = $db->query($revsql);
    					   
	    				$totalreview = "SELECT count(*) FROM tb_feedback WHERE pid=$pid";
	    				$resultreview = $db->query($totalreview);
	    				while($rev = mysqli_fetch_array($resultreview))
	    				{
	    				     if($allrev->num_rows > 0)
    					    {
    					        $tarev = $allrev->fetch_assoc();
    					        
	    				    	    $calt = $rev['count(*)'];
	    				    	    $recalt = $tarev['total'];
	    				    	    if($calt == 0)
	    				    	    {
	    				    	    $newcall = 0;
	    				    	    }
	    				    	    else
	    				    	    {
	    				    	        
	    				    	    $newcal = $recalt / $calt;
	    				    	    $newcall = number_format($newcal, 1);
	    				    	    }?>
    					       <b><span><?php echo $newcall;  ?></span> / 5</b>
    					</h1>
    					
    					
    					<div class="mb-3">
    					    <?php
    					    $newca = $newcall;
    					    if($newca == 5)
    					    { ?>
    					        <i class="fas fa-star star-light mr-1 main_star"></i>
                            <i class="fas fa-star star-light mr-1 main_star"></i>
                            <i class="fas fa-star star-light mr-1 main_star"></i>
                            <i class="fas fa-star star-light mr-1 main_star"></i>
                            <i class="fas fa-star star-light mr-1 main_star"></i>
                            <?php
    					    }
    					    else if($newca >= 4)
    					    {
    					       ?>
    					       <i class="fas fa-star star-light mr-1 main_star"></i>
                            <i class="fas fa-star star-light mr-1 main_star"></i>
                            <i class="fas fa-star star-light mr-1 main_star"></i>
                            <i class="fas fa-star star-light mr-1 main_star"></i>
    					    <?php
    					        
    					    }
    					    else if($newca >= 3)
    					    {
    					       ?>
    					       <i class="fas fa-star star-light mr-1 main_star"></i>
                            <i class="fas fa-star star-light mr-1 main_star"></i>
                            <i class="fas fa-star star-light mr-1 main_star"></i> 
    					    <?php
    					        
    					    } 
    					    else if($newca >= 2)
    					    {
    					       ?>
    					       <i class="fas fa-star star-light mr-1 main_star"></i>
                            <i class="fas fa-star star-light mr-1 main_star"></i> 
    					    <?php
    					        
    					    } 
    					     else if($newca >= 1)
    					    {
    					       ?>
    					       <i class="fas fa-star star-light mr-1 main_star"></i> 
    					    <?php
    					        
    					    }
    					     else if($newca <= 1)
    					    {
    					       ?>
    					       <i class="fas fa-star-half-alt star-light"></i>
    					    <?php
    					    }
    					        else if($newca == 0)
    					        { 
    					        ?>
    					         <i class="fas fa-star star-light mr-1 main_star"></i> 
    					           <?php  
    					    }
    					    else
    					    {
    					        echo "No Rating";
    					    }
    					    ?>
    					    
	    				</div>
    					<h3><span id="total_review"><?php echo $rev['count(*)']; ?></span> Review</h3>
	    				    
    				</div>
    				<style>
    				.pc
    				{
    				width:100%;
    				background-color:#f0f0f0;
    				margin-bottom:10px;

    				}
    				.pb
    				{
    				width:0;
    				height:30px;
    				text-align:center;
    				line-height:30px;
    				color:#ffffff;
    				}
    				</style>
    				<div class="col-sm-4">
    				    <?php
    				    function reviewcount($dba, $rating){
    				        global $pid;
    				    $pralrating = "SELECT rating, COUNT(*) as count FROM tb_feedback WHERE pid=$pid AND rating=$rating";
    				    $rres = $dba->query($pralrating);
    				    if($rres->num_rows > 0)
    				    {
    				        $rowr = $rres->fetch_assoc();
    				        return $rowr["count"];
    				        
    				    }
    				    else
    				    {
    				        return 0;
    				    }
    					    }
    					 
    					  $ttrt = 0;
    					    for($rg =5; $rg>=1; $rg--)
    					    {
    					        $ct = reviewcount($dba, $rg);
    					        ?>
    					        	<p>
                            <div class="progress-label-left"><b><?php echo $rg ?></b>
                            <?php
                            for ($i =0; $i < $rg; $i++)
                            { ?>
                             <i class="fas fa-star text-warning"></i> 
                             <?php
                            }
                            if($ct > 0)
                            {
                                $ttrt += $ct;
                            }
                            
                            $prw = ($ttrt > 0) ? (100 / $ttrt) : 0;
                            ?>
                              <div class="progress-label-right">(<span id="total_five_star_review"><?php echo $ct ?></span>)</div>
                          <div class="progress"> 
  <div class="progress-bar bg-warning" role="progressbar" aria-label="Segment three" style="width:<?php echo $prw ?>%" aria-valuenow="<?php echo $prw ?>" aria-valuemin="0" aria-valuemax="100"></div>
</div>
                        </p> 
                        <?php
    					    }
    					    ?>
    					    
    				</div>
    			</div>
    		</div>
    	</div>
    	<div class="mt-5" id="review_content"></div>
    </div>


    					
    					<?php
    					    }
    					    else
    					    {
    					        echo "No review";
    					    }
	    				}
	    				?>
    				</div>
    				</div>


            
</div><!--endcontainer-->
</div><!--end edit-->

    </div>
    <div class="col">Column</div>
    <div class="col">Column</div>
    <div class="col">Column</div>
  </div>
</div>