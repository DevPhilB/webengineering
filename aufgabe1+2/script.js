registerEvents();
// 1.a)and 2a)
var currentCalculation = celsiusToFahrenheit;

function convert() {
    let input = document.getElementsByTagName("input")[0].value;
    let res = currentCalculation(input);
    setOutput(res);
}

function registerEvents() {
    //TODO: register click events for buttons 2b) and 2c)
    document.getElementsByClassName("calcButton")[0].addEventListener("click", () => {
        currentCalculation = celsiusToFahrenheit;
    });
    document.getElementsByClassName("calcButton")[1].addEventListener("click", () => {
        currentCalculation = isPrime;
    });
    document.getElementsByClassName("calcButton")[2].addEventListener("click", () => {
        currentCalculation = reverseString;
    });
    document.getElementsByClassName("calcButton")[3].addEventListener("click", () => {
        currentCalculation = token;
    });
}

function setOutput(value) {
    let out = document.getElementById("output");
    //TODO: unset ghost values class
    out.innerHTML = value;
}

//2e)
function superSafeSignature(inputText) {

    // split teilt array in teil strings -> mit map und charCodeAt(0) wird jede char in zahl umgewandelt(UTF 16) index = 0 => das erste char wird ausgewählt
    let chars = inputText.split("").map(x => x.charCodeAt(0));
    alert(chars);
    let summe = 0;
    let prev = 1;
    // das array char ist falsch benannt weil es eigentlich nur zahlen enthält, sollte besser ints oder numbers heißen.
    // für jede zahl wird nun eine rechnung durchgeführt
    chars.forEach(element => {
        summe += element / prev; // summe wird durch -> element zahl / prev(vorherige element zahl) erhöht
        summe = summe % 1000000; // summe modulo 1000000 -> dadurch zahl nicht mehr als 7 stellen
        alert(summe);
        prev = element; // der teiler prev wird gesetzt
    });
    //Zahl wird multiplizirt und abgerundet, verliert dadurch nachkomma stellen.
    return Math.round(summe * 1000000);
}

//insert conversion functions here
// 1.a)
function celsiusToFahrenheit(celsius) {
    var n = parseInt(celsius);
    var fahrenheit = n * 1.8 + 32;
    return fahrenheit;
}

// 1.b)
function isPrime(input) {
    var n = parseInt(input)
    let prime = true;
    for (let i = 2; i <= Math.sqrt(n); i++) {
        if (n % i == 0) {
            prime = false;
            break;
        }
    }
    return prime && (n > 1);
}

// 1.c)
function reverseString(reverse) {
    let result = "";
    for (var pos = reverse.length - 1; pos >= 0; pos--) {
        result += reverse[pos];
    }
    return result;
}

// 1.d)
function token(input) {
    var partToken = {
        msg: input,
        date: new Date().toISOString(),
    };
    var text = JSON.stringify(partToken);
    var withSignature = superSafeSignature(text);
    var createdToken = {
        token: partToken,
        signature: withSignature,
    };
    return JSON.stringify(createdToken);
}
