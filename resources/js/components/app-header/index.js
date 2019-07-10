import React from 'react';
import { Link, withRouter } from 'react-router-dom';

const Header = (props)=>{

    return (
        <React.Fragment>
            <nav className="navbar navbar-default">
                <div className="container mt-4">
                    <div>
                        <Link to="/" className="navbar-brand">Home</Link>
                        <Link to="/companies" className="btn btn-outline-secondary mr-4 ml-4">Companies</Link>
                        <Link to="/employees" className="btn btn-outline-secondary">Employees</Link>
                    </div>
                    <button className="btn btn-link" onClick={()=>logOutHandle(props)}>Log out</button>
                </div>
            </nav>
            <hr />
        </React.Fragment>
    )
}

function logOutHandle(props) {
    localStorage.removeItem('token');
    props.history.push('/login');
}

export default withRouter(Header);