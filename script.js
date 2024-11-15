let searchForm = document.querySelector('.search-form-container');
let cart = document.querySelector('.shopping-cart-container');
let loginForm = document.querySelector('.login-form-container');

document.querySelector('#search-btn').onclick = () => {
    searchForm.classList.toggle('active');
    cart.classList.remove('active');
    loginForm.classList.remove('active');
};

document.querySelector('#cart-btn').onclick = () => {
    cart.classList.toggle('active');
    searchForm.classList.remove('active');
    loginForm.classList.remove('active');
};

document.querySelector('#login-btn').onclick = () => {
    loginForm.classList.toggle('active');
    searchForm.classList.remove('active');
    cart.classList.remove('active');
};

document.querySelectorAll('.fa-times').forEach(item => {
    item.onclick = () => {
        item.parentElement.remove();
    };

    
    

});

