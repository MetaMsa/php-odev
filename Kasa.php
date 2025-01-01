<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Kasa</title>
    <link rel="stylesheet" href="https://www.w3schools.com/w3css/4/w3.css">
    <link rel="icon" type="image/x-icon" href="favicon.ico">
    <link rel="stylesheet" href="">
    <script type="text/javascript" src="index.js"></script>
    <script src="https://kit.fontawesome.com/28825630fd.js" crossorigin="anonymous"></script>
    <?php
    session_start();
    if ($_SESSION["roles"] != "2") {
        header("Location: error.php");
    }

    include "db.php";
    $sql = "SELECT SUM(ucret) FROM students WHERE dershane_id = " . $_SESSION["dershane_id"];
    $stmt = $conn->prepare($sql);
    $stmt->execute();
    $result = $stmt->fetchAll();
    $income = $result[0][0];
    $sql = "SELECT * FROM users WHERE dershane_id = " . $_SESSION["dershane_id"];
    $stmt = $conn->prepare($sql);
    $stmt->execute();
    $result = $stmt->fetchAll();
    $outcome = 0;
    for($i = 0; $i < count($result) ; $i++){
        $sql = "SELECT * FROM maaslar WHERE userId = " .  $result[$i]["ID"];
        $stmt = $conn->prepare($sql);
        $stmt->execute();
        $result1 = $stmt->fetchAll();
        for($j = 0; $j < count($result1) ; $j++){
            $outcome += $result1[$j]['miktar'];
        }
    }

    $income_percentage = $income / ($income + $outcome) * 100;
    $outcome_percentage = $outcome / ($income + $outcome) * 100;
    ?>
    <style>
        .chart-container {
            position: relative;
            width: 20rem;
            height: 20rem;
            border-radius: 50%;
            background: conic-gradient(
                rgb(255, 255, 255) 0deg <?php echo $income_percentage; ?>%,
                rgb(0, 0, 0) 0deg <?php echo $outcome_percentage; ?>%
            );
        }

        .chart-incontainer {
            position: relative;
            width: 10rem;
            height: 10rem;
            top: 25%;
            border-radius: 50%;
            z-index: 1;
        }
    </style>
</head>

<body class="w3-green">
    <header>
        <a href="./admin.php" class="w3-margin w3-bar-item w3-button w3-red"><i class="fa-solid fa-arrow-left"></i></a>
    </header>
    <main>
        <center>
            <h2 class="w3-margin w3-padding w3-red w3-xxlarge w3-serif">Gelir-Gider Dengesi</h2>
            <div class="chart-container" style="--income-percentage: 70;">
                <div class="chart-incontainer w3-green">
                </div>
            </div>
        </center>
    </main>
    <footer>
        <div class="w3-center w3-row">
            
        <div class="w3-col m6 l6">
                <h3 class="w3-text-black">Gider</h3>
                <p><?php
                    include "db.php";
                    for($i = 0; $i < count($result) ; $i++){
                        $sql = "SELECT * FROM maaslar WHERE userId = " .  $result[$i]["ID"];
                        $stmt = $conn->prepare($sql);
                        $stmt->execute();
                        $result1 = $stmt->fetchAll();
                        for($j = 0; $j < count($result1) ; $j++){
                            echo "<div class='w3-text-black'> Maaş Ödemesi = " . $result1[$j]['miktar'] . "&#8378;" . "</div>";
                        }
                    }
                    ?></p>
            </div>
            <div class="w3-col m6 l6">
                <h3 class="w3-text-white">Gelir</h3>
                <p>
                    <?php
                    include "db.php";
                    $sql = "SELECT * FROM students WHERE dershane_id = " . $_SESSION["dershane_id"];
                    $stmt = $conn->prepare($sql);
                    $stmt->execute();
                    $result = $stmt->fetchAll();
                    foreach ($result as $row) 
                    {
                        echo "<div class='w3-text-white'> Öğrenci kayıt ücreti = " . $row["ucret"] . "&#8378;" . "</div>";
                    }
                    ?>
                </p>
            </div>
        </div>
    </footer>
</body>

</html>