const form = document.getElementById('form');
const username = document.getElementById('username');
const password = document.getElementById('password');




const setError = (element, message) => {
const inputControl = element.parentElement;
const errorDisplay = inputControl.querySelector('.error');



errorDisplay.innerText = message;
inputControl.classList.add('error');
inputControl.classList.remove('success')
}



const setSuccess = element => {
const inputControl = element.parentElement;
const errorDisplay = inputControl.querySelector('.error');



errorDisplay.innerText = '';
inputControl.classList.add('success');
inputControl.classList.remove('error');
};

function validateInputs() {
const usernameValue = username.value.trim();
const passwordValue = password.value.trim();
var cnt = 0;

if (usernameValue === '') {
setError(username, 'Username is required');
} else {
setSuccess(username);
cnt++;
}

if (passwordValue === '') {
setError(password, 'Password is required');
} else if (passwordValue.length < 8) {
setError(password, 'Password must be at least 8 character.')
} else {
setSuccess(password);
cnt++;
}

if (cnt == 2){
document.form.submit();
}

}