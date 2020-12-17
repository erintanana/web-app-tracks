import './styles/app.css';
import React, {Component} from 'react';

class Tracks extends Component {
    constructor(props) {
        super(props);
        this.state = {
            tracks: [],
        };
    }

    componentDidMount() {
        fetch("http://localhost:8000/tracks")
            .then(res => res.json())
            .then(
                result => {
                    this.setState({
                        tracks: [...result]
                    });
                },
                error => {
                    this.setState({
                        tracks: []
                    });
                }
            )
    }

    render() {
        const {tracks} = this.state;

        return (
            <div>
                <h2>Плейлист</h2>
                <table>
                    <tr>
                        <th>Исполнитель</th>
                        <th>Песня</th>
                        <th>Жанр</th>
                        <th>Год</th>
                    </tr>
                    {tracks.map(track => (
                        <tr>
                            <td>{track.singer}</td>
                            <td>{track.song}</td>
                            <td>{track.genre}</td>
                            <td>{track.year}</td>
                        </tr>
                    ))}
                </table>

                <h2>Фильтр</h2>
            </div>
        );
    }
}

export default Tracks;