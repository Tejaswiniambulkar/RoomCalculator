<?php
session_start();
if (!isset($_SESSION['selectedBhkType']) || !isset($_SESSION['totalCost'])) {
    header("Location: index.php");
    exit();
}

$selectedBhkType = $_SESSION['selectedBhkType'];
$totalCost = $_SESSION['totalCost'];

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $selectedPackage = $_POST['package'];
    $packagePrice = (int)$_POST['packagePrice'];
    $_SESSION['selectedPackage'] = $selectedPackage;
    $_SESSION['totalCost'] += $packagePrice;
    header("Location: details.php");
    exit();
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Package Selection</title>
    <link href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="styles.css">
    <link rel="icon" href="images/Basil-Homes.png" type="image/x-icon">
</head>
<body>
    <div class="wrapper">
        <div class="container">
            <div class="text-center mb-4">
                <h2>Pick your package</h2>
            </div>
            <form id="packageForm" method="POST" action="">
                <input type="hidden" id="totalCost" name="totalCost" value="<?php echo $totalCost; ?>">
                <div class="card-container">
                    <div class="card p-3 shadow-lg">
                        <div class="custom-control custom-radio">
                            <input type="radio" id="package1" name="package" value="Essentials (₹₹)" data-price="200000" class="custom-control-input">
                            <label class="custom-control-label" for="package1">
                                <img src="essentials-desktop-1677569928-WCHBw.jpg" alt="Essentials Package">
                                <div class="description">
                                    <h5>Essentials (₹₹)</h5>
                                    <p>A range of essential home interior solutions that's perfect for all your needs.</p>
                                    <div class="features">
                                        <span><i class="fas fa-check green-check"></i> Affordable pricing</span>
                                        <span><i class="fas fa-check green-check"></i> Convenient designs</span>
                                        <span><i class="fas fa-check green-check"></i> Basic accessories</span>
                                    </div>
                                </div>
                            </label>
                        </div>
                    </div>
                    <div class="card p-3 shadow-lg">
                        <div class="custom-control custom-radio">
                            <input type="radio" id="package2" name="package" value="Premium (₹₹₹)" data-price="300000" class="custom-control-input">
                            <label class="custom-control-label" for="package2">
                                <img src="premium-desktop-1677569932-Tc87O.jpg" alt="Premium Package">
                                <div class="description">
                                    <h5>Premium (₹₹₹)</h5>
                                    <p>Superior home interior solutions that will take your interiors to the next level.</p>
                                    <div class="features">
                                        <span><i class="fas fa-check green-check"></i> Mid-range pricing</span>
                                        <span><i class="fas fa-check green-check"></i> Premium designs</span>
                                        <span><i class="fas fa-check green-check"></i> Wide range of accessories</span>
                                    </div>
                                </div>
                            </label>
                        </div>
                    </div>
                    <div class="card p-3 shadow-lg">
                        <div class="custom-control custom-radio">
                            <input type="radio" id="package3" name="package" value="Luxe (₹₹₹₹)" data-price="500000" class="custom-control-input">
                            <label class="custom-control-label" for="package3">
                                <img src="luxe-desktop-1677569931-ZV4Be.jpg" alt="Luxe Package">
                                <div class="description">
                                    <h5>Luxe (₹₹₹₹)</h5>
                                    <p>High-end interior solutions for the ultimate home interior experience you deserve.</p>
                                    <div class="features">
                                        <span><i class="fas fa-check green-check"></i> Elite pricing</span>
                                        <span><i class="fas fa-check green-check"></i> Lavish designs</span>
                                        <span><i class="fas fa-check green-check"></i> Extensive range of accessories</span>
                                    </div>
                                </div>
                            </label>
                        </div>
                    </div>
                </div>
                <div class="navigation-buttons mt-4 text-center">
                    <button type="button" class="btn btn-secondary mr-2" onclick="history.back()">Back</button>
                    <button type="submit" class="btn btn-custom">Next</button>
                </div>
                <input type="hidden" name="packagePrice" id="packagePrice" value="">
            </form>
        </div>
    </div>

    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.3/dist/umd/popper.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
    <script src="https://kit.fontawesome.com/a076d05399.js"></script>
    <script>
        document.getElementById('packageForm').addEventListener('submit', function(e) {
            const selectedPackage = document.querySelector('input[name="package"]:checked');
            if (!selectedPackage) {
                e.preventDefault();
                alert('Please select a package.');
                return;
            }

            const packagePrice = selectedPackage.getAttribute('data-price');
            document.getElementById('packagePrice').value = packagePrice;
        });
    </script>
</body>
</html>
