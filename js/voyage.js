(function () {
  console.log("rest API")
  // URL de l'API REST de WordPress
  let bouton_categorie = document.querySelectorAll(".bouton_categorie");

  bouton_categorie.forEach((button) => {
    button.addEventListener('click', function () {
      let categorie = this.id.split('_')[1];
      let url = `https://gftnth00.mywhc.ca/tim36/wp-json/wp/v2/posts?categories=${categorie}`;

      // Effectuer la requête HTTP en utilisant fetch()
      fetch(url)
        .then(function (response) {
          // Vérifier si la réponse est OK (statut HTTP 200)
          if (!response.ok) {
            throw new Error(
              "La requête a échoué avec le statut " + response.status
            );
          }

          // Analyser la réponse JSON
          return response.json();
        })
        .then(function (data) {
          // La variable "data" contient la réponse JSON
          console.log(data);
          let restapi = document.querySelector(".contenu__restapi");
          restapi.innerHTML = "";
          // Maintenant, vous pouvez traiter les données comme vous le souhaitez
          data.forEach(function (article) {
            let titre = article.title.rendered;
            let contenu = article.content.rendered;
            contenu = contenu.substr(0, 100);
            console.log(titre);
            let carte = document.createElement("div");
            carte.classList.add("restapi__carte");

            carte.innerHTML = `
          <h2>${titre}</h2>
          <p>${contenu}</p>
          `;
            restapi.appendChild(carte);
          });
        })
        .catch(function (error) {
          // Gérer les erreurs
          console.error("Erreur lors de la récupération des données :", error);
        });
    });
  });
})();
