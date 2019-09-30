<?php
// Include config file
require_once "config.php";

// Define variables and initialize with empty values
$type = $itemType = $color = $shirtSize = $pictureSize = $price = '';

// Processing form data when form is submitted
if($_SERVER["REQUEST_METHOD"] == "POST"){

    try
    {
        $getId = "SELECT max(id) as id from items";
        $result = pg_query($link, $getId);
        $data = pg_fetch_array($result);
        $id_temp = (int)$data['id'];

        $item_id = ++$id_temp;

        $type = (int)$_POST['type'];
        $itemType = (int)$_POST['itemType'];
        $color = (int)$_POST['color'];
        $shirtSize = (int)$_POST['shirtSize'];
        $pictureSize = (int)$_POST['picSize'];
        $price = (int)$_POST['price'];

        $insert_item = "INSERT INTO items(id, price) values ('$item_id', '$price')";

        $item_color_relation = "INSERT INTO color_item_relation(item_id, color_id) VALUES ('$item_id', '$color')";
        $item__item_type_relation = "INSERT INTO item_item_type_relation(item_id, item_type_id) VALUES ('$item_id', '$itemType')";
        $item_picture_size_relation = "INSERT INTO item_picture_size_relation(item_id, picture_size_id) VALUES ('$item_id', '$pictureSize')";
        $item_type_relation = "INSERT INTO item_type_relation(item_id, type_id) VALUES ('$item_id', '$type')";
        $item_size_relation = "INSERT INTO item_size_relation(item_id, size_id) VALUES ('$item_id', '$shirtSize')";

        pg_query($link, $insert_item);
        pg_query($link, $item_color_relation);
        pg_query($link, $item__item_type_relation);
        pg_query($link, $item_type_relation);

        if($shirtSize != 0)
            pg_query($link, $item_size_relation);
        if($pictureSize != 0)
            pg_query($link, $item_picture_size_relation);

        header("location: index.php");
        exit();
    }
    catch(Exception $e)
    {
        echo  $e;
    }



}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Create Record</title>
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
                    <h2>Create Record</h2>
                </div>
                <p>Item Data</p>
                <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="post">
                    <div class="form-group">
                        <label for="type">Type</label>
                        <select name="type">
                            <option value='1'>Shirt</option>
                            <option value='2'>Polo</option>
                            <option value='3'>Hoodie</option>
                            <option value='4'>Cap</option>
                            <option value='5'>Tote Bag</option>
                        </select>
                    </div>
                    <div class="form-group">
                        <label for="itemType">Item Type</label>
                        <select name="itemType">
                            <option value='1'>Combeds 30s</option>
                            <option value='2'>Combeds 20s</option>
                            <option value='3'>Polo</option>
                            <option value='4'>Hoodie no Zipper</option>
                            <option value='5'>Hoodie with Zipper</option>
                            <option value='6'>Without Picture</option>
                            <option value='5'>With Picture</option>
                        </select>
                    </div>

                    <div class="form-group">
                        <label for="color">Color</label>
                        <select name="color">
                            <option value='1'>White</option>
                            <option value='2'>Color without White Ink</option>
                            <option value='3'>Black and Color with White Ink</option>
                            <option value='4'>Black</option>
                        </select>
                    </div>

                    <div class="form-group">
                        <label for="shirtSize">Shirt Size</label>
                        <select name="shirtSize">
                            <option value='0'>N/A</option>
                            <option value='1'>XS</option>
                            <option value='2'>S</option>
                            <option value='3'>M</option>
                            <option value='4'>L</option>
                            <option value='5'>XL</option>
                            <option value='6'>XXL</option>
                            <option value='7'>XXXL</option>
                            <option value='8'>XXXXL</option>
                        </select>
                    </div>

                    <div class="form-group">
                        <label for="picSize">Picture Size</label>
                        <select name="picSize">
                            <option value='0'>No Picture</option>
                            <option value='1'>A4</option>
                            <option value='2'>A3</option>
                        </select>
                    </div>
                    <div class="form-group">
                        <label for="price">Price</label>
                        <input name="price" type="text">
                    </div>
                    <input type="submit" class="btn btn-primary" value="Submit">
                    <a href="index.php" class="btn btn-default">Cancel</a>
                </form>
            </div>
        </div>
    </div>
</div>
</body>
</html>
