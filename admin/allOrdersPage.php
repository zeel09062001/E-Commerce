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
    <script>
        $(document).ready(function () {
            $("#orderForm").submit(function (event) {
                event.preventDefault();

                // AJAX request to submit the form data
                $.ajax({
                    type: "POST",
                    url: "process_order.php", // Replace with your server-side processing script
                    data: $(this).serialize(),
                    success: function (response) {
                        // Display the receipt using AJAX response
                        alert("Order submitted successfully!");
                        // You can update this part to display the receipt in a specific element
                    },
                    error: function (error) {
                        console.log(error);
                        alert("Error submitting order. Please try again.");
                    }
                });
            });
        });
    </script>
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
                        <th>Order id</th>
                        <th>Name</th>
                        <th>Email</th>
                        <th>City</th>
                        <th>Price</th>
                        <th>Tax</th>
                        <th>Payable Ammount</th>
                        
                      </tr>
                    </thead>
                    <tbody>
                     <?php $sql = "SELECT * FROM orderdetails";
                     $result = $conn->query($sql);
                     
                     if($result)
                     {
                        if($result->num_rows > 0){
                            $cnt = 1;

                            while ($row = $result->fetch_assoc()){
                                ?>
                                <tr>
                            <td><?php echo $row['oid'];?></td>
                            <td><?php echo $row['oname'];?></td>
                            <td><?php echo $row['oemail'];?></td>
                            <td><?php echo $row['ocity'];?></td>
                            <td><?php echo $row['oprice'];?></td>
                            <td><?php echo $row['oprice'];?></td>
                            <td><?php echo $row['otax']?></td>
                            <td><?php echo $row['oammount']?></td>
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