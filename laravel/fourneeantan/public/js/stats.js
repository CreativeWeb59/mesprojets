/* Fonction tracerGraphe */
function tracergraphique() {

    /* Données à représenter graphiquement */
    var donnees = google.visualization.arrayToDataTable([
        ['Navigateur web', 'Parts de marché en %'],
        ['IE + Edge', 7],
        ['Safari', 19],
        ['Firefox', 10],
        ['Chrome', 55],
        ['Opera', 3],
        ['Autres', 6]
    ]);


    /* Options de représentation graphique */
    /* NB1 : La 4ème série (numérotation à partir de 0 des séries) est une moyenne représentée par une ligne */
    /* NB2 : Pour les nombreuses options veuillez consulter
    /*      : https : https://developers.google.com/chart/interactive/docs/gallery/combochart */

    var options = {
        title : 'Parts de marché occupées par les navigateurs actuels',
        vAxis: {title: "Navigateur web"},
        hAxis: {title: "Parts de marché en %"},
        seriesType: 'bars',
        series: {3: {type: 'line'}}
      };

    /* Instanciation du graphique */
    let chart = new google.visualization.ComboChart(document.getElementById('chart_Graphique'));
    
        /* Dessin du graphique */
    chart.draw(donnees, options);

}

//evennements associés au clic sur le bouton

var evtAfficher = document.querySelector('#boutAfficherGraphique');
evtAfficher.addEventListener("click", tracergraphique);

