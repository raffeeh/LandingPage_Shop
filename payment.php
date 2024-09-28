<?php
session_start();
$cart = isset($_SESSION['cart']) ? $_SESSION['cart'] : [];
$total = 0;
$totalQuantity = 0;
$shippingPrice = 0; // This is only an example. We can change this whenever a shipping fee is necessary.

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>THREADED - Payment</title>
    <link href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet">
    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.2/dist/umd/popper.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css">
    <link href="css/main.css" rel="stylesheet">
    <script src="js/main.js"></script>
</head>
<body>

    <?php include 'includes/navbar.php'; 
    
    foreach ($cart as $item): 
        $totalQuantity += $item['quantity'];
        $itemName = addslashes($item['name']); // Escape single quotes in item name
        $itemPrice = $item['price'];
        $itemImage = $item['image'];
        $itemQuantity = $item['quantity'];
        echo "<script type='text/javascript'>addToCartPayment('$itemName', $itemPrice, '$itemImage', $itemQuantity);</script>";
    endforeach;
    
    ?>

    <div class="container mt-2">
        <div class="d-flex justify-content-between align-items-center">
            <div class="mx-2">
                <div><strong>SHOPPING BAG (<?php echo $totalQuantity?>)</strong></div>
                <div style="font-size: 12px;"><a href="" style="text-decoration: underline; color: #000;">Sign In</a> to sync your bag across your devices.</div>
            </div>
            <div class="mx-2 text-right">
                <div style="font-size: 12px;">Need help? +1-562-926-5672</div>
                <div style="font-size: 12px;"><i class="fas fa-message" style="margin-right: 5px;"></i><a href="" style="text-decoration: underline; color: #000;">Let's Chat</a></div>
            </div>
        </div>
    </div>
    <div class="container mt-2">
        <div class="row">
            <div class="col-md-8">
                <table class="table">
                    <thead>
                        <tr>
                            <th style="border-top: unset">Items</th>
                            <th style="border-top: unset" class="text-right">Price</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php foreach ($cart as $item): 
                            $subtotal = $item['price'] * $item['quantity'];
                            $total += $subtotal; ?>
                            <tr>
                                <td>
                                    <div class="d-flex">
                                        <img src="<?php echo htmlspecialchars($item['image']); ?>" class="img-thumbnail" alt="<?php echo htmlspecialchars($item['name']); ?>" style="width: 75px; height: 100px; margin-right: 10px;">
                                        <div>
                                            <strong><?php echo htmlspecialchars($item['name']); ?></strong><br>
                                            Qty: <?php echo $item['quantity']; ?>
                                        </div>
                                    </div>
                                </td>
                                <td class="text-right">$<?php echo number_format($subtotal, 2); ?></td>
                            </tr>
                        <?php endforeach; ?>
                    </tbody>
                </table>
            </div>
            <div class="col-md-4">
                <div class="d-flex justify-content-center align-items-center" style="padding: 12px">
                    <h5>Order Summary</h5>
                </div>
                <div class="border p-3">
                    <div class="d-flex justify-content-between">
                        <span>Subtotal (<?php echo $totalQuantity; ?>)</span>
                        <span>$<?php echo number_format($total, 2); ?></span>
                    </div>
                    <div class="d-flex justify-content-between">
                        <span>Free Shipping</span>
                        <span>$<?php echo number_format($shippingPrice, 2); ?></span>
                    </div>
                    <hr>
                    <div class="d-flex justify-content-between">
                        <strong><span>Estimated Total</span></strong>
                        <strong><span>$<?php echo number_format($total + $shippingPrice, 2); ?></span></strong>
                    </div>
                </div>
                <button class="border payment-btn">
                    <div class="d-flex justify-content-center align-items-center" style="padding: 15px">
                        <h5>CHECKOUT AS A GUEST</h5>
                    </div>
                </button>
                <button class="border payment-btn">
                    <div class="d-flex justify-content-center align-items-center" style="padding: 15px">
                        <h5>SIGN IN FOR FASTER CHECKOUT</h5>
                    </div>
                </button>
                <button class="border payment-btn-secondary">
                    <div class="d-flex justify-content-center align-items-center">
                        <img src="resources/paypal.png" style="margin-right: 5px"> <span>Checkout</span>
                    </div>
                </button>
            </div>
        </div>
    </div>

    <?php include 'includes/footer.php'; ?>
    <?php include 'includes/modal.php'; ?>
    
</body>
</html>
