<?php
include 'dbconn.php';

if (isset($_SESSION['user_id'])) {
  $user_id = $_SESSION['user_id'];
} else {
  $user_id = '';
  
}

if (isset($_POST["rating_data"])) {
  $order_id = $_POST["order_id"];
  $pid = $_POST["pid"];
  $user_id = $_POST["user_id"];
  $name = $_POST["name"];
  $rating = $_POST["rating_data"];
  $review = $_POST["review"];

  $query = "INSERT INTO tb_feedback (order_id, pid, user_id, name, rating, review, date) 
            VALUES (:order_id, :pid, :user_id, :name, :rating, :review, CURRENT_TIMESTAMP)";

  $statement = $conn->prepare($query);

  $statement->bindParam(':order_id', $order_id, PDO::PARAM_INT);
  $statement->bindParam(':pid', $pid, PDO::PARAM_INT);
  $statement->bindParam(':user_id', $user_id, PDO::PARAM_INT);
  $statement->bindParam(':name', $name, PDO::PARAM_STR);
  $statement->bindParam(':rating', $rating, PDO::PARAM_INT);
  $statement->bindParam(':review', $review, PDO::PARAM_STR);

  if ($statement->execute()) {
    echo "Your Review & Rating Successfully Submitted";
  } else {
    echo "Error: Unable to submit your review and rating.";
  }
}

if(isset($_POST["action"]))
{
	$average_rating = 0;
	$total_review = 0;
	$five_star_review = 0;
	$four_star_review = 0;
	$three_star_review = 0;
	$two_star_review = 0;
	$one_star_review = 0;
	$total_user_rating = 0;
	$review_content = array();

	$query = "
	SELECT * FROM tb_feedback
	ORDER BY id DESC
	";

	$result = $conn->query($query, PDO::FETCH_ASSOC);

	foreach($result as $row)
	{
		$review_content[] = array(
			'user_name'		=>	$row["name"],
			'user_review'	=>	$row["review"],
			'rating'		=>	$row["rating"],
			'datetime'		=>	date('l jS, F Y h:i:s A', $row["date"])
		);

		if($row["user_rating"] == '5')
		{
			$five_star_review++;
		}

		if($row["user_rating"] == '4')
		{
			$four_star_review++;
		}

		if($row["user_rating"] == '3')
		{
			$three_star_review++;
		}

		if($row["user_rating"] == '2')
		{
			$two_star_review++;
		}

		if($row["user_rating"] == '1')
		{
			$one_star_review++;
		}

		$total_review++;

		$total_user_rating = $total_user_rating + $row["rating"];

	}

	$average_rating = $total_user_rating / $total_review;

	$output = array(
		'average_rating'	=>	number_format($average_rating, 1),
		'total_review'		=>	$total_review,
		'five_star_review'	=>	$five_star_review,
		'four_star_review'	=>	$four_star_review,
		'three_star_review'	=>	$three_star_review,
		'two_star_review'	=>	$two_star_review,
		'one_star_review'	=>	$one_star_review,
		'review_data'		=>	$review_content
	);

	echo json_encode($output);

}

?>
