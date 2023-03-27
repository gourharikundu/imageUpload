<?php
    $showAlert=false;
    $showError=false;
    include "partials/_dbconnect.php";

?>

<!doctype html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Image Upload</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.2/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-Zenh87qX5JnK2Jl0vWa8Ck2rdkQ2Bzep5IDxbcnCeuOxjzrPF/et3URy9Bv1WTRi" crossorigin="anonymous">
</head>

<body>
    <?php 
        include "partials/_navbar.php";
    ?>
    <div class="container my-4">
        <h2>Uploaded Images</h2>
        <div class="row">
        <?php
            $sql="SELECT * FROM `images`";
            $result=mysqli_query($conn, $sql);
            $noImgs=mysqli_num_rows($result);
            if($noImgs>0){
                while($row=mysqli_fetch_assoc($result)){
                    echo '
                        <div class="col-sm-4 my-2">
                            <div class="card">
                            <img src="'.$row['image'].'" class="card-img-top" alt="...">
                            <div class="card-body">
                                <h5 class="card-title">'.$row['title'].'</h5>
                            </div>
                            </div>
                        </div>
                        ';
                }
            }
            else{
                echo '<div class="alert alert-warning" role="alert">
                <h4 class="alert-heading">No Images</h4>
                <p>There are no images in the database to show. Kindly do upload some images to see.</p>
                <hr>
                <p class="mb-0">Whenever you need to, You can upload images by <a href="/imgupload/index.php"> clicking this</a></p>
              </div>';
            }
        ?>
    </div>
    </div>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.2/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-OERcA2EqjJCMA+/3y+gxIOqMEjwtxJY7qPCqsdltbNJuaOe923+mo//f6V8Qbsw3"
        crossorigin="anonymous"></script>
</body>

</html>