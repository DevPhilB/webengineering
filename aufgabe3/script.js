function orderCards(){
    document.getElementById("scrambleBtn").classList.remove("hidden");
    document.getElementById("orderBtn").classList.add("hidden");
    let flexi = document.getElementById("flexi");
    flexi.classList.add("ordered");
    flexi.classList.remove("unordered");
}

function scrambleCards(){
    document.getElementById("scrambleBtn").classList.add("hidden");
    document.getElementById("orderBtn").classList.remove("hidden");
    let flexi = document.getElementById("flexi");
    flexi.classList.remove("ordered");
    flexi.classList.add("unordered");
}

function columnLayout(){
    document.getElementById("rowBtn").classList.remove("hidden");
    document.getElementById("columnBtn").classList.add("hidden");
    let flexi = document.getElementById("flexi");
    flexi.classList.remove("rows");
    flexi.classList.add("columns");

}

function rowLayout(){
    document.getElementById("rowBtn").classList.add("hidden");
    document.getElementById("columnBtn").classList.remove("hidden");
    let flexi = document.getElementById("flexi");
    flexi.classList.add("rows");
    flexi.classList.remove("columns");

}