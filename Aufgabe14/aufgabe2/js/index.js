window.onload = function () {
    initData();

};
var idFavorite = 1;

// 3a)
function loadFavorite() {
    fetch("http://morgal.informatik.uni-ulm.de:8000/line/stop/" + idFavorite + "/")
        .then(response => response.json())
        .then(json => {
            var stops = json;
            setFavorite(stops["id"], stops["name"]);
            callback();
        });
}

// 3b)
function callback() {
    var store = getFavorite(idFavorite);
    console.log("store " + store);
    var favDep = document.getElementById("favname");
    favDep.innerHTML = "Favorit Haltestelle: " + store;
}

// 3c)
function initData() {
    loadFavorite();
    setInterval(updateDepatures, 5000);
}

function updateDepatures() {
    console.log("update");
    fetch("http://morgal.informatik.uni-ulm.de:8000/line/stop/" + idFavorite + "/departure/")
        .then(response => response.json())
        .then(json => {
            json.forEach(element => {
                console.log(element);
                var dep = element;
                var favDep = document.getElementById("favdepartures");
                var li = document.createElement("li");
                favDep.innerHTML = "";
                // Load the stop name with the fitting id. 
                var stop = loadStop(dep["heading"]);
                stop.then(json => {
                    var stop = json["name"];
                    li.innerHTML = dep["time"] + " Line: " + dep["display"] + "(" + stop + ")";
                    favDep.appendChild(li);
                })
            })
        });
}
