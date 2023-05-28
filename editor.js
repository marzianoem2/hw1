function checkInput(event) {
    const s_error = document.querySelector(".error");

    // controllo per verificare che siano stati riempiti i campi
    if(form_e.titolo.value == "" || form_e.contenuto.value == "") {
        s_error.textContent = "Riempi tutti i campi";
        event.preventDefault();
    }
}

const form_e = document.forms["form-edit"];

form_e.addEventListener("submit", checkInput); 