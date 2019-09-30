<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Dashboard</title>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.css">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.4/jquery.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.js"></script>
    <style type="text/css">
        .wrapper{
            width: 650px;
            margin: 0 auto;
        }
        .page-header h2{
            margin-top: 0;
        }
        table tr td:last-child a{
            margin-right: 15px;
        }
    </style>
    <script type="text/javascript">
        $(document).ready(function(){
            $('[data-toggle="tooltip"]').tooltip();
        });
    </script>
</head>
<body>
    <div class="wrapper">
        <div class="container-fluid">
            <div class="row">
                <div class="col-md-12">
                    <div class="page-header clearfix">
                        <h2 class="pull-left">Item details</h2>
                        <input type="text"  class="pull-center" id="search" placeholder="Search" onkeyup="searchjobs()">
                        <a href="AddNewItem.php" class="btn btn-success pull-right">Add New Item</a>
                    </div>

                    <?php
                    // Include config file
                    require_once "config.php";

                    // Attempt select query execution
                    $sql = "SELECT * FROM all_items";
                    if($result = pg_query($link, $sql)){
                        if(pg_num_rows($result) > 0){
                            echo "<table class='table table-bordered table-striped'>";
                                echo "<thead>";
                                    echo "<tr>";
                                        echo "<th>#</th>";
                                        echo "<th>Type</th>";
                                        echo "<th>Item Type</th>";
                                        echo "<th>Color</th>";
                                        echo "<th>Shirt Size</th>";
                                        echo "<th>Picture Size</th>";
                                        echo "<th>Price</th>";
                                        echo "<th>Action</th>";
                                    echo "</tr>";
                                echo "</thead>";
                                echo "<tbody>";
                                while($row = pg_fetch_array($result)){
                                    echo "<tr class='rows'>";
                                        echo "<td>" . $row['id'] . "</td>";
                                        echo "<td>" . $row['type'] . "</td>";
                                        echo "<td>" . $row['itemtype'] . "</td>";
                                        $color = $row['color'];
                                        if($color == null)
                                        {
                                            $color = "No Color";
                                        }
                                        echo "<td>" . $color . "</td>";
                                        $shirtSize = $row['shirtsize'];
                                        if($shirtSize == null)
                                        {
                                            $shirtSize = 'N/A';
                                        }
                                        echo "<td>" . $shirtSize . "</td>";

                                        $pictureSize = $row['picturesize'];
                                        if($pictureSize == null)
                                        {
                                            $pictureSize = 'No Pic';
                                        }

                                        echo "<td>" . $pictureSize . "</td>";
                                        echo "<td>" . $row['price'] . "</td>";
                                        echo "<td>";
                                            echo "<a href='update.php?id=". $row['id'] ."' title='Update Record' data-toggle='tooltip'><span class='glyphicon glyphicon-pencil'></span></a>";
                                            echo "<a href='delete.php?id=". $row['id'] ."' title='Delete Record' data-toggle='tooltip'><span class='glyphicon glyphicon-trash'></span></a>";
                                        echo "</td>";
                                    echo "</tr>";
                                }
                                echo "</tbody>";
                            echo "</table>";
                            // Free result set
                            pg_free_result($result);
                        } else{
                            echo "<p class='lead'><em>No records were found.</em></p>";
                        }
                    } else{
                        echo "ERROR: Could not able to execute $sql. " . pg_last_error($link);
                    }

                    // Close connection
                    pg_close($link);
                    ?>

                </div>
            </div>
        </div>
    </div>
</body>
<script>
    function searchjobs()
    {
        // Declare variables
        var input, filter, title, i, txtValue;
        input = document.getElementById("search");
        filter = input.value.toUpperCase();

        var divs = document.getElementsByClassName("rows");

        // Loop through all list items, and hide those who don't match the search query
        for (i = 0; i < divs.length; i++)
        {
            title = divs[i];

            txtValue = title.textContent || title.innerText;

            if (txtValue.toUpperCase().indexOf(filter) > -1)
            {
                divs[i].style.display = "";
            }
            else
            {
                divs[i].style.display = "none";
            }
        }
    }
</script>

</html>