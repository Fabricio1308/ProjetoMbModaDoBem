const form = document.getElementById('form');
const username = document.getElementById('username');
const email = document.getElementById('email');
const password = document.getElementById('password');
const passwordsonfirmation = document.getElementById('passwordsonfirmation');

form.addEventListener("submit", (e) => {
    e.preventDefault();
    checkInputs();

});

function checkInputs(){
    const usernameValue = username.value;
    const emailValue = email.value;
    const passwordValue = password.value;
    const passwordconfirmationValue = passwordconfirmation.value;

    if (usernameValue = "" ) {

        setErrorFor(username, "o nome e obrigatorio");
    }

}

function setErrorFor(input, message) {
    const formControl = input.parentElement;
    const small = formControl.querySelector('small');

    small.innerText = message;

    formControl.className = "form-control error";

}
