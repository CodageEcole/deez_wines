document.addEventListener('DOMContentLoaded', function() {
    var searchIcon = document.getElementById('search-icon');
    var searchBar = document.getElementById('search-bar');
    var nav = document.querySelector('nav');

    searchIcon.addEventListener('click', function(e) {
        e.preventDefault();
        nav.style.display = 'none';
        searchBar.style.display = 'block';
        searchIcon.style.display = 'none';
    });
});