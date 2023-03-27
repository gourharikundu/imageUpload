<?php
    $showAlert=false;
    $showError=false;
    include "partials/_dbconnect.php";
    
    if($_SERVER["REQUEST_METHOD"]=="POST"){
        $title=$_POST["title"];
        $imgfile=$_FILES['photo'];
        //echo var_dump($imgfile);
        $imgName=$imgfile['name'];
        $imgDest=$imgfile['tmp_name'];
        $imgError=$imgfile['error'];

        $imgEx=explode('.', $imgName);
        $imgExtension=strtolower(end($imgEx));
        $validExtension=array('png','jpg','jpeg');

        if($imgError==0){
            if(in_array($imgExtension, $validExtension)){
                $dest="uploads/".$imgName;
                move_uploaded_file($imgDest, $dest);
                $sql="INSERT INTO `images` (`title`, `image`) VALUES ('$title', '$dest');";
                $result=mysqli_query($conn, $sql);
                if($result){
                    $showAlert=true;
                }
                //move_uploaded_file($imgName,$dest);
            }
            else{
                $showError="Image extension is not valid.";
            } 
        }
        else{
            $showError="There was some problem while uploading the image.";
        }
    }
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
        if($showAlert){
            echo '<div class="alert alert-success alert-dismissible fade show" role="alert">
            <strong>Success! </strong> Your image has been uploaded succesfully.
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>';
        }
        if($showError){
            echo '<div class="alert alert-danger alert-dismissible fade show" role="alert">
            <strong>Error! </strong>'.$showError.'
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>';
        }
    ?>
    <div class="container my-4">
        <h2>Upload your Images</h2>
        <form action="/imgupload/index.php" method="POST" enctype="multipart/form-data">
            <div class="mb-3">
              <label for="title" class="form-label">Title</label>
              <input type="text" class="form-control" id="title" name="title" aria-describedby="emailHelp">
            </div>
            <div class="mb-3">
              <label for="image" class="form-label">Image </label>
              <input type="file" class="form-control" id="photo" name="photo">
            </div>
            <button type="submit" class="btn btn-primary" name="submit">Submit</button>
          </form>
    </div>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.2/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-OERcA2EqjJCMA+/3y+gxIOqMEjwtxJY7qPCqsdltbNJuaOe923+mo//f6V8Qbsw3"
        crossorigin="anonymous"></script>
</body>

</html>