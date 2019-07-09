import React, { Component } from 'react';
import Header from '../app-header';
import ErrorBoundary from '../error-boundary';
import { withApiService } from '../hoc-helpers';

class Employee extends Component {

    constructor(props) {
        super(props);
        this.state = {
            employee: null,
            error: null,
        }
        this.apiService = this.props.apiService;

        this.getEmployee = this.getEmployee.bind(this);
        this.getEmployeeRow = this.getEmployeeRow.bind(this);
    }

    componentWillMount() {
        this.getEmployee();
    }

    getEmployee() {
        const { id } = this.props.match.params;
        this.apiService.getEmployee(id)
            .then(response => {
                this.setState({
                    employee: response,
                })
            })
            .catch(e => {
                this.setState({
                    error: e.response.data.error,
                })
            })
    }

    getEmployeeRow() {
        const { employee } = this.state;
        return (
            <tr>
                <td>{employee.first_name}</td>
                <td>{employee.last_name}</td>
                <td>{employee.company_id}</td>
                <td>{employee.email}</td>
                <td>{employee.phone}</td>
            </tr>
        )
    }

    render() {
        if (this.state.error) {
            return <ErrorBoundary error={this.state.error} />
        }
        const row = this.state.employee ? this.getEmployeeRow() : null;
        return (
            <React.Fragment>
                <Header />
                <div className="container">
                    <table className="table table-hover table-striped table-border">
                        <thead>
                            <tr>
                                <td className="td-brand">First Name</td>
                                <td className="td-brand">Last Name</td>
                                <td className="td-brand">Company ID</td>
                                <td className="td-brand">Email</td>
                                <td className="td-brand">Phone</td>
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

export default withApiService(Employee)