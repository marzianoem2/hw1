function toggleEye() {
    if(log_form.password.type === "password") {
        log_form.password.type = "text";
        eye.textContent = "visibility_off";
    }
    else {
        log_form.password.type = "password";
        eye.textContent = "visibility";
    }
}

function sendCred(event) {
    const error_span = document.querySelector("#section-log-in .col-2 .errors");

    if(log_form.username.value == "" || log_form.password.value == "") { // controllo per verificare che l'utente abbia riempito tutti i campi
        error_span.textContent = "Inserire le credenziali";
        event.preventDefault();
    }
}

const log_form = document.forms["form-log-in"];
const eye = document.querySelector(".toggle-eye");

log_form.addEventListener("submit", sendCred);
eye.addEventListener("click", toggleEye);