// 2a) 
function load(url,
    onComplete,
    onError) {
    fetch(url)
        .then((response) => {
            onComplete(response.json());
        })
        .catch((error) => {
            onError(error)
        });
}

// 2a)
function onComplete(response) {
    // gets the data from json
    alert(response);
}

function onError(error) {
    // throws error
}

// 2b)
myStorage = localStorage;

function setFavorite(id) {
    localStorage.setItem('id', id);
}

function getFavorite() {
    if (localStorage.length == 0) {
        return 0;
    }
    return localStorage;
}


var stopList;
// 2c) // http://morgal.informatik.uni-ulm.de:8000/line/stop
function loadStops(callback) {

    fetch("http://morgal.informatik.uni-ulm.de:8000/line/stop")
        .then((response) => {
            stopList = JSON.parse(response.json());
            callback();
        });
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
