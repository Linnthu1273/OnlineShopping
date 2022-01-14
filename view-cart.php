<?php
    session_start();
    if(!isset($_SESSION['cart'])){
        header("location:index.php");
    }
    include("admin/confs/config.php");
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>View_Cart</title>
    <link rel="stylesheet" href="css/style.css">
</head>
<body>
    <h1>View-Cart</h1>
    <div class="view-siderbar">
        <ul>
            <li>
                <a href="index.php">Continue Shopping</a>
                <li><a href="clear-cart.php" class="del">Clear Cart</a></li>
            </li>
        </ul>
    </div>
    <div class="view-main">
        <table>
            <tr>
                <th>Item Name</th>
                <th>Quantity</th>
                <th>Unit Price</th>
                <th>Price</th>
            </tr>
            <?php
                $total=0;
                foreach ($_SESSION['cart'] as $id => $qty) {
                    $res=mysqli_query($conn, "SELECT * FROM items Where id=$id");//to check
                    $row=mysqli_fetch_assoc($res);
                    $total+=$row['price']*$qty;
                
            ?>
            <tr>
                <td><?php echo $row['title']; ?></td>
                <td><?php echo $qty; ?></td>
                <td>$<?php echo $row['price']; ?></td>                
                <td>$<?php echo $row['price']*$qty; ?></td>
            </tr>
            <?php } ?>
            <tr>
                <td colspan="3" align="right"><b>Total:</b></td>
                <td>$<?php echo $total; ?></td>
            </tr>
        </table>
        <div class="order-form">
            <h2>Order Now</h2>
            <form action="submit-order.php" method="post">
                <label for="name">Name</label>
                <input type="text" name="name" id="name">
                <label for="email">Email</label>
                <input type="email" name="email" id="email">
                <label for="phone">Phone No</label>
                <input type="text" name="phone" id="phone">
                <label for="visa">Visa Card</label>
                <input type="text" name="visa" id="visa">
                <label for="address">Address:</label>
                <textarea name="address" id="address" cols="20" rows="5"></textarea>
                <br><br>
                <input type="submit" value="Submit Order">
            </form>
        </div>
    </div>
    <div class="footer">
        &copy;<?php echo date("Y"); ?>. All Right Reserved
    </div>
</body>
</html>