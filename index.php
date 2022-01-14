<?php
session_start();
    include("admin/confs/config.php");
    $cart=0;
    if(isset($_SESSION['cart'])){
        foreach ($_SESSION['cart'] as $qty) {
            $cart+=$qty;
        }
    }

    $cats=mysqli_query($conn,"SELECT * FROM categories");
    if(isset($_GET['cat'])){
        $cat_id=$_GET['cat'];
        $items=mysqli_query($conn, "SELECT * FROM items WHERE category_id='$cat_id'");
    }
    else{
        $items=mysqli_query($conn, "SELECT * FROM items");
    }
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Shopping</title>
    <link rel="stylesheet" href="css/style.css">
</head>
<body>
    <h1>Shopping</h1>
    <div class="sidebar">
        <ul class="cats">
            <li>
                <a href="index.php">All Items</a>
            </li>
            
                <?php while($row=mysqli_fetch_assoc($cats)) {?>
            <li>  
                <a href="index.php?cat=<?php echo $row['id']; ?>">  
                <?php echo $row['name']; ?>   
                </a> 
            </li>
            <?php } ?>
        </ul>
    </div>
    <div class="main">
            <ul class="items">
                <?php while($item_row=mysqli_fetch_assoc($items)) { ?>
                    <li>
                        <?php !is_dir("admin/images/{$item_row['photo']}") and file_exists("admin/images/{$item_row['photo']}")?>
                        <img src="admin/images/<?php echo $item_row['photo'];?>" alt="img">
                        <b>
                            <a href="item-detail.php?id=<?php echo $item_row['id'] ?>" class="item-detail"><?php echo $item_row['title']; ?></a>
                        </b>
                        <i><?php echo $item_row['brand']; ?></i>
                        <em><?php echo $item_row['price']; ?></em>
                        <a href="add-to-cart.php?id=<?php echo $item_row['id']; ?>" class="add-to-cart">Add to cart</a>
                    </li>
                    <?php } ?>
            </ul>
    </div>
    <div class="info">
        <a href="view-cart.php">
            (<?php echo $cart; ?>) items in your cart
        </a>
    </div>
    <div class="footer">
                    &copy; .All Deserved <?php echo date("Y"); ?>
    </div>
</body>
</html>