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

    <title>WebEng 2019 - Routenplaner</title>
    <link href='http://fonts.googleapis.com/css?family=Roboto' rel='stylesheet' type='text/css'>
    <link rel="stylesheet" href="style.css">
</head>

<body>
    <header>
        <h1>Web Engineering Routenplaner</h1>
        <nav>
            <ul>
                <li><a class="active" href="index.php">Home</a></li>
                <li><a href="stops.php">Stops</a></li>
            </ul>
        </nav>
    </header>
    <main class="index-content">

        <section>
            <form class="search-form">
                <input list="stops" class="stop-input" type="text" id="start" placeholder="Starthaltestelle eingeben" />
                <input list="stops" class="stop-input" type="text" id="end" placeholder="Endhaltestelle eingeben" />
                <button class="stop-btn">➤</button>
            </form>
            <div id="result">
                Linie 15 (Ulm Willy-Brandt-Platz):<br>
                Ulm Universit&auml;t West (13:36) -> Ulm Willy-Brandt-Platz (14:04)<br>
                Linie 4 (Grimmelfingen Eisenbahnstrasse): <br>
                Ulm Willy-Brandt-Platz (14:04) -> Ulm Rathaus (14:09)<br>
                Linie 5 (Ludwigsfeld Hasenweg): <br>
                Ulm Rathaus (14:09) -> Neu-Ulm Rathaus (14:11)
            </div>
        </section>

        <aside>
            <h2 id="favname">Favorit: Haltestelle</h2>
            <ul id="favdepartures">
                <li>16:03 Linie 5 (Wissenschaftsstadt)</li>
                <li>16:10 Linie 3 (Wiblingen)</li>
            </ul>
        </aside>

        <!--datalist for auto completion-->
        <datalist id="stops">
            <?php
            // 2. b)
            foreach ($stops as $id => $stop) {
                echo "  <option value=\"".$stop."\" />";
            } ?>
        </datalist>
    </main>
    <footer>
        Copyright WebEng 2019, Maybe rights are reserved
    </footer>
</body>

</html>