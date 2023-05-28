function onJsonBook(json) {
    const id_libro = String(json.id_libro);
    const button = div_res.querySelector(`[data-book-id="${id_libro}"]`);
    const span = document.createElement("span");

    if(json.check_libriSalvati == false || json.check_libro == false) {
        // inserimento fallito
        button.classList.remove("material-icons");
        button.classList.add("hidden");
        span.textContent = "Salvataggio fallito";
        span.classList.add("already-there")
        button.parentNode.appendChild(span);
    }
    else {
        if(json.check_aggiunto == false) {
            // inserimento riuscito
            button.classList.remove("material-icons");
            button.classList.add("hidden");
            span.textContent = "Salvataggio avvenuto";
            span.classList.add("saved");
            button.parentNode.appendChild(span);
        }
        else {
            // libro già presente
            button.classList.remove("material-icons");
            button.classList.add("hidden");
            span.textContent = "Libro già presente";
            span.classList.add("already-there")
            button.parentNode.appendChild(span);
        }
    }
}

function onResponseBook(response) {
    return response.json();
}

function saveBook(event) {
    // salvataggio del libro cliccato
    const id = event.currentTarget.dataset.bookId;
    const title = event.currentTarget.dataset.title;
    const author = event.currentTarget.dataset.author;
    const info = new FormData(); // contiene i dati del libro da inserire poi nel database

    info.append("id", id);
    info.append("title", title);
    info.append("author", author);

    fetch("save_book.php",
    {
        method: "POST",
        body: info
    }).then(onResponseBook).then(onJsonBook);
}

function onJson(json) {
    const res = json.items;
    const lista = document.querySelector("section .list");
    let auth;

    lista.innerHTML = "";
    span_err.classList.add("hidden");
    div_res.classList.remove("hidden");
    div_res.classList.add("results");

    for(let i in res) {
        const element = document.createElement("li");
        const button = document.createElement("button");
        
        if(res[i].volumeInfo.authors != undefined) {
            auth = res[i].volumeInfo.authors[0];
        }
        else {
            auth = "Autore non trovato";
        }
 
        element.textContent = res[i].volumeInfo.title + " (" + auth + ")";
        button.classList.add("button-add");
        button.classList.add("material-icons");
        button.textContent = "bookmark_border";
        button.dataset.bookId = res[i].id;
        button.dataset.title = res[i].volumeInfo.title;
        button.dataset.author = auth;

        element.appendChild(button);
        lista.appendChild(element);

        button.addEventListener("click", saveBook);
    }
}

function onResponse(response) {
    return response.json();
}

function searchData(event) {
    event.preventDefault(); 
    
    if(form_search.search.value == "") {
        div_res.classList.remove("hidden");
        div_res.classList.add("results");
        span_err.classList.remove("hidden");
    }
    else {
        const text = encodeURIComponent(form_search.search.value);

        fetch("fetch_books.php?q=" + text).then(onResponse).then(onJson);
    }
}

const div_res = document.querySelector("section .hidden");
const span_err = div_res.querySelector(".err");
const form_search = document.forms["form-search"];

form_search.addEventListener("submit", searchData);