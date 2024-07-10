<?php
session_start();
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $_SESSION['selectedBhkType'] = $_POST['bhkType'];
    $_SESSION['selectedBhkSize'] = isset($_POST['bhkSize']) ? $_POST['bhkSize'] : [];
    header("Location: selectrooms.php");
    exit();
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Room Design Selection</title>
    <link href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.1/css/all.min.css" rel="stylesheet">
    <link rel="stylesheet" href="styles.css">
    <link rel="icon" href="images/Basil-Homes.png" type="image/x-icon">
</head>
<body>
    <div class="mt-5 d-flex justify-content-center">
        <div class="card p-4 shadow-lg">
            <!-- BHK Type Selection -->
            <div class="text-center mb-4">
                <h2>Select your BHK type</h2>
                <p>To know more about this, <a href="#" data-toggle="modal" data-target="#infoModal">click here</a></p>
            </div>
            <!-- BHK Type Form -->
            <form id="bhkForm" method="POST" action="">
                <div class="form-check mb-3">
                    <input class="form-check-input" type="radio" name="bhkType" id="bhk1" value="1 BHK" onclick="toggleSubOptions('')">
                    <label class="form-check-label" for="bhk1">1 BHK</label>
                </div>
                <div class="form-check mb-3">
                    <input class="form-check-input" type="radio" name="bhkType" id="bhk2" value="2 BHK" onclick="toggleSubOptions('bhk2SubOptions')">
                    <label class="form-check-label" for="bhk2">2 BHK <span class="arrow-icon">&#9660;</span></label>
                    <div id="bhk2SubOptions" class="sub-options">
                        <div class="form-check">
                            <input class="form-check-input" type="checkbox" name="bhkSize[]" id="bhk2Small" value="Small">
                            <label class="form-check-label" for="bhk2Small">Small (Below 800 sq ft)</label>
                        </div>
                        <div class="form-check">
                            <input class="form-check-input" type="checkbox" name="bhkSize[]" id="bhk2Large" value="Large">
                            <label class="form-check-label" for="bhk2Large">Large (Above 800 sq ft)</label>
                        </div>
                    </div>
                </div>
                <div class="form-check mb-3">
                    <input class="form-check-input" type="radio" name="bhkType" id="bhk3" value="3 BHK" onclick="toggleSubOptions('bhk3SubOptions')">
                    <label class="form-check-label" for="bhk3">3 BHK <span class="arrow-icon">&#9660;</span></label>
                    <div id="bhk3SubOptions" class="sub-options">
                        <div class="form-check">
                            <input class="form-check-input" type="checkbox" name="bhkSize[]" id="bhk3Small" value="Small">
                            <label class="form-check-label" for="bhk3Small">Small (Below 1000 sq ft)</label>
                        </div>
                        <div class="form-check">
                            <input class="form-check-input" type="checkbox" name="bhkSize[]" id="bhk3Large" value="Large">
                            <label class="form-check-label" for="bhk3Large">Large (Above 1000 sq ft)</label>
                        </div>
                    </div>
                </div>
                <div class="form-check mb-3">
                    <input class="form-check-input" type="radio" name="bhkType" id="bhk4" value="4 BHK" onclick="toggleSubOptions('bhk4SubOptions')">
                    <label class="form-check-label" for="bhk4">4 BHK <span class="arrow-icon">&#9660;</span></label>
                    <div id="bhk4SubOptions" class="sub-options">
                        <div class="form-check">
                            <input class="form-check-input" type="checkbox" name="bhkSize[]" id="bhk4Small" value="Small">
                            <label class="form-check-label" for="bhk4Small">Small (Below 1200 sq ft)</label>
                        </div>
                        <div class="form-check">
                            <input class="form-check-input" type="checkbox" name="bhkSize[]" id="bhk4Large" value="Large">
                            <label class="form-check-label" for="bhk4Large">Large (Above 1200 sq ft)</label>
                        </div>
                    </div>
                </div>
                <div class="form-check mb-3">
                    <input class="form-check-input" type="radio" name="bhkType" id="bhk5" value="5 BHK" onclick="toggleSubOptions('bhk5SubOptions')">
                    <label class="form-check-label" for="bhk5">5 BHK <span class="arrow-icon">&#9660;</span></label>
                    <div id="bhk5SubOptions" class="sub-options">
                        <div class="form-check">
                            <input class="form-check-input" type="checkbox" name="bhkSize[]" id="bhk5Small" value="Small">
                            <label class="form-check-label" for="bhk5Small">Small (Below 1400 sq ft)</label>
                        </div>
                        <div class="form-check">
                            <input class="form-check-input" type="checkbox" name="bhkSize[]" id="bhk5Large" value="Large">
                            <label class="form-check-label" for="bhk5Large">Large (Above 1400 sq ft)</label>
                        </div>
                    </div>
                </div>
                <div class="d-flex justify-content-between">
                    <!-- <button type="button" class="btn btn-secondary" onclick="history.back()">Back</button> -->
                    <button type="submit" class="btn btn-custom">Next</button>
                </div>
            </form>
        </div>
    </div>
    <!-- Modal -->
    <div class="modal fade" id="infoModal" tabindex="-1" aria-labelledby="infoModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="infoModalLabel">Why it matters</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    The configuration and size of your home give us a better idea of the magnitude of the project and help us calculate the full home interior cost.
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                </div>
            </div>
        </div>
    </div>
    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.3/dist/umd/popper.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
    <script>
        function toggleSubOptions(id) {
            const subOptions = document.querySelectorAll('.sub-options');
            subOptions.forEach(option => {
                if (option.id === id) {
                    option.style.display = 'block';
                } else {
                    option.style.display = 'none';
                }
            });
        }
    </script>
</body>
</html>
