<?php

// error_reporting(0);
session_start();
require "database.php";

if (!$_SESSION["redirected"]) {
    header("Location: index.php");
    session_unset();
    exit;
}

$details_one = $_SESSION["details_one"];
$details_two = $_SESSION["details_two"];


function printer($i, $details)
{
    if ($details[$i] != "") {
        if ($i >= 32) {
            if ($details[32] != "") {
                $result = $details[32];
                echo '<div class="row">
                <span class="term">Power Pack:</span>
                <span class="description">' . $result . '</span>
                </div>';
            }
            if ($details[33] != "") {
                $result = $details[33];
                echo '<div class="row">
                <span class="term">Power Pack:</span>
                <span class="description">' . $result . '</span>
                </div>';
            } else {
                $result = $details[34];
                echo '<div class="row">
                <span class="term">Range:</span>
                <span class="description">' . $result . '</span>
                </div>';
            }
        } else if ($i == 7) {
            $result = substr($details[7], 0, strpos($details[7], "RPM") + 3);
            echo $result;
        } else if ($i == 8) {
            $result = substr($details[8], 0, strpos($details[8], "RPM") + 3);
            echo $result;
        } else {
            echo $details[$i];
        }
    }else if($i<32){
        echo "-";
    }
}

session_unset();

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
        <div class="details-wrapper">
            <div class="card-wrapper">
                <div class="big-cards">
                    <div class="image-card card-styling">
                        <div class="image-container">
                            <img alt="car" src="<?php echo $details_one[35] ?>">
                        </div>
                        <div class="title-info">
                            <div class="row">
                                <span class="term">Make:</span>
                                <span class="description"><?php echo $details_one[1] ?></span>
                            </div>
                            <div class="row">
                                <span class="term">Model:</span>
                                <span class="description"><?php echo $details_one[2] ?></span>
                            </div>
                            <div class="row">
                                <span class="term">Years in Prod:</span>
                                <span class="description"><?php echo $details_one[4] ?></span>
                            </div>
                        </div>
                    </div>
                    <div class="card-styling">
                        <div>
                            <div class="row">
                                <span class="term">Cylinders:</span>
                                <span class="description"><?php printer(5, $details_one); ?></span>
                            </div>
                            <div class="row">
                                <span class="term">Displacement:</span>
                                <span class="description"><?php printer(6, $details_one); ?></span>
                            </div>
                            <div class="row">
                                <span class="term">Power:</span>
                                <span class="description"><?php printer(7, $details_one); ?></span>
                            </div>
                            <div class="row">
                                <span class="term">Torque:</span>
                                <span class="description"><?php printer(8, $details_one); ?></span>
                            </div>
                            <div class="row">
                                <span class="term">Fuel System:</span>
                                <span class="description"><?php printer(9, $details_one); ?></span>
                            </div>
                            <div class="row">
                                <span class="term">Fuel:</span>
                                <span class="description"><?php printer(10, $details_one); ?></span>
                            </div>
                            <div class="row">
                                <span class="term">Fuel capacity:</span>
                                <span class="description"><?php printer(11, $details_one); ?></span>
                            </div>
                        </div>
                    </div>
                    <div class="card-styling">
                        <div>
                            <div class="row">
                                <span class="term">Top Speed:</span>
                                <span class="description"><?php printer(12, $details_one); ?></span>
                            </div>
                            <div class="row">
                                <span class="term">Acceleration 0-62 MPH:</span>
                                <span class="description"><?php printer(13, $details_one); ?></span>
                            </div>
                        </div>
                    </div>
                    <div class="card-styling">
                        <div>
                            <div class="row">
                                <span class="term">Top Speed:</span>
                                <span class="description"><?php printer(14, $details_one); ?></span>
                            </div>
                            <div class="row">
                                <span class="term">Acceleration 0-62 MPH:</span>
                                <span class="description"><?php printer(15, $details_one); ?></span>
                            </div>
                        </div>
                    </div>
                    <div class="card-styling">
                        <div>
                            <div class="row">
                                <span class="term">Front Brake:</span>
                                <span class="description"><?php printer(16, $details_one); ?></span>
                            </div>
                            <div class="row">
                                <span class="term">Rear Brake:</span>
                                <span class="description"><?php printer(17, $details_one); ?></span>
                            </div>
                            <div class="row">
                                <span class="term">Tire Size:</span>
                                <span class="description"><?php printer(18, $details_one); ?></span>
                            </div>
                        </div>
                    </div>
                    <div class="card-styling">
                        <div>
                            <div class="row">
                                <span class="term">Length:</span>
                                <span class="description"><?php printer(19, $details_one); ?></span>
                            </div>
                            <div class="row">
                                <span class="term">Width:</span>
                                <span class="description"><?php printer(20, $details_one); ?></span>
                            </div>
                            <div class="row">
                                <span class="term">Height:</span>
                                <span class="description"><?php printer(21, $details_one); ?></span>
                            </div>
                            <div class="row">
                                <span class="term">Front/Rear Track:</span>
                                <span class="description"><?php printer(22, $details_one); ?></span>
                            </div>
                            <div class="row">
                                <span class="term">Wheelbase:</span>
                                <span class="description"><?php printer(23, $details_one); ?></span>
                            </div>
                            <div class="row">
                                <span class="term">Ground Clearance:</span>
                                <span class="description"><?php printer(24, $details_one); ?></span>
                            </div>
                            <div class="row">
                                <span class="term">Cargo Volume:</span>
                                <span class="description"><?php printer(25, $details_one); ?></span>
                            </div>
                            <div class="row">
                                <span class="term">Aerodynamics (CD):</span>
                                <span class="description"><?php printer(26, $details_one); ?></span>
                            </div>
                            <div class="row">
                                <span class="term">Unladen Weight:</span>
                                <span class="description"><?php printer(27, $details_one); ?></span>
                            </div>
                        </div>
                    </div>
                    <div class="card-styling">
                        <div>
                            <div class="row">
                                <span class="term">City Economy:</span>
                                <span class="description"><?php printer(28, $details_one); ?></span>
                            </div>
                            <div class="row">
                                <span class="term">Highway Economy:</span>
                                <span class="description"><?php printer(29, $details_one); ?></span>
                            </div>
                            <div class="row">
                                <span class="term">Combined:</span>
                                <span class="description"><?php printer(30, $details_one); ?></span>
                            </div>
                            <div class="row">
                                <span class="term">CO2 Emissions:</span>
                                <span class="description"><?php printer(31, $details_one); ?></span>
                            </div>
                            <?php
                            printer(32, $details_one);
                            printer(33, $details_one);
                            printer(34, $details_one);
                            ?>
                        </div>
                    </div>
                </div>
                <div id="hideme" class="big-cards">
                    <div class="image-card card-styling">
                        <div class="image-container">
                            <img alt="car" src="<?php echo $details_two[35] ?>">
                        </div>
                        <div class="title-info">
                            <div class="row">
                                <span class="term">Make:</span>
                                <span class="description"><?php echo $details_two[1] ?></span>
                            </div>
                            <div class="row">
                                <span class="term">Model:</span>
                                <span class="description"><?php echo $details_two[2] ?></span>
                            </div>
                            <div class="row">
                                <span class="term">Years in Prod:</span>
                                <span class="description"><?php echo $details_two[4] ?></span>
                            </div>
                        </div>
                    </div>
                    <div class="card-styling">
                        <div>
                            <div class="row">
                                <span class="term">Cylinders:</span>
                                <span class="description"><?php printer(5, $details_two); ?></span>
                            </div>
                            <div class="row">
                                <span class="term">Displacement:</span>
                                <span class="description"><?php printer(6, $details_two); ?></span>
                            </div>
                            <div class="row">
                                <span class="term">Power:</span>
                                <span class="description"><?php printer(7, $details_two); ?></span>
                            </div>
                            <div class="row">
                                <span class="term">Torque:</span>
                                <span class="description"><?php printer(8, $details_two); ?></span>
                            </div>
                            <div class="row">
                                <span class="term">Fuel System:</span>
                                <span class="description"><?php printer(9, $details_two); ?></span>
                            </div>
                            <div class="row">
                                <span class="term">Fuel:</span>
                                <span class="description"><?php printer(10, $details_two); ?></span>
                            </div>
                            <div class="row">
                                <span class="term">Fuel capacity:</span>
                                <span class="description"><?php printer(11, $details_two); ?></span>
                            </div>
                        </div>
                    </div>
                    <div class="card-styling">
                        <div>
                            <div class="row">
                                <span class="term">Top Speed:</span>
                                <span class="description"><?php printer(12, $details_two); ?></span>
                            </div>
                            <div class="row">
                                <span class="term">Acceleration 0-62 MPH:</span>
                                <span class="description"><?php printer(13, $details_two); ?></span>
                            </div>
                        </div>
                    </div>
                    <div class="card-styling">
                        <div>
                            <div class="row">
                                <span class="term">Top Speed:</span>
                                <span class="description"><?php printer(14, $details_two); ?></span>
                            </div>
                            <div class="row">
                                <span class="term">Acceleration 0-62 MPH:</span>
                                <span class="description"><?php printer(15, $details_two); ?></span>
                            </div>
                        </div>
                    </div>
                    <div class="card-styling">
                        <div>
                            <div class="row">
                                <span class="term">Front Brake:</span>
                                <span class="description"><?php printer(16, $details_two); ?></span>
                            </div>
                            <div class="row">
                                <span class="term">Rear Brake:</span>
                                <span class="description"><?php printer(17, $details_two); ?></span>
                            </div>
                            <div class="row">
                                <span class="term">Tire Size:</span>
                                <span class="description"><?php printer(18, $details_two); ?></span>
                            </div>
                        </div>
                    </div>
                    <div class="card-styling">
                        <div>
                            <div class="row">
                                <span class="term">Length:</span>
                                <span class="description"><?php printer(19, $details_two); ?></span>
                            </div>
                            <div class="row">
                                <span class="term">Width:</span>
                                <span class="description"><?php printer(20, $details_two); ?></span>
                            </div>
                            <div class="row">
                                <span class="term">Height:</span>
                                <span class="description"><?php printer(21, $details_two); ?></span>
                            </div>
                            <div class="row">
                                <span class="term">Front/Rear Track:</span>
                                <span class="description"><?php printer(22, $details_two); ?></span>
                            </div>
                            <div class="row">
                                <span class="term">Wheelbase:</span>
                                <span class="description"><?php printer(23, $details_two); ?></span>
                            </div>
                            <div class="row">
                                <span class="term">Ground Clearance:</span>
                                <span class="description"><?php printer(24, $details_two); ?></span>
                            </div>
                            <div class="row">
                                <span class="term">Cargo Volume:</span>
                                <span class="description"><?php printer(25, $details_two); ?></span>
                            </div>
                            <div class="row">
                                <span class="term">Aerodynamics (CD):</span>
                                <span class="description"><?php printer(26, $details_two); ?></span>
                            </div>
                            <div class="row">
                                <span class="term">Unladen Weight:</span>
                                <span class="description"><?php printer(27, $details_two); ?></span>
                            </div>
                        </div>
                    </div>
                    <div class="card-styling">
                        <div>
                            <div class="row">
                                <span class="term">City Economy:</span>
                                <span class="description"><?php printer(28, $details_two); ?></span>
                            </div>
                            <div class="row">
                                <span class="term">Highway Economy:</span>
                                <span class="description"><?php printer(29, $details_two); ?></span>
                            </div>
                            <div class="row">
                                <span class="term">Combined:</span>
                                <span class="description"><?php printer(30, $details_two); ?></span>
                            </div>
                            <div class="row">
                                <span class="term">CO2 Emissions:</span>
                                <span class="description"><?php printer(31, $details_two); ?></span>
                            </div>
                            <?php
                            printer(32, $details_two);
                            printer(33, $details_two);
                            printer(34, $details_two);
                            ?>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </main>
</body>

</html>