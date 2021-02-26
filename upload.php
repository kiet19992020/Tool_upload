
<?php
$connect = new PDO("mysql:host=localhost;dbname=thi_php", "root", "");

     if (count($_FILES["images"]["tmp_name"]) > 0) {
          for ($count = 0; $count < count($_FILES["images"]["tmp_name"]); $count++) {

              $image_file = $_FILES["images"]["name"][$count];
              $size = $_FILES['images']['size'][$count];
               $query = "INSERT INTO tbl_images(images,size) VALUES ('$image_file','$size')";
               $statement = $connect->prepare($query);
               $statement->execute();
          }
     }
?>
<?php
$output = '';
if (is_array($_FILES)) {
     foreach ($_FILES['images']['name'] as $name => $value) {
          $file_name = explode(".", $_FILES['images']['name'][$name]);
          $allowed_extension = array("jpg", "jpeg", "png", "gif", "pdf");
          if (in_array($file_name[1], $allowed_extension)) {
               $new_name = rand() . '.' . $file_name[1];
               $sourcePath = $_FILES["images"]["tmp_name"][$name];
               $targetPath = "upload/" . $new_name;
               move_uploaded_file($sourcePath, $targetPath);
          }
     }
     $images = glob("upload/*.*");
     foreach ($images as $image) {
          $output .= '
         
          <div class="col-md-1" align="center" ><img src="' . $image . '" width="100px" height="100px" style="margin-top:15px; padding:8px; border:1px solid #ccc;" />
          <a style="padding-left:20px" download = "'.$image.'" href ="'.$image.'" >Dowload</a>
          </div>
          ';
         
     }
   
        echo $output;
       
}
?> 
<?php
// $conn = mysqli_connect('localhost', 'root', '', 'thi_php');
// if (isset($_POST['submit'])) { 

//     $filename = $_FILES['images']['name'];
//     $destination = 'upload/'.$filename;
//     $extension = pathinfo($filename, PATHINFO_EXTENSION);
//     $file = $_FILES['images']['tmp_name'];
//     $size = $_FILES['images']['size'];

//     if (!in_array($extension, ['png','jpg','zip', 'pdf', 'docx'])) {
//         echo "You file extension must be .zip, .pdf or .docx";
//     } elseif ($_FILES['images']['size'] > 1000000) {
//         echo "File too large!";
//     } else {
//         if (move_uploaded_file($file, $destination)) {
//           print "DEBUG: move_uploaded_file" . $file . " " .$destination;
//             $sql = "INSERT INTO tbl_images(images, size, download) VALUES ('$filename', $size, 0)";
//             print "DEBUG: query result" . $sql;
//             if (mysqli_query($conn, $sql)) {
//                 echo "File uploaded successfully";
//             }
//         } else {
//             echo "Failed to upload file.";
//         }
//     }
// }
?>
