<?php

require_once "config.php";

// Processing form data when form is submitted
if(isset($_POST["id"]) && !empty($_POST["id"])){

    try
    {
        $id = $_POST["id"];
        $price = $_POST['price'];
        $query = "UPDATE items set price = '$price' where id = '$id'";
        echo  $query;
        pg_query($link, $query);
        header("location: index.php");
    }
    catch(Exception $e)
    {
        echo $e;
    }





}
else if(isset($_GET["id"]) && !empty(trim($_GET["id"]))){
    // Include config file
    require_once "config.php";

    $id = $_GET["id"];

    $sql = "SELECT * FROM  all_items_ids WHERE item = ('$id')";

    $result = pg_query($link, $sql);

    if(pg_num_rows($result) == 1)
    {
        $data = pg_fetch_array($result);
        $id = $data['item'];
        $type = $data['type'];
        $itemType = $data['itemtype'];
        $color = $data['color'];
        $shirtSize = $data['shirtsize'];
        $pictureSize = $data['picturesize'];
        $price = $data['price'];

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
                    <h1>Update Record</h1>
                </div>
                <p>Item Data</p>
                <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="post">
                    <div class="form-group">
                        <label for="type">Type</label>
                        <select name="type" id="type" disabled>
                            <option value='1'>Shirt</option>
                            <option value='2'>Polo</option>
                            <option value='3'>Hoodie</option>
                            <option value='4'>Cap</option>
                            <option value='5'>Tote Bag</option>
                        </select>
                        <script>
                            document.getElementById('type').selectedIndex=<?php echo $type - 1 ?>;
                        </script>
                    </div>
                    <div class="form-group">
                        <label for="itemType">Item Type</label>
                        <select name="itemType" id="itemType" disabled>
                            <option value='1'>Combeds 30s</option>
                            <option value='2'>Combeds 20s</option>
                            <option value='3'>Polo</option>
                            <option value='4'>Hoodie no Zipper</option>
                            <option value='5'>Hoodie with Zipper</option>
                            <option value='6'>Without Picture</option>
                            <option value='5'>With Picture</option>
                        </select>
                        <script>
                            document.getElementById('itemType').selectedIndex=<?php echo $itemType- 1 ?>;
                        </script>

                    </div>

                    <div class="form-group">
                        <label for="color">Color</label>
                        <select name="color" id="color" disabled>
                            <option value='1'>White</option>
                            <option value='2'>Color without White Ink</option>
                            <option value='3'>Black and Color with White Ink</option>
                            <option value='4'>Black</option>
                        </select>

                        <script>
                            document.getElementById('color').selectedIndex=<?php echo $color- 1 ?>;
                        </script>
                    </div>

                    <div class="form-group">
                        <label for="shirtSize">Shirt Size</label>
                        <select name="shirtSize" id="shirtSize" disabled>
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
                        <script>
                            document.getElementById('shirtSize').selectedIndex=<?php echo $shirtSize?>;
                        </script>


                    </div>

                    <div class="form-group">
                        <label for="picSize">Picture Size</label>
                        <select name="picSize" id="picSize" disabled>
                            <option value='0'>No Picture</option>
                            <option value='1'>A4</option>
                            <option value='2'>A3</option>
                        </select>

                        <script>
                            document.getElementById('picSize').selectedIndex=<?php echo $pictureSize  ?>;
                        </script>

                    </div>
                    <div class="form-group">
                        <label for="price">Price</label>
                        <input name="price" type="text" value=<?php echo $price ?>>
                    </div>
                    <input type="hidden" name="id" value="<?php echo $id; ?>"/>
                    <input type="submit" class="btn btn-primary" value="Submit">
                    <a href="index.php" class="btn btn-default">Cancel</a>
                </form>
            </div>
        </div>
    </div>
</div>
</body>
</html>