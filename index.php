<?php 
require_once("config/db.php");
session_start();
if(!isset($_SESSION['user'])){
    $_SESSION['guest'] = true;
}
// Get all products
$error = "";
$query = "SELECT * FROM `items`";
$result = mysqli_query($connection, $query);
if($result->num_rows < 0){
    $error = "Could Not fetch products.";
}
?>
<?php require_once("header.php"); ?>
<section>
    <div class="container card rounded bg-white shadow-sm my-4 p-4">
        <?php if(!empty($error)){ ?>
            <div class="alert alert-danger"><?php echo $error; ?></div>
        <?php } ?>
        <h3>All Products</h3>
        <table class="table table-striped table-hover"> 
            <tr>
                <th>ID</th>
                <th>Item Code</th>
                <th>Category</th>
                <th>Description</th>
                <th>Size</th>
                <th>Colour</th>
                <th>Bin Number</th>
                <?php if(isset($_SESSION['user'])){ ?>
                    <th>Action</th>
                <?php } ?>
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
                <td>
                <?php if(isset($_SESSION['user']) && $_SESSION['user']['admin'] == 1){ ?>
                    <a class="btn btn-primary mx-1" href="edit_product.php?id=<?php echo $all_products['id']; ?>">Edit</a>
                <?php } ?> 
                <?php if(isset($_SESSION['user'])){ ?>
                    <a class="btn btn-secondary" href="order_product.php?id=<?php echo $all_products['id']; ?>">Order Now</a></td>
                <?php } ?>
                    </td>
            </tr>
            <?php }} ?>
        </table>
    </div>
</section>
<?php require_once("footer.php"); ?>