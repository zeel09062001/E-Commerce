<?php
    include('connections/con.php');
    if(isset($_POST["order"])){
        $name = $_POST["name"];
        $email = $_POST["email"]; 
        $phone = $_POST["phone"];
        $postcode = $_POST["postcode"];
        $address = $_POST["address"];
        $city = $_POST["city"];
        $province = $_POST["province"];
        $quntity = $_POST["quntity"];
        
        $pid = intval($_POST['pid']);
        $sql = "SELECT * FROM product WHERE pid=?";
        $query = $conn->prepare($sql);
        $query->bind_param('i', $pid);
        $query->execute();
        $result = $query->get_result();

        if($result->num_rows > 0){
            $row = $result->fetch_assoc();
            $productPrice = $row['price'];

            $taxRates = array(
                "Alberta" => 0.05,
                "British Columbia" => 0.12,
                "Manitoba" => 0.12,
                "New Brunswick" => 0.15,
                "Newfoundland and Labrador" => 0.15,
                "Nova Scotia" => 0.15,
                "Ontario" => 013,
                "Prince Edward Island" => 0.15,
                "Quebec" => 0.1498,
                "Saskatchewan" => 0.11,
                "Northwest Territories" => 0.5,
                "Nunavut" => 0.5,
                "Yukon" => 0.5,
            );
            $taxRate = isset($taxRates[$province]) ? $taxRates[$province] : 0;
            $tax = $productPrice * $quntity * $taxRate;
            $totalAmmount = ($productPrice * $quntity) + $tax;

            $iquery = $conn->prepare("INSERT INTO orderdetails (oname, oemail, ophone, oaddress, ocity, oprovince, opostcode, oprice, otax, oammount) VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?)");
            $iquery->bind_param("ssssssssss", $name, $email, $phone, $address, $city, $province, $postcode, $productPrice, $tax, $totalAmmount);
            $iquery->execute();

            if($iquery){

                $responseData = array(
                    'name' => $name,
                    'email' => $email,
                    'province' => $province,
                    'quntity' => $quntity,
                    'price' => $productPrice,
                    'totalammount' => $totalAmmount,
                );
            
                echo json_encode($responseData);
                
            } else {
                header("Location: index.php");
                exit();
            }
            
            
        }
        else{
            echo "Product not found";
        }
    }
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    <link rel="stylesheet" href="assets/allOrdersStyle.css">
    <title>Form details</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <style>
        .popup {
            display: none;
            position: fixed;
            top: 50%;
            left: 50%;
            transform: translate(-50%, -50%);
            padding: 20px;
            background: #fff;
            border: 1px solid #ccc;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
            z-index: 999;
        }

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

        select {
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

        a{
            text-decoration: none;
            padding: 10px;
            margin-bottom: 16px;
            border: 1px solid #ccc;
            border-radius: 4px;
            margin-inline: 20px;
            font-display: center;
        }
    </style>

    <title>Form with PHP Validation</title>
</head>
<body>

<section class="orders-container">
    <form method="post" action="shopping.php">
        <label for="name">Name:</label>
        <input type="text" id="name" name="name">

        <label for="email">Email:</label>
        <input type="text" id="email" name="email">        

        <label for="phone">Phone:</label>
        <input type="text" id="phone" name="phone">     

        <label for="postcode">Postcode:</label>
        <input type="text" id="postcode" name="postcode">

        <label for="address">Address:</label>
        <input type="text" id="address" name="address">

        <label for="city">City:</label>
        <input type="text" id="city" name="city">

        <label for="province">Select Province</label>
        <select name="province" id="province">
            <option value="Alberta" >Alberta</option>
            <option value="British Columbia">British Columbia</option>
            <option value="Manitoba">Manitoba</option>
            <option value="New Brunswick">New Brunswick</option>
            <option value="Newfoundland and Labrador">Newfoundland and Labrador</option>
            <option value="Nova Scotia">Nova Scotia</option>
            <option value="Ontario">Ontario</option>
            <option value="Prince Edward Island">Prince Edward Island</option>
            <option value="Quebec">Quebec</option>
            <option value="Saskatchewan">Saskatchewan</option>
            <option value="Northwest Territories">Northwest Territories</option>
            <option value="Nunavut">Nunavut</option>
            <option value="Yukon">Yukon</option>
        </select>

        <label for="quntity">Quntity</label>
        <input type="number" name="quntity" id="quntity">

        <label for="credit_card">Credit Card:</label>
        <input type="text" id="credit_card" name="credit_card">

        <label for="expiry_month">Expiry Month:</label>
        <input type="text" id="expiry_month" name="expiry_month">

        <label for="expiry_year">Expiry Year:</label>
        <input type="text" id="expiry_year" name="expiry_year">

        <label for="product">Select Product:</label>
        <select name="pid" id="pid">
            <option value="1">Product A</option>
            <option value="2">Product B</option>
            <option value="3">Product C</option>
        </select>

        <input type="submit" name="order" value="SUBMIT">
        <a id="cancle" href="index.php"><CEnter>CANCLE</CEnter></a>
    </form>
</section>
    <div id="popup" class="popup">
        <p id="popupContent"></p>
        <button id="okButton">OK</button>
    </div>

    <script src="https://code.jquery.com/jquery-3.6.4.min.js"></script>
    <script>
        $(document).ready(function () {
            $("#orderForm").submit(function (event) {
                event.preventDefault();

                $.ajax({
                    type: "POST",
                    url: "shopping.php",
                    data: $(this).serialize(),
                    success: function (response) {
                        var data = JSON.parse(response);

                        $("#popupContent").html(
                            "Name: " + data.name +
                            "<br>Email: " + data.email +
                            "<br>Province: " + data.province +
                            "<br>Quentity:" + data.quntity +
                            "<br>Price:" + data.productPrice +
                            "<br>Tax Rate: " + data.taxRate +
                            "<br>Tax Amount: " + data.taxAmount +
                            "<br>Total Amount: " + data.totalAmount +
                            "<br>"
                        );

                        $("#popup").show();
                    },
                    error: function (xhr, textStatus, errorThrown) {
                        console.log("Error: " + errorThrown);
                    }
                });
            });

            $("#okButton").click(function () {
                window.location.href = "index.php";
            });
        });
    </script>


</body>
</html>
