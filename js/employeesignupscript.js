const form = document.getElementById('form');
const id = document.getElementById('id');
const Fname = document.getElementById('fname');
const Lname = document.getElementById('lname');
const JobTitle = document.getElementById('jtitle');
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
const idValue = id.value.trim();
const fnameValue = Fname.value.trim();
const lnameValue = Lname.value.trim();
const jtitleValue = JobTitle.value.trim();
const passwordValue = password.value.trim();
var letters = /^[A-Za-z]+$/;
var letterspace = /^[a-zA-Z\s]*$/;
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




if (fnameValue === '') {
setError(Fname, 'First name is required');
} else {
if (fnameValue.match(letters)) {
setSuccess(Fname);
cnt++;
}
else {
setError(Fname, 'First name should contains letters only');
}
}




if (lnameValue === '') {
setError(Lname, 'Last name is required');
} else {
if (lnameValue.match(letters)) {
setSuccess(Lname);
cnt++;
}
else {
setError(Lname, 'Last name should contains letters only');
}
}




if (jtitleValue === '') {
setError(JobTitle, 'Job Title is required');
} else {
if (jtitleValue.match(letterspace)) {
setSuccess(JobTitle);
cnt++;
}
else {
setError(JobTitle, 'Job Title should contains letters only');
}
}

if (passwordValue === '') {
setError(password, 'Password is required');
} else if (passwordValue.length < 8) {
setError(password, 'Password must be at least 8 character.')
} else {
setSuccess(password);
cnt++;
}

if (cnt == 5){
document.form.submit();
}

}