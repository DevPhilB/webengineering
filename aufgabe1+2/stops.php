<?php
// 2. a) loading stp list.
require_once("classes/Getter.class.php");
$gtter = new Getter();
$stops = $gtter->getStopList();
?>
<!DOCTYPE html>
<html>

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <title>WebEng 2019 - Haltestellen</title>
    <link href='http://fonts.googleapis.com/css?family=Roboto' rel='stylesheet' type='text/css'>
    <link rel="stylesheet" href="style.css">
</head>

<body>
    <header>
        <h1>Web Engineering Routenplaner</h1>
        <nav>
            <ul>
                <li><a href="index.php">Home</a></li>
                <li><a class="active" href="stops.php">Stops</a></li>
            </ul>
        </nav>
    </header>
    <main class="stop-content">
        <aside class="map-sidebar">
            <div id="map">
                <img src="map.png" alt="Ansicht der Haltestelle in Google Maps">
            </div>
        </aside>
        <section class="filter">
            <div id="filterInputWrap"><input type="text" id="filterBox" placeholder="Filter" /></div>
            <div class="stoplist">
                <?php
                // 2. c)
                foreach ($stops as $id => $stop) {
                    echo "<div class=\"stopentry\">";
                    echo "<div class=\"stop-caption\">";
                    echo $stop;
                    echo "</div> <input type=\"checkbox\" class=\"favinput\" /> </div>";
                } ?>

            </div>
        </section>
        </div>
    </main>
    <footer>
        Copyright WebEng 2019, Maybe rights are reserved
    </footer>
</body>

</html>