import React from 'react';
import { Route, Switch } from 'react-router-dom';
import { PrivateRoute } from '../hoc-helpers';
import Login from '../login';
import Home from '../home';
import { Companies, Company, CompanyCreateOrEdit } from '../companies';
import { ApiServiceProvider } from '../api-service-context';
import ApiService from '../../api-service';

const App = () => {
    const apiService = new ApiService();
    return (
        <ApiServiceProvider value = {apiService}>
            <Switch>
                <PrivateRoute exact path="/" component={Home} />

                <PrivateRoute exact path="/companies/" component={Companies} />
                <PrivateRoute exact path="/companies/:id(\d+)" component={Company} />
                <PrivateRoute exact path="/companies/create" component={CompanyCreateOrEdit} />
                <PrivateRoute exact path="/companies/:id(\d+)/edit" component={CompanyCreateOrEdit} />
                
                <Route exact path="/login" component={Login} />
                <Route render={() => <p>Page not found</p>} />
            </Switch>
        </ApiServiceProvider>
    )
}

export default App;