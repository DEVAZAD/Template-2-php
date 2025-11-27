<?php
$page_title = "Gallery";
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../assets/headerFooter.css">
    <title><?php echo $page_title; ?></title>
    <style>
        .title {
            text-align: center;
            font-size: 2.5rem;
            margin-bottom: 2rem;
            color: #333;
        }

        .gallery-container {

            margin: 0 auto;
            padding: 0 150px;
        }

        .gallery-grid {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(250px, 1fr));
            gap: 1.5rem;
        }

        .gallery-item {
            border: 2px solid #ddd;
            border-radius: 8px;
            overflow: hidden;
            transition: transform 0.3s, box-shadow 0.3s;
        }

        .gallery-item:hover {
            transform: scale(1.05);
            box-shadow: 0 4px 15px rgba(0, 0, 0, 0.2);
        }

        .gallery-image {
            width: 100%;
            height: auto;
            display: block;
        }
    </style>
</head>

<body>
    <?php include('../includes/header.php'); ?>
    <div class="gallery-container">
        <h1 class="title">Gallery</h1>
        <div class="gallery-grid">
            <div class="gallery-item">
                <img src="/assets/bann1.png" alt="Gallery Image 1" class="gallery-image">
            </div>
            <div class="gallery-item">
                <img src="/assets/money.gif" alt="Gallery Image 2" class="gallery-image">
            </div>
            <div class="gallery-item">
                <img src="/assets/bann1.png" alt="Gallery Image 3" class="gallery-image">
            </div>
            <div class="gallery-item">
                <img src="/assets/im2.jpg" alt="Gallery Image 4" class="gallery-image">
            </div>
            <div class="gallery-item">
                <img src="/assets/bann2.png" alt="Gallery Image 1" class="gallery-image">
            </div>
            <div class="gallery-item">
                <img src="/assets/tree.gif" alt="Gallery Image 2" class="gallery-image">
            </div>
            <div class="gallery-item">
                <img src="/assets/bann1.png" alt="Gallery Image 3" class="gallery-image">
            </div>
            <div class="gallery-item">
                <img src="/assets/slid1.png" alt="Gallery Image 4" class="gallery-image">
            </div>

            <!-- Add more gallery items as needed -->
        </div>
        <?php include('../includes/footer.php'); ?>
</body>

</html>