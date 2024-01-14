<?php
    session_start();

    if((!isset($_SESSION['username']))){
        header("Location: adminlogin.php");
        exit();
    }

    include('connections/con.php');

    if(isset($_POST['submit'])){
        $name = $_POST['name'];
        $phonenumber = $_POST['phonenumber'];
        $username = $_POST['username'];
        $password = $_POST['password'];
        $status = "2";
        
        $sql = "INSERT INTO admin(name, phonenumber, username, password, status)VALUES(?,?,?,?,?)";

        $stmt = $conn->prepare($sql);

        if($stmt){
            $stmt->bind_param("sssss", $name,$phonenumber,$username,$password,$status);

            $stmt->execute();

            if($stmt->affected_rows > 0){
                
            }
            else{
                echo "Error add admin again.";
            }

            $stmt->close();
        }
        else{
            echo $conn->error;
        }
        $conn->close();
    }
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="assets/allOrdersStyle.css">
    <title>All Orders</title>

    <style>
        h2 {
            color: #333;
            margin-bottom: 20px;
        }

        form {
            display: flex;
            flex-direction: column;
        }

        label {
            text-align: left;
            margin-inline: 20px;
            margin-bottom: 8px;
            color: #555;
        }

        /* Increase the width of the text fields */
        input {
            padding: 10px;
            margin-bottom: 16px;
            border: 1px solid #ccc;
            border-radius: 4px;
            margin-inline: 20px;
            
        }

        button {
            background: linear-gradient(135deg, #4e7eff, #28a2eb);
            color: #fff;
            padding: 12px;
            margin-bottom: 10px;
            border: none;
            border-radius: 4px;
            margin-inline: 20px;
        }

        button:hover {
            background: linear-gradient(135deg, #28a2eb, #4e7eff);
        }
    </style>

</head>

<body>
<?php include('assets/header.php'); ?>
    

    <section class="orders-container">
    <h1>Create Manager</h1>     
        <form method="post" action="addadmin.php">
            <label for="name">Name:</label>
            <input type="text" id="name" name="name" required>

            <label for="phonenumber">Phone Number</label>
            <input type="number" id="phonnumber" name="phonenumber" required>

            <label for="username">User Name:</label>
            <input type="text" id="username" name="username" required>

            <label for="password">Manager Password:</label>
            <input type="password" id="password" name="password" required>

            <button type="submit" name="submit" class="btn-primary btn">Create</button>

            <button type="reset" class="btn-inverse btn">Reset</button>
        </form>
    </section>

</body>

</html>