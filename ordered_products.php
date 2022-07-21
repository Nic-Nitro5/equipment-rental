<?php 
require_once("config/db.php");
session_start();

if(!isset($_SESSION['user'])){
    echo "<script>location.href='login.php';</script>";
}

// Get all products
$error = "";
$query = "SELECT * FROM `items` LEFT JOIN ordered_items ON items.id = ordered_items.item_id WHERE ordered_items.user_id = ".$_SESSION['user']['id'];
$result = mysqli_query($connection, $query);
if($result->num_rows < 0){
    $error = "Could Not fetch products.";
}
?>
<?php require_once("header.php"); ?>
<section>
    <div class="container card rounded bg-white shadow-sm my-4 p-4">
        <div class="alert alert-success">Welcome <?php echo $_SESSION['user']['username']; ?></div>
        <?php if(!empty($error)){ ?>
            <div class="alert alert-danger"><?php echo $error; ?></div>
        <?php } ?>
        <h3>Ordered Products</h3>
        <table class="table table-striped table-hover"> 
            <tr>
                <th>ID</th>
                <th>Item Code</th>
                <th>Category</th>
                <th>Description</th>
                <th>Size</th>
                <th>Colour</th>
                <th>Bin Number</th>
            </tr>
            <?php 
                if($result->num_rows > 0){
                    while($all_products = mysqli_fetch_array($result)){
            ?>
            <tr>
                <td><?php echo $all_products['id']; ?></td>
                <td><?php echo $all_products['item_code']; ?></td>
                <td><?php echo $all_products['category']; ?></td>
                <td><?php echo $all_products['description']; ?></td>
                <td><?php echo $all_products['size']; ?></td>
                <td><?php echo $all_products['color']; ?></td>
                <td><?php echo $all_products['bin_number']; ?></td>
            </tr>
            <?php }} ?>
        </table>
    </div>
</section>
<?php require_once("footer.php"); ?>