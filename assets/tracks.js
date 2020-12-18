import './styles/app.css';
import React, {Component} from 'react';

class Tracks extends Component {
    constructor(props) {
        super(props);
        this.state = {
            tracks: [],
            params: {
                limit: 10,
                orderDirection: 0,
            }
        };
    }

    componentDidMount() {
        this.fetchData();
    }

    fetchData() {
        fetch("http://localhost:8000/tracks")
            .then(res => res.json())
            .then(
                result => {
                    const data = [...result];

                    this.setState({
                        tracks: data
                    });
                },
            )
    }

    handleSortColumnClick() {
        fetch("http://localhost:8000/tracksSorted")
            .then(res => res.json())
            .then(
                result => {
                    this.setState({
                        tracks: [...result]
                    });
                },
            )
    }

    handleFilterTableChange() {
        console.log('Kek');
    }

    render() {
        const {tracks} = this.state;
        const filterGenres = ["Все", ...new Set(tracks.map(track => track.genre))];
        const filterSingers = ["Все", ...new Set(tracks.map(track => track.singer))];

        return (
            <div className="content__block container">

                <div className="playlist__block col-md-8">
                    <h2>Плейлист</h2>
                    <table className="table table-striped">
                        <thead>
                        <tr>
                            <th
                                onClick={() => this.handleSortColumnClick()}>
                                Исполнитель
                                <span className="table-sort-icon">&#9650;</span>
                            </th>
                            <th>Песня</th>
                            <th>Жанр</th>
                            <th>Год</th>
                        </tr>
                        </thead>

                        <tbody>
                        {tracks.map(track => (
                            <tr key={track.id}>
                                <td>{track.singer}</td>
                                <td>{track.song}</td>
                                <td>{track.genre}</td>
                                <td>{track.year}</td>
                            </tr>
                        ))}
                        </tbody>
                    </table>
                </div>

                <div className="filter__block col-md-4">
                    <h2>Фильтр</h2>

                    <div className="filter__item">
                        <label>Жанр</label>
                        <select className="form-control" onChange={() => this.handleFilterTableChange()}>
                            {filterGenres
                                .map((filter, index) => (
                                    <option key={index} value={filter}>
                                        {filter}
                                    </option>
                                ))}
                        </select>
                    </div>

                    <div className="filter__item">
                        <label>Исполнитель</label>
                        <select className="form-control" onChange={() => this.handleFilterTableChange()}>
                            {filterSingers
                                .map((filter, index) => (
                                    <option key={index} value={filter}>
                                        {filter}
                                    </option>
                                ))}
                        </select>
                    </div>
                </div>


            </div>
        );
    }
}

export default Tracks;