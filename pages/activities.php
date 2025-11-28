<?php
$page_title = "Activities";
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../assets/headerFooter.css">
    <title><?php echo $page_title; ?></title>
    <style>
        .section-title {
            text-align: center;
            margin-top: 50px;
            font-size: 24px;
            color: #333;
        }

        .container {
            margin: 0 auto;
            padding: 0 150px;
        }

        p {
            text-align: center;
            font-size: 18px;
            color: #666;
            line-height: 20px;
        }
    </style>
</head>

<body>
    <?php include('../includes/header.php'); ?>
    <div class="container">
        <a href="/" class="btn">Back to Home</a>

        <h1 class="section-title">Your Activies will show up here</h1>
        <p>Lorem ipsum dolor, sit amet consectetur adipisicing elit. Quod iure numquam voluptate similique quos dignissimos accusamus. Sapiente dolorem, vel libero perspiciatis amet assumenda repellendus est.</p>
        <p></p>
    </div>
    <?php include('../includes/footer.php'); ?>
</body>

</html>