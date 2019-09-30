<?php
// Process delete operation after confirmation
if(isset($_POST["id"]) && !empty($_POST["id"])){
    // Include config file
    require_once "config.php";

    try
    {

        $id = $_POST['id'];
        // Prepare a delete statement
        $sql = "DELETE FROM items WHERE id = '$id'";

        $item_color_relation = "DELETE FROM color_item_relation where item_id = '$id'";
        $item__item_type_relation = "DELETE FROM item_item_type_relation where item_id = '$id'";
        $item_picture_size_relation = "DELETE FROM  item_picture_size_relation where item_id = '$id'";
        $item_type_relation = "DELETE FROM item_type_relation where item_id = '$id'";
        $item_size_relation = "DELETE FROM item_size_relation where item_id = '$id'";

        pg_query($link, $item_color_relation);
        pg_query($link, $item__item_type_relation);
        pg_query($link, $item_picture_size_relation);
        pg_query($link, $item_type_relation);
        pg_query($link, $item_size_relation);
        pg_query($link, $sql);

        header("location: index.php");

    }
    catch(Exception $e)
    {
        echo $e;
    }




} else{
    // Check existence of id parameter
    if(empty(trim($_GET["id"]))){
        // URL doesn't contain id parameter. Redirect to error page
        header("location: error.php");
        exit();
    }
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>View Record</title>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.css">
    <style type="text/css">
        .wrapper{
            width: 500px;
            margin: 0 auto;
        }
    </style>
</head>
<body>
<div class="wrapper">
    <div class="container-fluid">
        <div class="row">
            <div class="col-md-12">
                <div class="page-header">
                    <h1>Delete Record</h1>
                </div>
                <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="post">
                    <div class="alert alert-danger fade in">
                        <input type="hidden" name="id" value="<?php echo trim($_GET["id"]); ?>"/>
                        <p>Are you sure you want to delete this record?</p><br>
                        <p>
                            <input type="submit" value="Yes" class="btn btn-danger">
                            <a href="index.php" class="btn btn-default">No</a>
                        </p>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
</body>
</html>