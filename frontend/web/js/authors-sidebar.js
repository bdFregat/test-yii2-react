const Preloader = () => <img src="/img/preloader.gif"/>;

class Aurhors extends React.Component {
    constructor(props) {
        super(props);
        this.state = {
            loaded: false
        }
    }

    componentDidMount() {
        this.loadAuthors();
    }

    loadAuthors = () => {
        const that = this;
        this.setState({loading: false});
        $.get('/api/authors', function (response) {
            that.setState({
                loaded: true,
                authors: response,
            })
        });
    };

    sortByName = (prev, next) => {
        if (prev.name > next.name) {
            return 1;
        }
        if (next.name > prev.name) {
            return -1;
        }
        return 0;
    };

    render = () => {
        if (!this.state.loaded) {
            return <Preloader/>
        }
        return <ul>
            {
                this.state
                    .authors
                    .sort(this.sortByName)
                    .map(author => <li key={author.id}>{`${author.name} (${author.books_count})`}</li>)
            }
        </ul>
    }
}

ReactDOM.render(
    <Aurhors/>,
    document.getElementById("authors-list")
);