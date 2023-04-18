<?php

    $hotels = [

        [
            'name' => 'Hotel Belvedere',
            'description' => 'Hotel Belvedere Descrizione',
            'parking' => true,
            'vote' => 4,
            'distance_to_center' => 10.4
        ],
        [
            'name' => 'Hotel Futuro',
            'description' => 'Hotel Futuro Descrizione',
            'parking' => true,
            'vote' => 2,
            'distance_to_center' => 2
        ],
        [
            'name' => 'Hotel Rivamare',
            'description' => 'Hotel Rivamare Descrizione',
            'parking' => false,
            'vote' => 1,
            'distance_to_center' => 1
        ],
        [
            'name' => 'Hotel Bellavista',
            'description' => 'Hotel Bellavista Descrizione',
            'parking' => false,
            'vote' => 5,
            'distance_to_center' => 5.5
        ],
        [
            'name' => 'Hotel Milano',
            'description' => 'Hotel Milano Descrizione',
            'parking' => true,
            'vote' => 2,
            'distance_to_center' => 50
        ],

    ];

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="./css/style.css">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Rubik:ital,wght@0,300;0,400;0,500;0,600;0,700;0,800;0,900;1,300;1,400;1,500;1,600;1,700;1,800;1,900&display=swap" rel="stylesheet">
    <title>Hotel</title>
</head>
<body>
    <div class="container">
        <h1>Hotel List</h1>
        <form method="get" action="">
            <label for="parking">Parking:</label>
            <input type="checkbox" id="parking" name="parking" value="1"> <!-- 'parking' set has value of 1 -->
            <label for="rating">Rating:</label>
            <select id="rating" name="rating">
                <option value="">All</option>
                <option value="1">1 star</option>
                <option value="2">2 stars</option>
                <option value="3">3 stars</option>
                <option value="4">4 stars</option>
                <option value="5">5 stars</option>
            </select>
            <input type="submit" value="Filter">
        </form>
        <table class="table">
            <thead>
                <tr>
                    <th scope="col">Hotel Name</th>
                    <th scope="col">Parking</th>
                    <th scope="col">Vote</th>
                    <th scope="col">Center distance</th>
                </tr>
            </thead>
            <tbody>
                <?php
                    // Initial assignment of $filteredHotels == all hotels
                    $filteredHotels = $hotels;

                    // Check if 'parking' parameter is set and has value of 1
                    if (isset($_GET['parking']) && $_GET['parking'] == 1) {
                        // Filter hotels based on 'parking' parameter
                        $filteredHotels = array_filter($filteredHotels, function($hotel) {
                            return $hotel['parking'] == true;
                        });
                    }

                    // Check if 'rating' parameter is not empty
                    if (isset($_GET['rating']) && !empty($_GET['rating'])) {
                        // Get the value of 'rating' parameter
                        $rating = $_GET['rating'];

                        // Filter hotels on 'rating' parameter
                        $filteredHotels = array_filter($filteredHotels, function($hotel) use ($rating) {
                            return $hotel['vote'] >= $rating;
                        });
                    }
                ?>
                <?php foreach ($filteredHotels as $hotel) : ?>
                    <tr>
                        <th scope="row"><?php echo $hotel['name']; ?></th>
                        <td>Parking: <?php echo $hotel['parking'] ? 'Yes' : 'No'; ?></td>
                        <td>Vote: <?php echo $hotel['vote']; ?></td>
                        <td>Distance to center: <?php echo $hotel['distance_to_center']; ?> km</td>
                    </tr>
                <?php endforeach; ?> 
            </tbody>
        </table>
    </div>
</body>
</html>
