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
                require_once("classes/Getter.class.php");
                $gtter = new Getter();
                $stopList = json_decode($gtter->getStopList(), true);
                foreach ($stopList["stops"] as $key => $value) {
                   echo "<div class=\"stopentry\">";
                   echo "<div class=\"stop-caption\">";
                   echo $value;

                  echo "</div> <input type=\"checkbox\" class=\"favinput\" /> </div>";
               
                }

    


                     ?>
                <div class="stopentry">
                    <div class="stop-caption">Schaffhausen</div>
                    <input type="checkbox" class="favinput" />
                </div>
                <div class="stopentry">
                    <div class="stop-caption">Heiringen</div>
                    <input type="checkbox" class="favinput" />
                </div>
                <div class="stopentry">
                    <div class="stop-caption">Ulm</div>
                    <input type="checkbox" class="favinput" />
                </div>
        </section>
        </div>
    </main>
    <footer>
        Copyright WebEng 2019, Maybe rights are reserved
    </footer>
</body>

</html>