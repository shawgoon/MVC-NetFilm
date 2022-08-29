class CardsFrame extends React.Component {
    constructor(props){
        super(props);
        this.state = {films:props.filmsProps}
        console.dir(props.filmsProps);
    }
    render(){
        return(
            <div className="cardsFrame">
                { this.state.films.map((value,index)=>{
                    return <Card info={value} key={index}/>
                })}
                
            </div>
        )
    }
}
function Card(props){
    return(
        <div className="card">
            <div>
                <h3 className="title">{props.info.title}</h3>
            </div>
            <div className="cardImg">
                <img src={props.info.urlFilm} alt=""/>
            </div>
            <ul>
                <p>Year:</p>
                <li className="year">{props.info.year}</li>
                <p>Genres:</p>
                <li className="genres">{props.info.genres}</li>
                <p>Directors:</p>
                <li className="directors">{props.info.directors}</li>
                <p>Cast:</p>
                <li className="cast">{props.info.cast}</li>
                <p>Plot:</p>
                <li className="plot">{props.info.plot}</li>
            </ul>
        </div>
    )
}

ReactDOM.render(<CardsFrame filmsProps={films}></CardsFrame>,document.getElementById("cardsFrame"));