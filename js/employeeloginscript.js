const form = document.getElementById('form');
const id = document.getElementById('id');
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



function validateInputs(){
const idValue = id.value.trim();
const passwordValue = password.value.trim();
var numbers = /^[0-9]+$/;
var cnt = 0;

if (idValue === '') {
setError(id, 'Employee\'s ID is required');
} else {
if (idValue.match(numbers)) {
setSuccess(id);
cnt++;
}
else {
setError(id, 'ID should contains numbers only');
}
}
if(passwordValue === '') {
setError(password, 'Password is required');
} else if (passwordValue.length < 8 ) {
setError(password, 'Password must be at least 8 character.')
} else {
setSuccess(password);
cnt++;
}

if (cnt == 2){
document.form.submit();
}

}