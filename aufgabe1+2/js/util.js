/*jshint esversion: 6 */

let stopList = null;
const uniBackendUrl = "http://morgal.informatik.uni-ulm.de:8000/line/";
const priceURL = "http://localhost:1339/remote/";

function loadStops(callback) {
    load(uniBackendUrl + "stop/", res => {
        stopList = res.stops;
        console.log(stopList);
        callback();
    }, () => console.log("error: could not load stops"));
}

function toId(stopName) {
    for (let i = 0; i < stopList.length; i++) {
        if (stopList[i] === stopName)
            return i;
    }
    return -1;
}

function setFavorite(id) {
    localStorage.setItem("favorite", "" + id);
}

function getFavorite() {
    let tmp = localStorage.getItem("favorite");
    if(tmp === "" || tmp === null){
        return 0;
    }
    return parseInt(tmp);
}

// Funktion, welche per fetch request eine Resource holt
// @url: Request-URL
// @onComplete: Funktion, welche bei Erfolg ausgeführt werden soll
// @onError: Funktion, welche bei einem Fehler ausgeführt werden soll
function load(url, onComplete, onError) {
    console.log("fetching '" + url + "'");
    fetch(url)
    .then(response => response.json())
    .then(r => onComplete(r))
    .catch(onError);
}


// console tests
// fetch("http://localhost:1339/remote/")
//     .then(response => response.json())
//     .then(res => console.log("prices: "+JSON.stringify(res)));
