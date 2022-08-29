let limit = 0;
$.post("./admin/select.php", (data, status)=>{
    console.dir(status);
    console.dir(typeof(data));
    let json = $.parseJSON(data);
    console.dir(json);
    cardGenerator(json);
});
function cardGenerator(json){
    let cards = "";
    json.forEach(element => {
        cards += 
        `<div id="card">
            <div>
                <p id="title">${element.title}</p>
            </div>
            <div id="cardImg">
                <img src="assets/img/${element.id_movie}.jpg" alt="">
            </div>
            <ul>
                <p>Year:</p>
                <li id="year">${element.year}</li>
                <p>Genres:</p>
                <li id="genres">${element.genres}</li>
                <p>Directors:</p>
                <li id="directors">${element.directors}</li>
                <p>Cast:</p>
                <li id="cast">${element.cast}</li>
                <p>Plot:</p>
                <li id="plot">${element.plot}</li>
            </ul>
        </div>`
    });
    $("#cardsFrame").append(cards);
}
