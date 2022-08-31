const searchInput = document.querySelector("[placeholder='search']"); //console.dir(searchInput);
const suggestList = document.getElementById('list');
const xhrurl = suggestList.dataset.xhrurl;
let id_movie = "";
const searchBtn = document.getElementById("searchBtn");
searchInput.addEventListener(
    'keyup',
    ()=>{
        // pour obtenir la valeur de mon input
        let result = searchInput.value;
        //  j'ai besoin d'appeler request.php pour obtenir mes résultat AJAX
        fetch(xhrurl+"?resultat="+result)
        // j'attend l'execution de ma requete
        .then((reponse)=>{
            // ne pas oublier le return
        //    return reponse.text(); // console.dir(reponse);
           return reponse.json();
            // j'attend ma réponse au format texte
        // }).then((texte)=>{
        //     console.log(texte);
        //  je met le tout au format json
        }).then((json)=>{
            // console.dir(json);
            autoComplete(json);
        })
    }
); 

// créer un fonction qui affichera mes résultats de request.php sous l'input

function autoComplete(json){
    if (json.length !== 0){ // reset list 
        suggestList.innerHTML = "";
        let resultList = "";
        json.forEach(element => {
            // console.log(element.title);
            resultList += `<li onclick="validTitle('${element.title}','${element.id_movie}')">${element.title}</li>`;
        });
        suggestList.innerHTML = resultList;
    } else {
        suggestList.innerHTML = 'aucun  résultat'; 
    }
}
function validTitle(value,id){
    console.log(value);
    searchInput.value = value;
    suggestList.innerHTML = "";
    resultList = "";
    id_movie = id;
}
searchBtn.addEventListener("click",()=>{
    if(id_movie !== ""){
        location.href = searchBtn.dataset.xhrurl+"?id_movie="+id_movie;
    }
})

// pour fermer la fenêtre de suggetion en sortant du focus de l'input
// searchInput.addEventListener("blur",()=>{
//     suggestList.innerHTML = "";
// })
