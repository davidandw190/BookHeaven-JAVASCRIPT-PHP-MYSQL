let userBox = document.querySelector('.header .header-2 .user-box');

document.querySelector('#user-btn').onclick = () =>{
   userBox.classList.toggle('active');
   navbar.classList.remove('active');
}

let navbar = document.querySelector('.header .header-2 .navbar');

document.querySelector('#menu-btn').onclick = () =>{
   navbar.classList.toggle('active');
   userBox.classList.remove('active');
}

window.onscroll = () =>{
   userBox.classList.remove('active');
   navbar.classList.remove('active');

   if(window.scrollY > 60){
      document.querySelector('.header .header-2').classList.add('active');
   }else{
      document.querySelector('.header .header-2').classList.remove('active');
   }
}

const scrollableContainer = document.querySelector('.scrollable-container');
const prevBtn = document.querySelector('.prev-btn');
const nextBtn = document.querySelector('.next-btn');

prevBtn.addEventListener('click', () => {
   scrollableContainer.scrollBy({
      left: -scrollableContainer.offsetWidth,
      behavior: 'smooth'
   });
});

nextBtn.addEventListener('click', () => {
   scrollableContainer.scrollBy({
      left: scrollableContainer.offsetWidth,
      behavior: 'smooth'
   });
});

// Get all product boxes
const boxes = document.querySelectorAll('.box');

// Get the modal and its elements
const modal = document.getElementById('modal');
const modalImage = document.getElementById('modal-image');
const modalName = document.getElementById('modal-name');
const modalPrice = document.getElementById('modal-price');
const modalAddToCart = document.getElementById('modal-add-to-cart');
const modalAddToFavorites = document.getElementById('modal-add-to-favorites');
const modalClose = document.getElementsByClassName('modal-close')[0];

// Loop through each product box and add click event listener
boxes.forEach(box => {
   box.addEventListener('click', () => {
      // Get the product details from the clicked box
      const image = box.querySelector('.image').getAttribute('src');
      const name = box.querySelector('.name').textContent;
      const price = box.querySelector('.price').textContent;

      // Update the modal content with the product details
      modalImage.setAttribute('src', image);
      modalName.textContent = name;
      modalPrice.textContent = price;

      // Show the modal
      modal.style.display = 'block';
   });
});

// Add click event listener to close the modal
modalClose.addEventListener('click', () => {
   modal.style.display = 'none';
});


// Loop through each close button and add event listener to close the modal
closeBtns.forEach(function (button) {
   button.addEventListener('click', function () {
      const modal = button.parentNode.parentNode.parentNode;
      modal.style.display = 'none';
   });
});