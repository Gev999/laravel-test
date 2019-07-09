import React from 'react';
import { Route, Redirect } from 'react-router-dom';

const PrivateRoute = ({ component: Component, ...rest }) => (
    <Route {...rest} render={(props) => (
        hasAccess()
            ? <Component {...props} />
            : <Redirect to='/login' />
    )} />
)

const hasAccess = ()=> {
    const token = localStorage.getItem('token');
    if (!token) return false;
    const decodedToken = JSON.parse(atob(token.split('.')[1]));
    const currentTime = Date.now() / 1000;
    if (decodedToken.exp < currentTime) {
        localStorage.removeItem('token');
        return false;
    }
    return true;
}

export default PrivateRoute;