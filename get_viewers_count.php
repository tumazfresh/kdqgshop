<?php

$viewersCount = rand(1, 15);

// Return the viewers count as JSON
echo json_encode(['viewersCount' => $viewersCount]);
?>
