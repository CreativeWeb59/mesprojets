var lienSupr=document.getElementById('lienSupr');

function clickForm() {

    let lienauclick = document.getElementById("js-produits-form-supr");
    let conf = confirm('Etes vous sûr ?');
    if (conf == true){
        lienauclick.submit();
    }
}

//evennements associés au clic sur le lien
lienSupr.addEventListener("click", clickForm);