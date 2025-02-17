<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Location Explorer - Split View</title>
    
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
    <link rel="stylesheet" href="https://unpkg.com/leaflet@1.7.1/dist/leaflet.css" />
    <link href="https://fonts.googleapis.com/css2?family=Space+Grotesk:wght@300;400;500;600&display=swap" rel="stylesheet">

    <style>
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }

        body {
            font-family: 'Space Grotesk', sans-serif;
            height: 100vh;
            overflow: hidden;
            background: #f8f9fa;
        }

        .split-container {
            display: flex;
            height: 100vh;
        }

        .sidebar {
            width: 400px;
            background: #ffffff;
            padding: 2rem;
            overflow-y: auto;
            box-shadow: 0 0 20px rgba(0, 0, 0, 0.05);
            z-index: 2;
            position: relative;
        }

        .map-container {
            flex: 1;
            position: relative;
        }

        #map {
            width: 100%;
            height: 100%;
        }

        h2 {
            color: #1a1a1a;
            font-size: 1.8rem;
            margin-bottom: 2rem;
            font-weight: 600;
            display: flex;
            align-items: center;
            gap: 0.5rem;
        }

        .location-step {
            margin-bottom: 2rem;
            opacity: 0.5;
            transition: opacity 0.3s ease;
        }

        .location-step.active {
            opacity: 1;
        }

        .step-number {
            display: inline-block;
            width: 24px;
            height: 24px;
            background: #e9ecef;
            border-radius: 50%;
            text-align: center;
            line-height: 24px;
            font-size: 0.8rem;
            margin-right: 0.5rem;
            transition: background 0.3s ease;
        }

        .location-step.active .step-number {
            background: #007bff;
            color: white;
        }

        label {
            display: flex;
            align-items: center;
            gap: 0.5rem;
            color: #495057;
            font-weight: 500;
            margin-bottom: 0.75rem;
        }

        .form-select {
            border: 2px solid #e9ecef;
            border-radius: 12px;
            padding: 0.8rem;
            font-size: 0.95rem;
            transition: all 0.3s ease;
            background-color: #fff;
        }

        .form-select:focus {
            border-color: #007bff;
            box-shadow: none;
        }

        .location-card {
            background: #f8f9fa;
            border-radius: 12px;
            padding: 1.5rem;
            margin-top: 2rem;
            display: none;
        }

        .location-card.active {
            display: block;
            animation: slideUp 0.4s ease;
        }

        .coordinates {
            display: flex;
            gap: 1rem;
            margin-top: 1rem;
        }

        .coordinate-box {
            background: white;
            padding: 0.75rem;
            border-radius: 8px;
            flex: 1;
            text-align: center;
            box-shadow: 0 2px 4px rgba(0, 0, 0, 0.05);
        }

        .coordinate-label {
            font-size: 0.8rem;
            color: #6c757d;
            margin-bottom: 0.25rem;
        }

        .coordinate-value {
            font-weight: 600;
            color: #007bff;
        }

        @keyframes slideUp {
            from { 
                opacity: 0;
                transform: translateY(20px);
            }
            to {
                opacity: 1;
                transform: translateY(0);
            }
        }

        @media (max-width: 768px) {
            .split-container {
                flex-direction: column;
            }
            
            .sidebar {
                width: 100%;
                height: 50vh;
            }
            
            .map-container {
                height: 50vh;
            }
        }

        .leaflet-popup-content-wrapper {
            border-radius: 12px;
            box-shadow: 0 4px 12px rgba(0, 0, 0, 0.1);
        }

        .leaflet-popup-content {
            margin: 0.8rem 1rem;
            font-family: 'Space Grotesk', sans-serif;
        }
    </style>
</head>

<body>
    <div class="split-container">
        <div class="sidebar">
            <h2>
                <i class="fas fa-location-crosshairs"></i>
                Location Finder
            </h2>
            
            <div class="location-step active">
                <span class="step-number">1</span>
                <label for="countryDropdown">
                    <i class="fas fa-globe"></i> Select Country
                </label>
                <select id="countryDropdown" class="form-select">
                    <option value="">Choose a country</option>
                    <?php
                    include 'db_connect.php';
                    $result = mysqli_query($conn, "SELECT * FROM country");
                    while ($row = mysqli_fetch_assoc($result)) {
                        echo "<option value='{$row['id']}' data-lat='{$row['latitude']}' data-lng='{$row['longitude']}'>{$row['name']}</option>";
                    }
                    ?>
                </select>
            </div>

            <div class="location-step">
                <span class="step-number">2</span>
                <label for="stateDropdown">
                    <i class="fas fa-map"></i> Select State
                </label>
                <select id="stateDropdown" class="form-select" disabled>
                    <option value="">Choose a state</option>
                </select>
            </div>

            <div class="location-step">
                <span class="step-number">3</span>
                <label for="cityDropdown">
                    <i class="fas fa-city"></i> Select City
                </label>
                <select id="cityDropdown" class="form-select" disabled>
                    <option value="">Choose a city</option>
                </select>
            </div>

            <div class="location-card">
                <h5>Location Details</h5>
                <div id="locationDetails"></div>
                <div class="coordinates">
                    <div class="coordinate-box">
                        <div class="coordinate-label">Latitude</div>
                        <div class="coordinate-value" id="lat-value">-</div>
                    </div>
                    <div class="coordinate-box">
                        <div class="coordinate-label">Longitude</div>
                        <div class="coordinate-value" id="lng-value">-</div>
                    </div>
                </div>
            </div>
        </div>

        <div class="map-container">
            <div id="map"></div>
        </div>
    </div>

    <script src="https://unpkg.com/leaflet@1.7.1/dist/leaflet.js"></script>
    
    <script>
    var map = L.map('map', {
        zoomControl: false
    }).setView([20.5937, 78.9629], 3);

    L.tileLayer('https://{s}.tile.openstreetmap.org/{z}/{x}/{y}.png', {
        attribution: '&copy; OpenStreetMap contributors'
    }).addTo(map);

    L.control.zoom({
        position: 'bottomright'
    }).addTo(map);

    var currentMarker = null;

    function updateMap(lat, lng, zoom, label) {
        if (lat && lng) {
            map.setView([lat, lng], zoom, {
                animate: true,
                duration: 1.2
            });

            if (currentMarker) {
                map.removeLayer(currentMarker);
            }

            currentMarker = L.marker([lat, lng]).addTo(map)
                .bindPopup(`<strong>${label}</strong>`)
                .openPopup();

            $('.location-card').addClass('active');
            $('#locationDetails').html(`<p class="mb-3">${label}</p>`);
            $('#lat-value').text(parseFloat(lat).toFixed(4));
            $('#lng-value').text(parseFloat(lng).toFixed(4));
        }
    }

    $('#countryDropdown').change(function () {
        var selectedOption = this.options[this.selectedIndex];
        var lat = selectedOption.getAttribute('data-lat');
        var lng = selectedOption.getAttribute('data-lng');

        updateMap(lat, lng, 5, selectedOption.text);
        
        $('#stateDropdown').prop('disabled', false)
            .closest('.location-step').addClass('active');

        $.get("fetch_states.php", { country_id: $(this).val() }, function (data) {
            $('#stateDropdown').html(data);
            $('#cityDropdown').html('<option value="">Choose a city</option>').prop('disabled', true);
        });
    });

    $('#stateDropdown').change(function () {
        var selectedOption = this.options[this.selectedIndex];
        var lat = selectedOption.getAttribute('data-lat');
        var lng = selectedOption.getAttribute('data-lng');

        updateMap(lat, lng, 7, selectedOption.text);
        
        $('#cityDropdown').prop('disabled', false)
            .closest('.location-step').addClass('active');

        $.get("fetch_cities.php", { state_id: $(this).val() }, function (data) {
            $('#cityDropdown').html(data);
        });
    });

    $('#cityDropdown').change(function () {
        var selectedOption = this.options[this.selectedIndex];
        var lat = selectedOption.getAttribute('data-lat');
        var lng = selectedOption.getAttribute('data-lng');

        updateMap(lat, lng, 10, selectedOption.text);
    });
    </script>
</body>
</html>