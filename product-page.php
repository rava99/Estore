<style> <?php include 'style.css'; ?> </style>
<?php
require_once "config.php";

// Initialize the session
session_start();
 
// Check if the user is logged in, if not then redirect him to login page
if(!isset($_SESSION["loggedin"]) || $_SESSION["loggedin"] !== true){
    header("location: login.php");
    exit;
}

$buyers_id = $_SESSION["id"];
$product_id = $_GET['id'];

if(isset($_POST['add_to_cart']))
{
     $sql = "INSERT INTO orders (buyers_id, product_id) VALUES ($buyers_id, $product_id)";
 

     if (mysqli_query($link, $sql)) {
        echo "Product added to Shopping cart";
      } else {
        echo "Error: " . $sql . "<br>" . mysqli_error($link);
      }

    // Alternative code for a safer version
    //  $sql = "INSERT INTO order (buyers_id, product_id) VALUES (?, ?)";
         
    //     if($stmt = mysqli_prepare($link, $sql)){
    //         // Bind variables to the prepared statement as parameters
    //         mysqli_stmt_bind_param($stmt, "ss", $buyers_id, $product_id);
            
    //         // Set parameters
    //         $param_buyers_id = $_SESSION["id"];
    //         $param_product_id = $_GET['id'];

            
    //         // Attempt to execute the prepared statement
    //         mysqli_stmt_execute($stmt);
    //     }
    // mysqli_stmt_close($stmt);

}


?>
 
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Product Page</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <style>
        body{ font: 14px sans-serif; text-align: center; }
    </style>
</head>
<body>

<?php require_once "navbar.php"; ?>

<main class="main-area">
        
        <div class="centered">

            <section class="cards">
        <?php
        //Get product id from welcome page
        $id = $_GET['id'];
        $query = mysqli_query($link,"select * from product where id='$id'") or die(mysql_error());;
        //If there is no data then there will be a statement
        if(mysqli_num_rows($query) == 0) {
           echo '<tr style="background-color: #ff4d4d"><td colspan="8"><center>No Data in Database!</center></td></tr>';
           }
           else{
             if($data = mysqli_fetch_array($query)){
                
        ?>
        
               <div class="col d-flex justify-content-center">
                <div class="card" style="width:400px">
                    <img class="card-img-top" src=product-pictures/<?php echo $data['imgSource']; ?> alt="Card image">
                    <div class="card-body">
                    <h4><b><?php echo $data['name']; ?></b></h4>
                    <h5><b><?php echo $data['brand']; ?></b></h5>
                    <h6><b><?php echo $data['price']; ?>kr</b></h6>
                        <form method="post">
                             <input type="submit" onclick="alert('Product added to Shopping cart')" name="add_to_cart" value="Add to cart" class="btn btn-primary"/>
                             <!-- Go to welcome page with all the products -->
                            <input type="button" value="See other products" onclick="location.href = 'welcome.php'"; class="btn btn-primary">
                        </form>
                    </div>
                </div>
                </div>
                
        <?php
            }
            
            }
        ?>
    </div>



    

</body>
</html>

 

