function toggleEye() {
    if(sign_form.password.type === "password") {
        sign_form.password.type = "text";
        eye.textContent = "visibility_off";
    }
    else {
        sign_form.password.type = "password";
        eye.textContent = "visibility";
    }
}

/* CONTROLLO USERNAME */
function onJsonUser(json) {
    const username_error = document.querySelector("#username-error");

    if(json.check == false) {
        username_error.textContent = "Username già in uso";
        username_error.classList.remove("hidden");
        username_error.classList.add("errors");
    }
    else {
        username_error.classList.add("hidden");
    }
}

function onResponseUser(response) {
    return response.json();
}

function checkUsername() {
    const check_username = /^[a-z]\w{2,23}[^_]$/i;
    const username = sign_form.username.value;
    const username_error = document.querySelector("#username-error");

    if(!username.match(check_username)) {
        /* lo username inserito non è valido */
        username_error.textContent = "Username non valido";
        username_error.classList.remove("hidden");
        username_error.classList.add("errors");
    }
    else {
        username_error.classList.add("hidden");
        /* lo username inserito è valido ma si deve controllare se esiste già un utente registrato con questo stesso user */
        fetch("check_username.php?q=" + encodeURIComponent(username)).then(onResponseUser).then(onJsonUser);
    }
}

/* CONTROLLO PASSWORD */
function checkPassword() {
    const check_pwd = /^(?=.*?[A-Z])(?=.*?[a-z])(?=.*?[0-9])(?=.*?[#?!@$%^&*-]).{8,}$/;
    const pwd = sign_form.password.value;
    const pwd_error = sign_form.querySelector("#password-error");

    if(!pwd.match(check_pwd)) {
        /* password non valida */
        pwd_error.textContent = "Password non valida";
        pwd_error.classList.remove("hidden");
        pwd_error.classList.add("errors");
    }
    else {
        pwd_error.classList.add("hidden");
    }
}

/* CONTROLLO EMAIL */
function onJsonEmail(json) {
    const email_error = document.querySelector("#email-error");

    if(json.check == false) { // controllo per vedere se l'utente si è già registrato con quella email
        email_error.textContent = "Email già in uso";
        email_error.classList.remove("hidden");
        email_error.classList.add("errors");
    }

    email_error.classList.add("hidden");
}

function onResponseEmail(response) {
    return response.json();
}

function checkEmail() {
    const check_email = /^[a-zA-Z0-9.!#$%&'+\/=?^_`{|}~-]+@[a-zA-Z0-9-]+(?:\.[a-zA-Z0-9-]+)*$/;
    const email = (sign_form.email.value).toLowerCase();
    const email_error = document.querySelector("#email-error");

    if(!email.match(check_email)) {
        /* l'email inserita non è valida */
        email_error.textContent = "Email non valida";
        email_error.classList.remove("hidden");
        email_error.classList.add("errors");
    }
    else {
        email_error.classList.add("hidden");
        /* l'email inserita è valida ma si deve controllare se esiste già un utente registrato con questa stessa email */
        fetch("check_email.php?q=" + encodeURIComponent(email)).then(onResponseEmail).then(onJsonEmail);
    }
}

function sendCred(event) {
    // controllo per verificare che l'utente abbia riempito tutti i campi
    if(sign_form.username.value == "" || sign_form.password.value == "" || sign_form.nome.value == "" || sign_form.cognome.value == "" || sign_form.email.value == "") {
        event.preventDefault();
        const generic_error = document.querySelector("#generic");
        generic_error.classList.remove("hidden");
        generic_error.classList.add("errors");
    }
}

const eye = document.querySelector(".toggle-eye");
const sign_form = document.forms["form-sign-up"]; /* con .forms posso accedere poi ai vari input tramite name */

sign_form.addEventListener("submit", sendCred);

/* il messaggio di errore comparirà quando l'input perde il focus */
sign_form.email.addEventListener("blur", checkEmail);
sign_form.username.addEventListener("blur", checkUsername);
sign_form.password.addEventListener("blur", checkPassword);

eye.addEventListener("click", toggleEye);