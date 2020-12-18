import './styles/app.css';
import './bootstrap';
import React, {Component} from 'react';
import ReactDom from 'react-dom';
import Tracks from "./tracks";

class App extends Component {
    render() {
        const columns = ['id', 'singer', 'song', 'genre', 'year'];

        return (
            <Tracks columns={columns}/>
        );
    }
}

ReactDom.render(
    <App/>,
    document.getElementById('root')
);
