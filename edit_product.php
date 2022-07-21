<?php 
require_once("config/db.php");
session_start();
if(!isset($_SESSION['user'])){
    echo "<script>location.href='login.php';</script>";
}
$error = "";
if($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['item_code'])){
    $query = "UPDATE `items` SET item_code = '".$_POST['item_code']."', category = '".$_POST['category']."', description = '".$_POST['description']."', size = '".$_POST['size']."', color = '".$_POST['color']."', bin_number = '".$_POST['bin_number']."' WHERE id = ". $_REQUEST['id'];
    $result = mysqli_query($connection, $query);
  
    if($result){
      $success = "Product updated successfully.";
    }else{
      $error = "Something went wrong, please try again.";
    }
}

// get product details
$query_product = "SELECT * FROM `items` WHERE id = " . $_REQUEST['id'];
$product_result = mysqli_query($connection, $query_product);
if($product_result->num_rows < 0){
    $error = "Could Not fetch products.";
}

// Delete product
if($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['delete_product'])){
    $delete_query = "DELETE FROM items WHERE id = ".$_REQUEST['id'];
    $delete_result = mysqli_query($connection, $delete_query);

    if($delete_result){
        $success = "Product deleted successfully.";
        echo "<script>setTimeout(function(){location.href='".$base_url."/index.php';}, 3000);</script>";
    }else{
        $error = "Could Not delete product.";
    }
}
?>
<?php require_once("header.php"); ?>
<section class="text-center">
    <div class="container card rounded shadow-sm my-4 p-4">
        <?php if(!empty($error)){ ?>
            <div class="alert alert-danger"><?php echo $error; ?></div>
        <?php } ?>
        <?php if(!empty($success)){ ?>
            <div class="alert alert-success"><?php echo $success; ?></div>
        <?php } ?>
        <p class="validation_errors d-none text-danger fw-bold"></p>
        <?php 
            if($product_result->num_rows > 0){
                while($product_info = mysqli_fetch_array($product_result)){
        ?>
        <!-- delete product button -->
        <div>
            <form action="" method="post" id="delete_product_form">
                <button class="btn btn-danger float-end" name="delete_product" type="submit">Delete this product</button>
            </form>
        </div>
        <form action="" method="post" id="update_product_form">
            <h1 class="h3 mb-3 fw-normal">Update Product</h1>
            <div class="form-floating">
                <input type="text" class="form-control" id="item_code" name="item_code" value="<?php echo $product_info['item_code'] ?>">
                <label for="item_code">Item Code</label>
            </div>
            <div class="form-floating">
                <input type="text" class="form-control" id="category" name="category" value="<?php echo $product_info['category'] ?>">
                <label for="category">Category</label>
            </div>
            <div class="form-floating">
                <input type="text" class="form-control" id="description" name="description" value="<?php echo $product_info['description'] ?>">
                <label for="description">Description</label>
            </div>
            <div class="form-floating">
                <input type="text" class="form-control" id="size" name="size" value="<?php echo $product_info['size'] ?>">
                <label for="size">Size</label>
            </div>
            <div class="form-floating">
                <input type="text" class="form-control" id="color" name="color" value="<?php echo $product_info['color'] ?>">
                <label for="color">Colour</label>
            </div>
            <div class="form-floating">
                <input type="text" class="form-control" id="bin_number" name="bin_number" value="<?php echo $product_info['bin_number'] ?>">
                <label for="bin_number">Bin Number</label>
            </div>
            <?php }} ?>
            <div class="checkbox mb-3">
                <label>
                    <a href="<?php echo $base_url; ?>/index.php"><small>View All Products</small></a>
                </label>
            </div>
            <button class="w-100 btn btn-lg btn-primary" type="submit">Update Product</button>
            <p class="mt-5 mb-3 text-muted">© 2021</p>
        </form>
    </div>
</section>
<script>
    $('#update_product_form').on('submit', function(e){
        var item_code = $('input[name="item_code"]').val().trim();
        var category = $('input[name="category"]').val().trim();
        var description = $('input[name="description"]').val().trim();
        var size = $('input[name="size"]').val().trim();
        var color = $('input[name="color"]').val().trim();
        var bin_number = $('input[name="bin_number"]').val().trim();

        $('.validation_errors').text('');

        if(item_code.length <= 0){
            e.preventDefault();
            hideShowValidation();
            $('.validation_errors').text('Item code is required');
            return;
        }

        if(category.length <= 0){
            e.preventDefault();
            hideShowValidation();
            $('.validation_errors').text('Category is required');
            return;
        }

        if(description.length <= 0){
            e.preventDefault();
            hideShowValidation();
            $('.validation_errors').text('Description is required');
            return;
        }

        if(size.length <= 0){
            e.preventDefault();
            hideShowValidation();
            $('.validation_errors').text('Size is required');
            return;
        }

        if(color.length <= 0){
            e.preventDefault();
            hideShowValidation();
            $('.validation_errors').text('Colour is required');
            return;
        }

        if(bin_number.length <= 0){
            e.preventDefault();
            hideShowValidation();
            $('.validation_errors').text('Bin number is required');
            return;
        }
    });

    function hideShowValidation(){
        if($('.validation_errors').hasClass('d-none')){
            $('.validation_errors').removeClass('d-none');
            $('.validation_errors').addClass('d-block');
        }else{
            $('.validation_errors').addClass('d-none');
        }
    }
</script>
<?php require_once("footer.php"); ?>