import React, { Component } from 'react';
import { withApiService } from '../hoc-helpers';
import Header from '../app-header';
import ErrorBoundary from '../error-boundary';
import { Link } from 'react-router-dom';

class EmployeeCreateOrEdit extends Component
{
    constructor(props) {
        super(props);
        this.state = {
            employee: {
                id: null,
                first_name: null,
                last_name: null,
                company_id: '',
                email: null,
                phone: null,
            },
            companies: [],
            isEdit: false,
            errors: {
                error: null,
                first_name: null,
                last_name: null,
                company_id: null,
                email: null,
                phone: null,
            },
        }
        this.apiService = this.props.apiService;

        this.onChangeHandle = this.onChangeHandle.bind(this);
        this.formHandle = this.formHandle.bind(this);
        this.selectHandle = this.selectHandle.bind(this);
        this.optionsList = this.optionsList.bind(this);
    }

    componentWillMount() {
        const { id } = this.props.match.params;
        if (id) {
            this.apiService.getEmployee(id)
            .then(response => {
                this.setState({
                    employee: response,
                    isEdit: true,
                });
            })
            .then(() => {
                this.apiService.getAllCompanies()
                    .then(response => {
                        this.setState({
                            companies: response,
                        });
                    })
            })
            .catch(error=>{
                this.setState({
                    errors: {
                        ...this.state.errors,
                        error: error.response.data.error,
                    }
                });
            })
        } else {
            this.apiService.getAllCompanies()
                .then(response => {
                    this.setState({
                        companies: response,
                    });
                })
        }
    }

    onChangeHandle(e) {
        this.setState({
            employee: { 
                ...this.state.employee, 
                [e.target.name] : e.target.value 
            },
            errors: {
                ...this.state.errors,
                [e.target.name]: null,
            }
        })
    }

    selectHandle(e) {
        this.setState({
            employee: {
                ...this.state.employee,
                company_id: e.target.value,
            }
        })
    }


    formHandle(e) {
        e.preventDefault();
        const { employee, isEdit } = this.state;
        const handle = isEdit ? this.apiService.updateEmployee : this.apiService.createEmployee;
        handle(employee)
        .then(response=>{
            this.props.history.push('/employees');
        })
        .catch(error=>{
            this.setState({
                errors: error.response.data.errors,
            })
        })
    }

    optionsList() {
        const { companies } = this.state;
        return companies.map((company)=>{
            return <option value={company.id} key={company.id}>{company.name}</option>
        })
    }


    render() {
        const { employee, isEdit, errors, companies } = this.state;
        if (errors.error) {
            return <ErrorBoundary error={ errors.error } />
        }
        if (companies.length===0) {
            return <ErrorBoundary error='First create company!!' />
        }
        const firstNameErr = errors.first_name ? 'err-field' : '';
        const lastNameErr = errors.last_name ? 'err-field' : '';
        const companyIdErr = errors.company_id ? 'err-field' : '';
        const emailErr = errors.email ? 'err-field' : '';
        const phoneErr = errors.phone ? 'err-field' : '';
        return (
            <React.Fragment>
                <Header />
                <div className="container mt-5">
                    <form className="form-container" onSubmit={ this.formHandle }>
                        <div className="form-group">
                            <label htmlFor="first-name">First name: </label>
                            <input className={`form-control ${firstNameErr}`} id="first-name" name="first_name" type="text"
                                value={employee.first_name? employee.first_name: ''} onChange={this.onChangeHandle} required />
                        </div>
                        { firstNameErr && 
                            <div className="form-group">
                                <p className="err-msg">{ errors.first_name}</p>
                            </div>
                        }

                        <div className="form-group">
                            <label htmlFor="last-name">Last name: </label>
                            <input className={`form-control ${lastNameErr}`} id="last-name" name="last_name" type="text"
                                value={employee.last_name? employee.last_name: ''} onChange={this.onChangeHandle} required />
                        </div>
                        { lastNameErr && 
                            <div className="form-group">
                                <p className="err-msg">{ errors.last_name}</p>
                            </div>
                        }

                        <div className="form-group">
                            <label htmlFor="company-id">Company</label>
                            <select name="company_id" className={`form-control ${companyIdErr}`} id="company-id" 
                                value={employee.company_id} onChange={this.selectHandle} required>
                                {!employee.company_id && <option disabled value=''>Choose Company</option>}
                                { this.optionsList() }
                            </select>
                        </div>
                        { companyIdErr && 
                            <div className="form-group">
                                <p className="err-msg">{ errors.company_id }</p>
                            </div>
                        }
                        
                        <div className="form-group">
                            <label htmlFor="mail">Email: </label>
                            <input className={`form-control ${emailErr}`} id="mail" name="email" type="email"
                                value={ employee.email ? employee.email : ''} onChange={ this.onChangeHandle }
                                pattern="[a-z0-9._%+-]+@[a-z0-9.-]+\.[a-z]{2,}$" />
                        </div>
                        { emailErr && 
                            <div className="form-group">
                                <p className="err-msg">{ errors.email }</p>
                            </div>
                        }

                        <div className="form-group">
                            <label htmlFor="phone">Phone: </label>
                            <input className="form-control" id="phone" name="phone" type="text"
                                value={ employee.phone ? employee.phone : '' } onChange={ this.onChangeHandle } />
                        </div>
                        { phoneErr && 
                            <div className="form-group">
                                <p className="err-msg">{ errors.phone }</p>
                            </div>
                        }

                        <button className="btn btn-outline-primary">{ isEdit? 'Edit' : 'Create' }</button>
                        <Link to="/employees" className="ml-2 btn btn-outline-success">Cancel</Link>
                    </form>
                </div>
            </React.Fragment>
        )
    }
}

export default withApiService(EmployeeCreateOrEdit);