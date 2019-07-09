import React, { Component } from 'react';
import { Link, Redirect } from 'react-router-dom';

class Header extends Component
{
    constructor() {
        super();
        this.state = {
            toShow: true,
        }
        this.logOutHandle = this.logOutHandle.bind(this);
    }

    logOutHandle() {
        localStorage.removeItem('token');
        this.setState({toShow: false});
    }

    render() {
    if (!this.state.toShow) {
        return <Redirect to='/login' />
    }
    return (
        <React.Fragment>
            <nav className="navbar navbar-default">
                <div className="container mt-4">
                    <div>
                        <Link to="/" className="navbar-brand">Home</Link>
                        <Link to="/companies" className="btn btn-outline-secondary mr-4 ml-4">Companies</Link>
                        <Link to="/employees" className="btn btn-outline-secondary">Employees</Link>
                    </div>
                    <button className="btn btn-link" onClick={this.logOutHandle}>Log out</button>
                </div>
            </nav>
            <hr />
        </React.Fragment>
    )}
}

export default Header;