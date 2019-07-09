import React, { Component } from 'react';
import Header from '../app-header';
import ErrorBoundary from '../error-boundary';
import { withApiService } from '../hoc-helpers';

class Company extends Component {

    constructor(props) {
        super(props);
        this.state = {
            company: null,
            error: null,
        }
        this.apiService = this.props.apiService;

        this.getCompany = this.getCompany.bind(this);
        this.getCompanyRow = this.getCompanyRow.bind(this);
    }

    componentWillMount() {
        this.getCompany();
    }

    getCompany() {
        const { id } = this.props.match.params;
        this.apiService.getCompany(id)
            .then(response => {
                this.setState({
                    company: response,
                })
            })
            .catch(e=>{
                this.setState({
                    error: e.response.data.error,
                })
            })
    }

    getCompanyRow() {
        const { company } = this.state;
        const imgSrc = company.logo ? company.logo : 'default.png'
        return (
            <tr>
                <td><img src={`/storage/logos/${imgSrc}`} style={{width: '50px'}}/></td>
                <td>{company.name}</td>
                <td>{company.email}</td>
                <td>{company.website}</td>
            </tr>
        )
    }

    render() {
        if (this.state.error) {
            return <ErrorBoundary error={this.state.error} />
        }
        const row = this.state.company ? this.getCompanyRow() : null;
        return (
            <React.Fragment>
                <Header />
                <div className="container">
                    <table className="table table-hover table-striped table-border">
                        <thead>
                            <tr>
                                <td className="td-brand">Logo</td>
                                <td className="td-brand">Name</td>
                                <td className="td-brand">Email</td>
                                <td className="td-brand">Website</td>
                            </tr>
                        </thead>
                        <tbody>
                            {row}
                        </tbody>
                    </table>
                </div>
            </React.Fragment>
        )
    }
}

export default withApiService(Company)