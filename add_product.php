<?php 
require_once("config/db.php");
session_start();
if(!isset($_SESSION['user'])){
    echo "<script>location.href='login.php';</script>";
}
$error = "";
if($_SERVER["REQUEST_METHOD"] == "POST"){
    $query = "INSERT INTO `items`(`item_code`, `category`, `description`, `size`, `color`, `bin_number`) VALUES ('".$_POST['item_code']."', '".$_POST['category']."', '".$_POST['description']."', '".$_POST['size']."', '".$_POST['color']."', '".$_POST['bin_number']."')";
    $result = mysqli_query($connection, $query);
  
    if($result){
      $success = "Product added successfully.";
    }else{
      $error = "Something went wrong, please try again.";
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
        <form action="" method="post" id="add_product_form">
            <h1 class="h3 mb-3 fw-normal">Add Product</h1>
            <div class="form-floating">
                <input type="text" class="form-control" id="item_code" name="item_code" placeholder="n123ABC">
                <label for="item_code">Item Code</label>
            </div>
            <div class="form-floating">
                <input type="text" class="form-control" id="category" name="category" placeholder="Tents">
                <label for="category">Category</label>
            </div>
            <div class="form-floating">
                <input type="text" class="form-control" id="description" name="description" placeholder="Nylon material, etc...">
                <label for="description">Description</label>
            </div>
            <div class="form-floating">
                <input type="text" class="form-control" id="size" name="size" placeholder="eg. 34x54">
                <label for="size">Size</label>
            </div>
            <div class="form-floating">
                <input type="text" class="form-control" id="color" name="color" placeholder="Blue, green...">
                <label for="color">Colour</label>
            </div>
            <div class="form-floating">
                <input type="text" class="form-control" id="bin_number" name="bin_number" placeholder="123456">
                <label for="bin_number">Bin Number</label>
            </div>

            <div class="checkbox mb-3">
                <label>
                    <a href="<?php echo $base_url; ?>/index.php"><small>View All Products</small></a>
                </label>
            </div>
            <button class="w-100 btn btn-lg btn-primary" type="submit">Add New Product</button>
            <p class="mt-5 mb-3 text-muted">© 2021</p>
        </form>
    </div>
</section>
<script>
    $('#add_product_form').on('submit', function(e){
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