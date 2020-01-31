// 2a) 
function load(url,
    onComplete,
    onError) {
    fetch(url)
        .then((response) => {
            onComplete(response.json());
        })
        .catch((error) => {
            onError();
        });
}

// 2a)
function onComplete(response) {
    // gets the data from json
    alert(response);
}

function onError() {
    // throws error
}

// 2b)
myStorage = localStorage;

function getFavorite() {
    if (localStorage.length == 0) {
        return 0;
    }
    return localStorage.id;
}


function setFavorite(id, name) {
    localStorage.setItem(id, name);
}



var stopList;
// 2c) // http://morgal.informatik.uni-ulm.de:8000/line/stop
function loadStops(id) {
    // call load stop.
}

function loadStop(id) {
    return fetch("http://morgal.informatik.uni-ulm.de:8000/line/stop/" + id + "/")
        .then(response => response.json());
}


// 2d)
function toId(string) {
    var index;
    for (index = 0; index < stopList.stops.length; ++index) {
        if (stopList.stops[index] == string) {
            return index;
        }
    }
}
