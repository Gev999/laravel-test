import React, { Component } from 'react'
import ReactDOM from 'react-dom';
import App from './app';
import { BrowserRouter as Router, Route, Redirect } from 'react-router-dom'
// import Header from './Header'

class Index extends Component {

    render() {
        return (
            <Router>
                <App />
            </Router>
        )
    }
}

ReactDOM.render(<Index />, document.getElementById('app'))