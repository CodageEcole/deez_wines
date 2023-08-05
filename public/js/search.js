document.addEventListener('DOMContentLoaded', function () {
    const searchInput = document.getElementById('searchInput');
    const searchResults = document.querySelector('.carte-vin-container');

    // Fonction qui récupère les images de pastille
    function getPastilleClass(image_pastille_alt) {
        switch (image_pastille_alt) {
            case "Pastille de goût : Fruité et vif":
                return "fv";
            case "Pastille de goût : Aromatique et charnu":
                return "ac";
            case "Pastille de goût : Aromatique et rond":
                return "ar";
            case "Pastille de goût : Aromatique et souple":
                return "as";
            case "Pastille de goût : Délicat et léger":
                return "dl";
            case "Pastille de goût : Fruité et doux":
                return "fd";
            case "Pastille de goût : Fruité et généreux":
                return "fg";
            case "Pastille de goût : Fruité et léger":
                return "fl";
            case "Pastille de goût : Fruité et vif":
                return "fv";
            case "Pastille de goût : Fruité et extra-doux":
                return "fed";
            default:
                return "";
        }
    }

    // Fonction qui récupère les labels de pastille pour extraire le nom de la pastille
    function getPastilleLabel(image_pastille_alt) {
        const parts = image_pastille_alt.split(":");
        return parts.length === 2 ? parts[1].trim() : image_pastille_alt;
    }   

    // Fonction qui crée le HTML d'une carte de vin
    function createCardHtml(bouteille) {
        const pastilleClass = getPastilleClass(bouteille.image_pastille_alt);

        //On genere le html de la carte
        const cardHTML = `
            <div class="carte-vin-container">
                ${pastilleClass ? `<div class="bande-de-gout-${pastilleClass}"><span>${getPastilleLabel(bouteille.image_pastille_alt)}</span></div>` : ''}
                <div class="carte-vin ${!bouteille.image_pastille_alt ? 'no-pastille' : ''}">
                    <picture class="protruding">
                    ${bouteille.est_personnalisee
                        ? `<img src="/glide/imagesPersonnalisees/${bouteille.image_bouteille}?p=maquette" alt="${bouteille.nom}">`
                        : `<img src="/glide/images/${bouteille.image_bouteille}?p=maquette" alt="${bouteille.image_bouteille_alt}">`
                    }
                    </picture>
                    <section>
                    <a href="/bouteilles/${bouteille.id}"><h2>${bouteille.nom}</h2></a>
                    <div>
                        <p>
                            ${bouteille.couleur_fr ? bouteille.couleur_fr + " | " : ""}
                            ${bouteille.format ? bouteille.format + " | " : ""}
                            ${bouteille.pays_fr ? bouteille.pays_fr : ""}
                        </p>
                    </div>
                    </section>
                    <div class="overlap" data-nom="${bouteille.nom}" data-id="${bouteille.id}" onclick='openModal("${bouteille.nom.replace(/'/g, '&#39;')}","${bouteille.id}")'>
                        <p class="invisible-385px">${bouteille.message}</p>
                        <img src="/icons/plus_icon.svg" alt="Plus">
                    </div>
                </div>
            </div>
        `;

        return cardHTML;
    }

    function handleSearchInput() {
        const searchTerm = searchInput.value.trim();

        searchTerm.length > 0 ?
            // Récupérer les résultats de recherche 
            fetchSearchResults(searchTerm) : 
            // Vider les résultats de recherche
            searchResults.innerHTML = '';
    }

    // Fonction pour récupérer les résultats de recherche
    function fetchPaginatedResults(url) {
        window.scroll({ top: 0, left: 0, behavior: 'smooth' });
        // Récupérer les résultats de recherche
        axios.get(url)
        .then(response => {
            const responseData = response.data;
            const bouteilles = responseData.data;
        
            // Générer le HTML des résultats de recherche
            let resultsHTML = '';
            bouteilles ?
                bouteilles.forEach(bouteille => {
                    resultsHTML += createCardHtml(bouteille);
                }) :
                resultsHTML = '<p>No results found.</p>';

            // Ajouter les résultats de recherche au container searchResults
            searchResults.innerHTML = resultsHTML;
            // Ajouter la pagination au container searchResults
            let links = responseData.links;
            // Add the pagination links to the searchResults container
            const paginationHTML = responseData.links
                ? `
                <ul class="pagination">
                    <a class="page-link ${links[0].url ? '' : 'disabled' }" href="${links[1].url}">prem.</a>

                    <a class="page-link ${links[0].url ? '' : 'disabled' }" href="${links[0].url}">prec.</a>

                    <input type="number" class="numeroPage" value="${links.some(link => link.active) ? links.find(link => link.active).label : 1}" min="1" max="${links[links.length-2].label}">

                    <a class="page-link ${links[links.length-1].url ? '' : 'disabled' }" href="${links[links.length-1].url}">suiv.</a>
                    
                    <a class="page-link ${links[links.length-2].active ? 'disabled' : '' }" href="${links[links.length-2].url}">dern.</a>
                </ul>
                `
                : '';

            // Ajouter la pagination au container searchResults
            searchResults.insertAdjacentHTML('beforeend', paginationHTML);

            const paginationLinks = document.querySelectorAll('.pagination a.page-link');
            // Ajouter un event listener sur les liens de pagination
            paginationLinks.forEach(link => {
                link.addEventListener('click', function (event) {
                    event.preventDefault();
                    const url = this.getAttribute('href');
                    // Récupérer les résultats de recherche
                    fetchPaginatedResults(url);
                });
            });

            // Récupération du bouton de pagination
            const boutonPagination = document.querySelector(".numeroPage");
            // Ajouter un event listener sur le bouton de pagination
            boutonPagination.addEventListener("keydown", function(event) {
                // si la touche entrée est pressée, on empeche le comportement par défaut et on change l'url
                if (event.key === "Enter" || event.keyCode === 13) {
                    event.preventDefault();
                    // attributions des valeurs dans des variables pour rendre le tout plus lisible
                    const numeroPage = parseInt(boutonPagination.value);
                    const dernierePage = links[links.length-2].label;
                    let url;
                    numeroPage >= 1 && numeroPage <= dernierePage ? 
                        // si le numero de page est entre 1 et le nombre de page max, on change l'url
                        url = links[1].url.replace("page=1", "page=" + numeroPage) :
                        // sinon on change l'url pour la premiere page
                        url = links[1].url;
                    // Récupérer les résultats de recherche
                    fetchPaginatedResults(url);
                }
            });
        })
        .catch(error => {
            console.error('Error fetching paginated results:', error);
            searchResults.innerHTML = '<p>Error fetching results. Please try again later.</p>';
        });
    }

    function fetchSearchResults(searchTerm) {
        const url = `/bouteilles?query=${encodeURIComponent(searchTerm)}`;
        fetchPaginatedResults(url);
    }

    // Ajout d'un event listener sur l'input de recherche
    searchInput.addEventListener('input', handleSearchInput);
});
