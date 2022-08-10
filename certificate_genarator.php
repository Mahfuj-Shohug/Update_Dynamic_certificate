<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="style.css">
    <title>Student Certificate</title>
</head>


<body>

    <header>
        <img src="./diu.png" alt="DIU Logo">
        <h4>For Get your certificate need to input your ID fast</h4>
        <h1>Daffodil International University Department of GED</h1>
    </header>
    <main>
        <form action="certificate_genarator.php" method="POST">
            <label for="name">Enter Your Name</label><br>
            <input required type="text" name="name" autocomplete="name" placeholder="Enter Your Full Name" id="name" minlength="3"
            maxlength="32"> <br>
            <label for="id">Enter your ID</label><br>
            <input required type="text" name="id" autocomplete="id" placeholder="000-00-0000" id="id" minlength="3"
            maxlength="16"><br>
            <input class='btn' type="submit" name= "submit" value="Genarate Your Certificate">
        </form>
        <h4 style="color: red;">You can download your certificate only one time</h4>
        <div style="text-align: left; font-size: 8px;">
            <i>Design and developed by <a href="https://www.linkedin.com/in/mahfuj-hasan-shohug-62b70a1a3/">Md. Mahfuj Hasan Shohug</a> Alumni DIU Software Engineering Department.</i> 
        </div>
        
        
    </main>

    <?php
    
    $conn = mysqli_connect("localhost", "root", "", "certificate");

    if($conn -> connect_error){
        die("Connection Failed".$conn -> connect_error);
    }else{

    
    
    if($_SERVER['REQUEST_METHOD'] == 'POST'){
            $name = $_POST['name'];
            $id = $_POST['id'];
            $fsize = 55;
            $fsize2 = 35;
            $font = realpath("Arimo-Regular.ttf");
            $image = imagecreatefromjpeg("certificate.jpg");
            $height = imagesx($image);
            $width = imagesy($image);
            $color = imagecolorallocate($image, 19, 21, 22);
            $box_size = imagettfbbox($fsize, 0, $font, $name);
            $w = $box_size[4] - $box_size[0];
            $x = ($height - $w)/2;
            $y = 700;
            $box_size2 = imagettfbbox($fsize2, 0, $font, $id);
            $w2 = $box_size2[4] - $box_size2[0];
            $x2 = ($height - $w2)/2;
            $y2 = 800;
            $query = "SELECT Id, SL FROM certificates WHERE Id = '$id'";
            $result = mysqli_query($conn, $query);
            
            if(mysqli_num_rows($result)>0){
                while($row = mysqli_fetch_assoc($result)){
                    $mainid = $row['Id'];
                    $serial = $row['SL'];
                    imagettftext($image, $fsize, 0, $x, $y, $color, $font, $name);
                    imagettftext($image, $fsize2, 0, $x2, $y2, $color, $font, $mainid);
                    imagettftext($image, 30, 0, 1600, 250, $color, $font, $serial);
                    $filepath = "certificates/".$name.".jpg";
                    imagejpeg($image, $filepath);
                    imagedestroy($image);


                    header('Content-Description: File Transfer');
                    header('Content-Type: application/octet-stream');
                    header('Content-Disposition: attachment; filename='.basename($filepath));
                    header('Content-Transfer-Encoding: binary');
                    header('Expires: 0');
                    header('Cache-Control: must-revalidate, post-check=0, pre-check=0');
                    header('Pragma: public');
                    header('Content-Length: ' . filesize($filepath));
                    ob_clean();
                    flush();
                    readfile($filepath);
                    exit;
                    

                 }
            }else{
                echo "You are not eligiable for dawnload the Certificate";
            }
    }
}
    
?>




</body>
</html>
