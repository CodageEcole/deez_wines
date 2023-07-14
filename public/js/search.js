document.addEventListener('DOMContentLoaded', function() {
    var searchIcon = document.getElementById('search-icon');
    var searchBar = document.getElementById('search-bar');
    var nav = document.querySelector('nav');
    var arrowBack = document.getElementById('arrow-back');

    searchIcon.addEventListener('click', function(e) {
        e.preventDefault();
        nav.style.display = 'none';
        searchBar.style.display = 'flex';
        searchIcon.style.display = 'none';
        searchBar.classList.toggle('active');
    });

    arrowBack.addEventListener('click', function(e) {
        e.preventDefault();
        nav.style.display = 'flex';
        searchBar.style.display = 'none';
        searchIcon.style.display = 'flex';
        searchBar.classList.toggle('active');
    });


});