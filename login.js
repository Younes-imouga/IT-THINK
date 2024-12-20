const signupForm = document.querySelector('.signup-form');
const loginForm = document.querySelector('.login-form');
const signupBtn = document.querySelector('.signup-btn');
const loginBtn = document.querySelector('.login-btn');

loginBtn.addEventListener('click', () => {
    signupForm.classList.add('hidden');
    loginForm.classList.remove('hidden');
});

signupBtn.addEventListener('click', () => {
    loginForm.classList.add('hidden');
    signupForm.classList.remove('hidden');
});