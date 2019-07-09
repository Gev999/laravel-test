import React, { Component } from 'react';
import Header from '../app-header';
import { withApiService } from '../hoc-helpers';

class Company extends Component {

    constructor(props) {
        super(props);
        this.state = {
            company: null,
        }
        this.getCompany = this.getCompany.bind(this);
        this.getCompanyRow = this.getCompanyRow.bind(this);
    }

    componentDidMount() {
        this.getCompany();
    }

    getCompany() {
        const { apiService } = this.props;
        const { id } = this.props.match.params;
        apiService.getCompany(id)
            .then(response => {
                this.setState({
                    company: response,
                })
            })
    }

    getCompanyRow() {
        const { company } = this.state;
        return (
            <tr>
                <td>Logo</td>
                <td>{company.name}</td>
                <td>{company.email}</td>
                <td>{company.website}</td>
            </tr>
        )
    }

    render() {
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