function previousSlide() {
    if(i > 1) { // se non siamo già alla prima slide
        i--;
        img.src = data[i]["src"];
        p.textContent = data[i]["text"];
    }
}

function nextSlide() {
    if(i < n) { // se non siamo già all'ultima slide
        i++;
        img.src = data[i]["src"];
        p.textContent = data[i]["text"];
    }
    if(i === n) {
        img.src = data[i]["src"];
        p.textContent = data[i]["text"];
    }
}

// parte responsive
function showMenu(event) {
    const div = document.querySelector("nav div");

    div.classList.toggle("menu-show");
}

function onJson(json) {
    div_res.innerHTML = "";
    div_res.classList.remove("hidden");

    if(json.empty == true) {
        // non ci sono contenuti
        const p_err = document.createElement("p");
        p_err.textContent = "Nessun risultato, cerca altro";
        p_err.classList.add("err");
        div_res.appendChild(p_err);
    }
    else {
        // ci sono contenuti
        const res = json.results;
        const titolo = document.createElement("p");
        const contenuto = document.createElement("p");
        const p_log = document.createElement("p");
        const a = document.createElement("a");

        titolo.textContent = res[0].titolo + " - @" + res[0].username;
        contenuto.textContent = res[0].contenuto;
        p_log.textContent = "Vuoi leggere più articoli? ";
        a.textContent = "ISCRIVITI ORA";
        a.href = "signup.php";

        titolo.classList.add("title");
        p_log.appendChild(a);
        div_res.appendChild(titolo);
        div_res.appendChild(contenuto);
        div_res.appendChild(p_log);
    }
}

function onResponse(response) {
    return response.json();
}

function showArt(event) {
    event.preventDefault();

    if(form.search.value == "") {
        div_res.classList.remove("hidden")
        const p_err = document.createElement("p");
        p_err.textContent = "Digitare una ricerca";
        p_err.classList.add("err");
        div_res.appendChild(p_err);
    }
    else {
        const text = encodeURIComponent(form.search.value);
        console.log(text);

        fetch("fetch_single_art.php?q=" + text).then(onResponse).then(onJson);
    }
}

const menu = document.querySelector("#menu-mobile");
const form = document.forms["search-art"];
const div_res = document.querySelector("#results-1");
const next = document.querySelector("#next");
const back = document.querySelector("#back");
let i = 1; // slide da cui partire
const n = 3; // numero di slide massimo
const img = document.querySelector("#row1 img");
const p = document.querySelector("#row1 p");
const data = {
    1: {
        src: "background-2850204_1280.jpg",
        text: "Registrati e inizia subito a scrivere. Dal tuo account potrai recensire direttamente libri a tua scelta. Divertiti a scrivere e riscrivere!",
    },
    2: {
        src: "a-book-2265490_1280.jpg",
        text: "Cerca suggerimenti per le tue prossime letture, addentrati nel mondo dei libri. Aggiungi al tuo elenco i volumi che presto comprerai!",
    },
    3: {
        src: "books-3322275_1920.jpg",
        text: "Qui potrai divertirti leggendo e scrivendo recensioni sui tuoi libri preferiti. Cerca gli articoli di altri utenti, leggi le loro opinioni su libri già letti o che vorresti leggere.",
    }
};

next.addEventListener("click", nextSlide);
back.addEventListener("click", previousSlide);
form.addEventListener("submit", showArt);
menu.addEventListener("click", showMenu);

// all'inizio carica sempre la prima immagine e il primo paragrafo
img.src = data[1]["src"];
p.textContent = data[1]["text"];