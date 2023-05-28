function onJson(json) {
    div_res.innerHTML = "";
    div_res.classList.remove("hidden");
    div_res.classList.add("results");

    if(json.empty == true) {
        // non ci sono contenuti
        span_err.classList.remove("hidden");
        span_err.textContent = "Nessun risultato trovato";
        div_res.appendChild(span_err);
    }
    else {
        // ci sono contenuti
        const res = json.results;

        for(let i in res) {
            const row = document.createElement("div");
            const titolo = document.createElement("p");
            const contenuto = document.createElement("p");

            titolo.textContent = res[i].titolo + " - @" + res[i].username;
            contenuto.textContent = res[i].contenuto;

            titolo.classList.add("titolo");
            row.classList.add("row");
            
            row.appendChild(titolo);
            row.appendChild(contenuto);
            div_res.appendChild(row);
        }
    }
}

function onResponse(response) {
    return response.json();
}

function searchArticle(event) {
    event.preventDefault(); 
    
    if(form_search.search.value == "") {
        div_res.classList.remove("hidden");
        div_res.classList.add("results");
        span_err.classList.remove("hidden");
    }
    else {
        const text = encodeURIComponent(form_search.search.value);

        fetch("fetch_articoli.php?q=" + text).then(onResponse).then(onJson);
    }
}

const div_res = document.querySelector("section .hidden"); // contenitore dei risultati
const span_err = div_res.querySelector(".err");
const form_search = document.forms["form-search"];

form_search.addEventListener("submit", searchArticle);