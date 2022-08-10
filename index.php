<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="style.css">
    <title>Student Varification Page</title>
</head>
<body>
<header>
        <img src="./diu.png" alt="DIU Logo">
        <h4>For Get your certificate need to input your ID fast</h4>
        <h1>Daffodil International University Department of GED</h1>
    </header>
    <main>
        <form action="certificate_genarator.php" method="POST">
            <!-- <label for="name">Enter Your Name</label><br>
            <input required type="text" name="name" autocomplete="name" placeholder="Enter Your Full Name" id="name" minlength="3"
            maxlength="32"> <br> -->
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

        session_start();
        $conn = mysqli_connect("localhost", "root", "", "certificate");

        if($conn -> connect_error){
         die("Connection Failed".$conn -> connect_error);
        }

        $id = stripcslashes($id);  
        $id = mysqli_real_escape_string($conn, $id);  

        $sql = "SELECT * FROM login where username = '$username' and password = '$password'";  

    ?>
    
</body>
</html>