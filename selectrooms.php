<?php
session_start();
if (!isset($_SESSION['selectedBhkType'])) {
    header("Location: package.php");
    exit();
}

$selectedBhkType = $_SESSION['selectedBhkType'];
$selectedBhkSize = isset($_SESSION['selectedBhkSize']) ? $_SESSION['selectedBhkSize'] : [];
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Room Design Selection</title>
    <link href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="style.css">
    <link rel="icon" href="images/Basil-Homes.png" type="image/x-icon">
    <script>
        const selectedBhkType = <?php echo json_encode($selectedBhkType); ?>;
        const bhkConfig = {
            '1 BHK': {rooms: ['Living Room', 'Kitchen', 'Bedroom', 'Bathroom', 'Dining'], maxCount: 1},
            '2 BHK': {rooms: ['Living Room', 'Kitchen', 'Bedroom', 'Bathroom', 'Dining'], maxCount: 2},
            '3 BHK': {rooms: ['Living Room', 'Kitchen', 'Bedroom', 'Bathroom', 'Dining'], maxCount: 3},
            '4 BHK': {rooms: ['Living Room', 'Kitchen', 'Bedroom', 'Bathroom', 'Dining'], maxCount: 4},
            '5 BHK': {rooms: ['Living Room', 'Kitchen', 'Bedroom', 'Bathroom', 'Dining'], maxCount: 5}
        };

        const roomCosts = {
            'Living Room': 8000,
            'Kitchen': 7000,
            'Bedroom': 9000,
            'Bathroom': 5000,
            'Dining': 15000
        };

        const config = bhkConfig[selectedBhkType] || {rooms: [], maxCount: 1};
        const rooms = config.rooms;
        const maxCount = config.maxCount;

        function changeValue(roomId, delta) {
            const input = document.getElementById(roomId);
            let value = parseInt(input.value);
            value += delta;
            if (value < 1) {
                value = 1;
            } else if (value > maxCount) {
                value = maxCount;
            }
            input.value = value;
        }

        function submitForm() {
            let totalCost = calculateTotalCost();
            let roomSelections = {};
            rooms.forEach(room => {
                const roomId = room.toLowerCase().replace(/ /g, '');
                roomSelections[room] = parseInt(document.getElementById(roomId).value);
            });

            fetch('actions/store_total_cost.php', {
                method: 'POST',
                headers: {
                    'Content-Type': 'application/json',
                },
                body: JSON.stringify({ totalCost: totalCost, roomSelections: roomSelections })
            }).then(response => {
                if (!response.ok) {
                    throw new Error('Network response was not ok');
                }
                return response.json();
            }).then(data => {
                window.location.href = 'package.php';
            }).catch((error) => {
                console.error('Error:', error);
            });
        }

        function calculateTotalCost() {
            let totalCost = 0;
            rooms.forEach(room => {
                const roomId = room.toLowerCase().replace(/ /g, '');
                const count = parseInt(document.getElementById(roomId).value);
                totalCost += count * roomCosts[room];
            });
            return totalCost;
        }

        function generateRoomInputs() {
            const form = document.getElementById('bhkForm');
            rooms.forEach(room => {
                const roomId = room.toLowerCase().replace(/ /g, '');
                form.insertAdjacentHTML('beforeend', `
                    <div class="form-group row">
                        <label class="col-sm-4 col-form-label">${room}</label>
                        <div class="col-sm-8">
                            <div class="input-group">
                                <div class="input-group-prepend">
                                    <button class="btn btn-danger" type="button" onclick="changeValue('${roomId}', -1)">-</button>
                                </div>
                                <input type="text" class="form-control text-center room-input" id="${roomId}" value="1" readonly>
                                <div class="input-group-append">
                                    <button class="btn btn-success" type="button" onclick="changeValue('${roomId}', 1)">+</button>
                                </div>
                            </div>
                        </div>
                    </div>
                `);
            });
        }

        window.onload = generateRoomInputs;
    </script>
</head>
<body>
    <div class="container mt-5 d-flex justify-content-center">
        <div class="card p-4 shadow-lg form-container">
            <h3 class="text-center mb-4">Select the rooms you’d like us to design</h3>
            <p class="text-center"><a href="#" data-toggle="modal" data-target="#infoModal">To know more about this, click here</a></p>
            <form id="bhkForm">
                <!-- Room inputs will be dynamically generated here -->
            </form>
            <div class="form-buttons">
                <a href="index.php"><button type="button" class="btn btn-secondary">Back</button></a>
                <button type="button" class="btn btn-custom" onclick="submitForm()">Next</button>
            </div>
        </div>
    </div>

    <!-- Modal -->
    <div class="modal fade" id="infoModal" tabindex="-1" role="dialog" aria-labelledby="infoModalLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="infoModalLabel">What's Included</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <p><strong>Living room:</strong> TV unit, false ceiling, shoe rack, sofa, coffee table, wallpapers, curtains, and pooja unit.</p>
                    <p><strong>Kitchen:</strong> Modular kitchen, loft, countertop, appliances, tiling, and utility.</p>
                    <p><strong>Bedroom:</strong> 2-door wardrobe, loft, false ceiling, TV unit, study unit, bed, side table, mattress, and wooden flooring.</p>
                    <p><strong>Other Bedroom:</strong> 2-door wardrobe and loft.</p>
                    <p><strong>Bathroom:</strong> Vanity, tiling, and shower cubicle.</p>
                    <p><strong>Dining:</strong> Crockery unit, dining table with chairs, and false ceiling.</p>
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

</body>
</html>
