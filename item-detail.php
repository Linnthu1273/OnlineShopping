<?php
    include("admin/confs/config.php");
    $id=$_GET['id'];
    $item=mysqli_query($conn, "SELECT * FROM items WHERE id=$id");
    $row=mysqli_fetch_assoc($item);
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Item Detail</title>
    <link rel="stylesheet" href="css/style.css">
</head>
<body>
    <h1>Item Detail</h1>
    <div class="detail">
        <a href="index.php" class="back">Go Back</a>
        <img src="admin/images/<?php echo $row['photo']; ?>" alt="">
        <h2><?php echo $row['title']; ?></h2>
        <i>by <?php echo $row['brand']; ?></i>
        <b>$ <?php echo $row['price']; ?></b>
        <p><?php echo $row['review']; ?></p>
        <a href="add-to-cart.php?id=<?php echo $row['id']; ?>" class="add-to-cart">Add to Cart</a>
    </div>
    <div class="footer">
        &copy; .All Right Reserved <?php echo date('Y'); ?>
    </div>
</body>
</html>