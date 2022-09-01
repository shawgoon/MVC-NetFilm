class CardsFrame extends React.Component {
    constructor(props){
        super(props);
        this.state = {
            films: props.filmsProps,
            dCard: props.displayCard,
            // url: props.url

        }
        // console.dir(props.filmsProps);
    }
    render(){
        return(
            <div className="cardsFrame">
                { this.state.films.map((value,index)=>{
                    return <Card info={value} 
                    key={index} 
                    dCard={this.state.dCard}
                    url={this.props.url}
                    xhrUrl={this.props.xhrUrl}
                    session_id={this.props.session_id}
                    />
                })}
                
            </div>
        )
    }
}
function Card(props){
    function goToSingle(id_movie){
        location.href = props.url+"?id_movie="+id_movie;
    }
    function addToPref(id_movie){
        fetch(props.xhrUrl+"?id_movie="+id_movie+"&id_user=".props.session_id).then(
            (response)=>response.text()
        ).then((result)=>{
            console.log(result);
        })
    }
    return(
        <div className="card">
            <div>
                <h3 className="title">{props.info.title}</h3>
            </div>
            <div className="cardImg">
                <img src={props.info.urlFilm} alt=""/>
            </div>
            <ul>
                <p>Year</p>
                <li className="year">{props.info.year}</li>
                <p>Genres</p>
                <li className="genres">{props.info.genres}</li>
                <p>Directors</p>
                <li className="directors">{props.info.directors}</li>
                <p>Cast</p>
                <li className="cast">{props.info.cast}</li>
                <p>Plot</p>
                <li className="plot">{props.info.plot}</li>
            </ul>

            {props.dCard ? 
            <button type="button" 
            onClick={()=>{goToSingle(props.info.id_movie)}} 
            className="infoFilm">Fiche du film</button> : ""}
            
            <button type="button" 
            onClick={()=>{addToPref(props.info.id_movie,props.session_id)}}
            className="addList">Ajouter à ma liste</button>
        </div>
    )
}

ReactDOM.render(<CardsFrame 
filmsProps={films} 
displayCard={dCard}
url={url}
xhrUrl={xhrUrl}
session_id={session_id}>

</CardsFrame>,document.getElementById("cardsFrame"));