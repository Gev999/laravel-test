import React, { Component } from 'react';
import { Link } from 'react-router-dom';
import { withApiService } from '../hoc-helpers';
import Header from '../app-header';

class Employees extends Component {

    constructor(props) {
        super(props);
        this.state = {
            employees: [],
        }
        this.apiService = this.props.apiService;
        this.getEmployees = this.getEmployees.bind(this);
        this.getEmployeesRows = this.getEmployeesRows.bind(this);
        this.deleteEmployee = this.deleteEmployee.bind(this);
    }

    componentWillMount() {
        this.getEmployees();
    }

    getEmployees() {
        this.apiService.getAllEmployees()
            .then(response => {
                this.setState({
                    employees: response,
                })
            })
            .catch(e=>{
                console.log(e.response)
            })
    }

    deleteEmployee(e) {
        if (confirm('Are you sure?')) {
            const id = e.target.value;
            this.apiService.deleteEmployee(id)
                .then(res => {
                    this.getEmployees();
                })
        }
    }

    getEmployeesRows() {
        const { employees } = this.state;
        if (!employees) return null;
        return employees.map((employee) => {
            return (
                <tr key={employee.id}>
                    <td>{employee.first_name}</td>
                    <td>{employee.last_name}</td>
                    <td>{employee.company_id}</td>
                    <td>{employee.email}</td>
                    <td>{employee.phone}</td>
                    <td><Link to={`/employees/${employee.id}`}>View</Link></td>
                    <td><Link to={`/employees/${employee.id}/edit`}>Edit</Link></td>
                    <td><button className="btn btn-link p-0 m-0"
                        onClick={this.deleteEmployee} value={employee.id}>
                        Delete
                    </button></td>
                </tr>
            )
        })
    }

    render() {
        //console.log(this.state.Employees)
        const { employees } = this.state;
        const view = employees.length === 0 ? null : this.getEmployeesRows();
        return (
            <React.Fragment>
                <Header />
                <div className="container">
                    <h2>Employees</h2>
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
                            {view}
                        </tbody>
                    </table>
                    <Link to='/employees/create' className="btn btn-outline-secondary mt-4">Create employee</Link>
                </div>
            </React.Fragment>
        )
    }
}

export default withApiService(Employees)