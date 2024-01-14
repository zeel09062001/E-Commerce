<?php
  session_start();

    if(!isset($_SESSION['username'])){
        header("Location: adminlogin.php");
        exit();
    }
    include('connections/con.php');
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="assets/allOrdersStyle.css">
    <title>All Orders</title>
    <link rel="stylesheet" href="assets/table.css">
    <script src="https://code.jquery.com/jquery-3.6.4.min.js"></script>
    
    <style>
        table{
            border: solid;
        }
        tr{
            border: solid;
        }
    </style>
</head>

<body>
<?php include('assets/header.php'); ?>
    <h1>All Orders</h1>
    

    <div class="table-responsive p-3">
                  <table class="table align-items-center table-flush table-hover" id="dataTableHover">
                    <thead class="thead-light">
                      <tr>
                        <th>Admin id</th>
                        <th>Name</th>
                        <th>Phonenumber</th>                        
                      </tr>
                    </thead>
                    <tbody>
                     <?php $sql = "SELECT * FROM admin";
                     $result = $conn->query($sql);
                     
                     if($result)
                     {
                        if($result->num_rows > 0){
                            $cnt = 1;

                            while ($row = $result->fetch_assoc()){
                                ?>
                                <tr>
                            <td><?php echo $row['uid'];?></td>
                            <td><?php echo $row['name'];?></td>
                            <td><?php echo $row['phonenumber'];?></td>
                            </tr>
                                <?php
                                $cnt++;
                            }
                        }
                             ?>    
                          

                          <?php 
                        } 
                      ?>
                    </tbody>
                  </table>
               
                </div>
</body>

</html>