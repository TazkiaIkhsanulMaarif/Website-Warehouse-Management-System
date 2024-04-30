const container1 = document.querySelector('.container1');
const link_login = document.querySelector('.link_login');
const link_register = document.querySelector('.link_register');

link_register.addEventListener('click', ()=>{
    container1.classList.remove('active');
});

link_login.addEventListener('click', ()=>{
    container1.classList.add('active');
});


const btnPopup = document.querySelector('.btnlogin');
btnPopup.addEventListener('click', ()=>{
    container1.classList.add('active-popup');
});

const iconclose = document.querySelector('.icon-loss');
iconclose.addEventListener('click', ()=>{
    container1.classList.remove('active-popup');
});