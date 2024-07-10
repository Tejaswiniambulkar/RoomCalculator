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
    <title>Details</title>
    <link href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="styles.css">
    <link rel="icon" href="images/Basil-Homes.png" type="image/x-icon">
    <style>
        body {
            background-color: #f8f9fa;
        }
        .form-container {
            max-width: 600px;
            margin: 50px auto;
            background: #fff;
            padding: 20px;
            border-radius: 8px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
        }
        .progress-bar-container {
            display: flex;
            justify-content: space-between;
            margin-bottom: 30px;
        }
        .progress-bar-step {
            flex: 1;
            text-align: center;
            position: relative;
        }
        .progress-bar-step:not(:last-child)::after {
            content: '';
            width: 100%;
            height: 2px;
            background: #6c757d;
            position: absolute;
            top: 50%;
            left: 50%;
            transform: translateX(50%);
        }
        .progress-bar-step.active::after {
            background: #28a745;
        }
        .progress-bar-step .step {
            width: 20px;
            height: 20px;
            background: #6c757d;
            border-radius: 50%;
            display: inline-block;
        }
        .progress-bar-step.active .step {
            background: #28a745;
        }
        .progress-bar-step span {
            display: block;
            margin-top: 10px;
        }
    </style>
</head>
<body>
    <div class="form-container">
        <form action="submit.php" method="post" novalidate>
            <h4>Your estimate is almost ready</h4>
            <div class="form-group">
                <label for="name">Name</label>
                <input type="text" class="form-control" id="name" name="name" placeholder="Name" required>
                <div class="invalid-feedback">
                    Please provide your name.
                </div>
            </div>
            <div class="form-group">
                <label for="email">Email ID</label>
                <input type="email" class="form-control" id="email" name="email" placeholder="Email ID" required>
                <div class="invalid-feedback">
                    Please provide a valid email address.
                </div>
            </div>
            <div class="form-group">
                <label for="phone">Phone number</label>
                <div class="input-group">
                    <div class="input-group-prepend">
                        <span class="input-group-text">🇮🇳</span>
                    </div>
                    <input type="tel" class="form-control" id="phone" name="phone" placeholder="Phone number" required>
                    <div class="invalid-feedback">
                        Please provide your phone number.
                    </div>
                </div>
            </div>
            <div class="form-group">
                <label for="property">Property Name</label>
                <input type="text" class="form-control" id="property" name="property" placeholder="Property Name" required>
                <div class="invalid-feedback">
                    Please provide the property name.
                </div>
            </div>

            <input type="hidden" name="selectedBhkType" value="<?php echo htmlspecialchars($selectedBhkType); ?>">
            <input type="hidden" name="totalCost" value="<?php echo htmlspecialchars($totalCost); ?>">
            <input type="hidden" name="selectedPackage" value="<?php echo htmlspecialchars($selectedPackage); ?>">
            <input type="hidden" name="roomSelections" value="<?php echo htmlspecialchars(json_encode($roomSelections)); ?>">

            <button type="submit" class="btn btn-primary btn-block">Get My Estimate</button>
        </form>
    </div>

    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.5.2/dist/umd/popper.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
    <script>
        (function () {
            'use strict';
            window.addEventListener('load', function () {
                var forms = document.getElementsByTagName('form');
                Array.prototype.forEach.call(forms, function (form) {
                    form.addEventListener('submit', function (event) {
                        if (form.checkValidity() === false) {
                            event.preventDefault();
                            event.stopPropagation();
                        }
                        form.classList.add('was-validated');
                    }, false);
                });
            }, false);
        })();
    </script>
</body>
</html>