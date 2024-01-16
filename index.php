<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="assets/allOrdersStyle.css">
    <title>Product</title>
    <script src="https://code.jquery.com/jquery-3.6.4.min.js"></script>
    <style>
        input {
            background: linear-gradient(135deg, #4e7eff, #28a2eb);
            width: 100px;
            color: #fff;
            padding: 8px;
            margin-top: 10px;
            margin-bottom: 20px;
            border: none;
        }
    </style>
    <script>
        $(document).ready(function() {
            $("#orderForm").submit(function(event) {
                event.preventDefault();

                $.ajax({
                    type: "POST",
                    url: "shopping.php",
                    data: $(this).serialize(),
                    success: function(response) {
                        alert("Order submitted successfully!");
                    },
                    error: function(error) {
                        console.log(error);
                        alert("Error submitting order. Please try again.");
                    }
                });
            });
        });
    </script>
</head>

<body>
    <?php include('assets/header.php'); ?>


    <section class="orders-container">

        <form method="post" action="shopping.php">
            <h1>
                <center>Product</center>
            </h1>
            <div class="order-item">
                <div class="order-details">
                    <img src="assets/Images/first.webp" alt="Product Image">
                    <div class="text-details">
                        <h3>Product A</h3>
                        <p>Description: Lorem ipsum dolor sit amet, consectetur adipiscing elit.</p>
                        <p>Price: $19.99</p>
                        <input type="number" name="pid" id="pid" value="1" hidden>

                        <input type="submit" name="buy" value="Buy">
                    </div>
                </div>
            </div>
        </form>

        <form method="post" action="shopping.php">
            <div class="order-item">
                <div class="order-details">
                    <img src="assets/Images/secound.jpeg" alt="Product Image">
                    <div class="text-details">
                        <h3>Product B</h3>
                        <p>Description: Sed do eiusmod tempor incididunt ut labore et dolore magna aliqua.</p>
                        <p>Price: $29.99</p>
                        <input type="number" name="pid" id="pid" value="2" hidden>

                        <input type="submit" name="buy" value="Buy">

                    </div>
                </div>
            </div>
        </form>

        <form method="post" action="shopping.php">
            <div class="order-item">
                <div class="order-details">
                    <img src="assets/Images/third.jpeg" alt="Product Image">
                    <div class="text-details">
                        <h3>Product C</h3>
                        <p>Description: Sed do eiusmod tempor incididunt ut labore et dolore magna aliqua.</p>
                        <p>Price: $39.99</p>
                        <input type="number" name="pid" id="pid" value="3" hidden>

                        <input type="submit" name="buy" value="Buy">
                    </div>
                </div>
            </div>
        </form>
    </section>
</body>

</html>