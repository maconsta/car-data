<?php

require "database.php";

// fill an array with brand names
$query = "SELECT DISTINCT make FROM data";
$result = mysqli_query($conn, $query);
$brands = mysqli_fetch_all($result); //2d array, car name is always at index [n][0] for 0 <= n < brands array size

?>

<!DOCTYPE HTML>
<html>

<head>
    <meta charset="UTF-8">
    <title>Car Data</title>
    <link rel="stylesheet" type="text/css" href="style.css">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
    <script src="script.js" defer></script>
</head>

<body>
    <header>
        <h1>The most comprehensive car database in the world</h1>
    </header>

    <main>
        <div class="btn-add-car">
            <div class="plus">
            </div>
        </div>
        <div class="form-container">
            <form method=post>
                <select id="brand_one" name="brand" class="brand" required>
                    <option value="">Choose Make</option>
                    <?php
                    for ($i = 0; $i < count($brands); $i++) {
                        echo '<option value="' . strtoupper($brands[$i][0]) . '">' . strtoupper($brands[$i][0]) . '</option>';
                    }
                    ?>
                </select>
                <select id="model_one" name="model" class="model" required>
                    <option value="">Choose Model</option>
                </select>
                <select id="title_one" name="title" class="title" required>
                </select>
            </form>
            <div class="separator"></div>
            <form class="hidden" action="details.php" method=post>
                <select id="brand_two" name="brand" class="brand" required>
                    <option value="">Choose Make</option>
                    <?php
                    for ($i = 0; $i < count($brands); $i++) {
                        echo '<option value="' . strtoupper($brands[$i][0]) . '">' . strtoupper($brands[$i][0]) . '</option>';
                    }
                    ?>
                </select>
                <select id="model_two" name="model" class="model" required>
                </select>
                <select id="title_two" name="title" class="title" required>
                </select>
            </form>
        </div>
        <div id="btn-container">
            <div class="btn-submit">GO</div>
        </div>
    </main>
</body>

</html>