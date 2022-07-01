<?php

session_start();

$connect = mysqli_connect("localhost","root","","webshop_projekat");

if (isset($_POST['add_to_cart'])) {
    if (isset($_SESSION['cart'])) {
        $session_array_id = array_column($_SESSION['cart'], "id");

        if (!in_array($_GET['id'], $session_array_id)) {
            $session_array = array(
                'id' => $_GET['id'],
                "name" => $_POST['name'],
                "price" => $_POST['price'],
                "quantity" => $_POST['quantity']
            );
    
            $_SESSION['cart'][] = $session_array;
        }
    }else{
        $session_array = array(
            'id' => $_GET['id'],
            "name" => $_POST['name'],
            "price" => $_POST['price'],
            "quantity" => $_POST['quantity']
        );

        $_SESSION['cart'][] = $session_array;
    }
}

?>

<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="UTF-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <link rel="stylesheet" type="text/css" href="shoppingcart.css">
        <title>Shopping Cart</title>
    </head>
    <body>  
        <header>
            <h2> <a href="#" class="logo">Plant Sitting</a></h2>
            <div class="navigation">
                <a href="welcome.php">Home</a>
                <a href="about.php">About</a>
                <a href="contact.php">Contact</a>
                <a href="shoppingcart.php">Shopping</a>
                <a href="logout.php">LogOut</a>
            </div>
        </header>  

        <div class="container">
            <div class="levi-deo">
                 
                <?php

                $query = "SELECT * FROM cart_items";
                $result = mysqli_query($connect,$query);

                while ($row = mysqli_fetch_array($result)) {?>

                    <div class="element">
                        
                        <form method="post" action="shoppingcart.php?id=<?=$row['id'] ?>">
                            <img src="img/<?= $row['image'] ?>" style='height: 150px;'>
                            <h5 class="text-center"><?= $row['name']; ?></h5>
                            <h5 class="text-center"><?= number_format($row['price'],2); ?>din.</h5>
                            <input type="hidden" name="name" value="<?= $row['name'] ?>">   
                            <input type="hidden" name="price" value="<?= $row['price'] ?>">
                            <input type="number" name="quantity" value="1" class="form-control">
                            <input type="submit" name="add_to_cart" class="btn btn-warning btn-block my-2" value="Add To Cart">
                        </form>
                    </div>
                

                <?php }
                ?>
            </div>
            <div class="tabela">
                <h2 class="text-center">Shopping Cart</h2>
                <table>
                <?php
                $total = 0;

                $output = "";

                $output .= "
                
                    <tr>
                        <th>ID</th>
                        <th>Item Name</th>
                        <th>Item Price</th>
                        <th>Item Quantity</th>
                        <th>Total Price</th>
                        <th>Action</th>
                    </tr>
                ";

                if (!empty($_SESSION['cart'])) {

                    foreach ($_SESSION['cart'] as $key => $value) {

                        $output .= "
                        <tr>
                            <td>".$value['id']."</td>
                            <td>".$value['name']."</td>
                            <td>".$value['price']."</td>
                            <td>".$value['quantity']."</td>
                            <td>".number_format($value['price'] * $value['quantity'],2)."</td>
                            <td>
                                <a href='shoppingcart.php?action=remove&id=".$value['id']."'>
                                    <button class='btn'>Remove</button>
                                </a>
                            </td>
                        
                        </tr>
                        ";
                        $total = $total + $value['quantity'] * $value['price'];
                    }

                    $output .= "
                        <tr>
                            <td colspan='3'></td>
                            <td><b>Total Price</b></td>
                            <td>".number_format($total,2)."</td>
                            <td>
                                <a href='shoppingcart.php?action=clearall'>
                                    <button class='btn'>Clear</button>
                                </a>
                            </td>
                        </tr>
                    ";
                }
                

                echo $output;
                    
                ?>
                
                <?php
                if (isset($_GET['action'])) {

                    if ($_GET['action'] == "clearall") {
                        unset($_SESSION['cart']);
                    }

                    if ($_GET['action'] == "remove") {

                        foreach ($_SESSION['cart'] as $key => $value) {
                            if ($value['id'] == $_GET['id']) {
                                unset($_SESSION['cart'][$key]);
                            }
                        }
                    }
                }
                ?>
                </table>
            </div>
        </div>
    </body>
    <footer>
        <div class="footer_content">
            <h3>Plant Sitting</h3>
            <p>Lorem Ipsum is simply dummy text of the printing and typesetting industry.</p>
        </div>
        <div class="footer_bottom">
            <p>copyright &copy;2022 PlantSitting. designed by <span>Stevan Zakula</span></p>
        </div>
    </footer>
    
    
</html>


