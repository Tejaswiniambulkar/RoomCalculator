<?php
session_start();
if (!isset($_SESSION['selectedBhkType']) || !isset($_SESSION['totalCost']) || !isset($_SESSION['selectedPackage']) || !isset($_SESSION['roomSelections'])) {
    header("Location: index.php");
    exit();
}

$selectedBhkType = $_SESSION['selectedBhkType'];
$totalCost = $_SESSION['totalCost'];
$selectedPackage = $_SESSION['selectedPackage'];
$roomSelections = $_SESSION['roomSelections'];
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Estimate Details</title>
    <link href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet">
    <link rel="icon" href="images/Basil-Homes.png" type="image/x-icon">
    <style>
       
        .container {
            margin-top: 50px;
        }
        .estimate-card {
            background: #fff;
            padding: 20px;
            border-radius: 8px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
        }
        .estimate-header {
            background: #007bff;
            color: #fff;
            padding: 10px;
            border-radius: 8px 8px 0 0;
        }
        .estimate-body {
            padding: 20px;
        }
        .estimate-footer {
            padding: 10px;
            border-radius: 0 0 8px 8px;
            text-align: right;
        }
        .estimate-footer .btn {
            background: #007bff;
            color: #fff;
        }
    </style>
</head>
<body>
    <div class="container">
        <div class="estimate-card">
            <div class="estimate-header">
                <h4>Estimate Details</h4>
            </div>
            <div class="estimate-body">
                <p><strong>BHK Type:</strong> <?php echo htmlspecialchars($selectedBhkType); ?></p>
                <p><strong>Total Cost:</strong> <?php echo htmlspecialchars($totalCost); ?> INR</p>
                <p><strong>Package:</strong> <?php echo htmlspecialchars($selectedPackage); ?></p>
                <p><strong>Room Selections:</strong></p>
                <ul>
                    <?php foreach ($roomSelections as $room => $details) { ?>
                        <li><?php echo htmlspecialchars($room); ?>: <?php echo htmlspecialchars($details); ?></li>
                    <?php } ?>
                </ul>
            </div>
            <div class="estimate-footer">
                <button onclick="window.print()" class="btn btn-primary">Print</button>
                <a href="index.php" class="btn btn-secondary">Back</a>
            </div>
        </div>
    </div>
</body>
</html>
