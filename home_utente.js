// CANCELLAZIONE LIBRI SALVATI
function onJsonDeleteBook(json) {
    const id_libro = String(json.book);
    const button = document.querySelector(`[data-book-id="${id_libro}"]`);
    const p = button.parentNode;

    if(json.delete == true) { // cancellazione fatta
        p.textContent = "Libro eliminato";
    }
    else {
        p.textContent = "Cancellazione fallita";
    }

    setTimeout(fetchBook, 4000);
}

function onResponseDeleteBook(response) {
    return response.json();
}

function deleteBook(event) {
    const id_libro = event.currentTarget.dataset.bookId;

    fetch("delete_book.php?q=" + id_libro).then(onResponseDeleteBook).then(onJsonDeleteBook);
}

// CARICAMENTO DEI LIBRI SALVATI
function onJsonBook(json) {
    if(json.empty == true) { // controllo per vedere se l'utente non ha scritto nessun articolo, per cui non c'è un contenuto da visualizzare
        const par = document.createElement("span");
        par.textContent = "Non hai ancora salvato un libro";
        par.classList.add("p-none");
        div_libri.appendChild(par);
    }
    else {
        /* visualizzazione dei contenuti */
        const data = json.results;
        const titolo = document.createElement("p"); // contiene il titolo della colonna

        div_res1.classList.add("div-res1");
        titolo.textContent = "Titolo";
        div_res1.appendChild(titolo);

        for (const key of data) {
            const button = document.createElement("button");
            const row = document.createElement("p");

            row.classList.add("row1");
            row.textContent = key.titolo;
            button.dataset.bookId = key.id_libro;
            button.textContent = "delete";
            button.classList.add("button-delete");
            button.classList.add("material-icons");
            button.addEventListener("click", deleteBook);

            row.appendChild(button);
            div_res1.appendChild(row);
        }
        
        div_libri.appendChild(div_res1);
    }
}

function onResponseBook(response) {
    return response.json();
}

// CANCELLAZIONE DELLE RECENSIONI SCRITTE
function onJsonDeleteArt(json) {
    const id_art = String(json.article);
    const button = document.querySelector(`[data-article-id="${id_art}"]`);
    const div = button.parentNode;
    const p = document.createElement("p");
    
    div.innerHTML = "";

    if(json.delete == true) { // cancellazione fatta
        p.textContent = "Recensione cancellata";
    }
    else {
        p.textContent = "Cancellazione fallita";
    }

    div.appendChild(p);

    setTimeout(fetchArticle, 4000);
}

function onResponseDeleteArt(response) {
    return response.json();
}

function deleteArticle(event) {
    const id_article = event.currentTarget.dataset.articleId;

    fetch("delete_article.php?q=" + id_article).then(onResponseDeleteArt).then(onJsonDeleteArt);
}

// CARICAMENTO DELLE RECENSIONI SCRITTE
function onJsonArt(json) {
    if(json.empty == true) { // controllo per vedere se l'utente non ha scritto nessun articolo, per cui non c'è un contenuto da visualizzare
        const par = document.createElement("span");
        par.textContent = "Non hai ancora scritto nessuna recensione";
        par.classList.add("p-none");
        div_articoli.appendChild(par);
    }
    else {
        /* visualizzazione dei contenuti */
        const data = json.results;
        const title_row = document.createElement("div"); /* contiene i titoli della tabella */
        const titolo = document.createElement("p");
        const contenuto = document.createElement("p");

        div_res.classList.add("div-res");

        titolo.textContent = "Titolo";
        contenuto.textContent = "Contenuto";
        title_row.appendChild(titolo);
        title_row.appendChild(contenuto);
        div_res.appendChild(title_row);
        title_row.classList.add("title-row");

        for (const key of data) {
            const button = document.createElement("button");
            const row = document.createElement("div");
            const t = document.createElement("p");
            const c = document.createElement("p");

            row.classList.add("row");

            t.textContent = key.titolo;
            c.textContent = key.contenuto;
            t.classList.add("t");

            button.dataset.articleId = key.id_articolo;
            button.textContent = "delete";
            button.classList.add("button-delete");
            button.classList.add("material-icons");
            button.addEventListener("click", deleteArticle);
            
            div_res.appendChild(row);
            row.appendChild(t);
            row.appendChild(c);
            row.appendChild(button);
        }

        div_articoli.appendChild(div_res);
    }
}

function onResponseArt(response) {
    return response.json();
}

function fetchBook() {
    div_res1.innerHTML = "";
    fetch("loadBooks.php").then(onResponseBook).then(onJsonBook); // caricamento dei contenuti della prima colonna
}

function fetchArticle() {
    div_res.innerHTML = "";
    fetch("loadArticles.php").then(onResponseArt).then(onJsonArt); // caricamento dei contenuti della seconda colonna
}

function showMenu(event) {
    const div = document.querySelector("nav div");

    div.classList.toggle("menu-show");
}

const menu = document.querySelector("#menu-mobile");
const div_articoli = document.querySelector("section .col-2");
const div_libri = document.querySelector("section .col-1");
const div_res = document.querySelector("section .col-2 div"); /* div che contiene i risultati */
const div_res1 = document.querySelector("section .col-1 div"); /* div che contiene i risultati */

fetchBook();
fetchArticle();
menu.addEventListener("click", showMenu);