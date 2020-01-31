<!DOCTYPE html>
<html>
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

        <title>WebEng 2019 - Haltestellen</title>
        <link href='http://fonts.googleapis.com/css?family=Roboto' rel='stylesheet' type='text/css'>
        <link rel="stylesheet" href="style.css">
        <!-- 2) text. -->
        <script src="js/util.js"></script>
    </head>
    <body>
        <?php
            //initialize stop data
            require_once("classes/Getter.class.php");
            $a = new Getter();
            $stopsList = $a -> getStopList();
        ?>
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
            <section>
                <input type="text" id="filterBox" placeholder="Filter"/>
                <!--Generate list of stops as options-->
                <?php foreach($stopsList as $index => $name){ ?>
                <div class="stopentry" id="stop-<?=$index ?>">
                    <span class="stop-caption"><?=$name ?></span>
                    <input type="checkbox" class="favinput" id="fav-<?=$index ?>"/>
                </div>
                <?php } ?>
            </section>
        </main>
        <footer>
                Copyright WebEng 2019, Maybe rights are reserved
        </footer>
    </body>
</html>
