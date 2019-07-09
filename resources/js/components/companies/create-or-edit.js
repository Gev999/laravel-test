import React, { Component } from 'react';
import { withApiService } from '../hoc-helpers';
import Header from '../app-header';
import ErrorBoundary from '../error-boundary';
import { Link } from 'react-router-dom';

class CompanyCreateOrEdit extends Component
{
    constructor(props) {
        super(props);
        this.state = {
            company: {
                id: null,
                logo: null,
                name: null,
                email: null,
                website: null,
            },
            isEdit: false,
            imgSrc: '',
            errors: {
                error: null,
                name: null,
                email: null,
                logo: null,
            },
        }
        this.apiService = this.props.apiService;

        this.onChangeHandle = this.onChangeHandle.bind(this);
        this.formHandle = this.formHandle.bind(this);
        this.onImageChangeHandle = this.onImageChangeHandle.bind(this);
    }

    componentWillMount() {
        const { id } = this.props.match.params;
        if (id) {
            this.apiService.getCompany(id)
            .then(response => {
                this.setState({
                    company: response,
                    isEdit: true,
                });
            })
            .then(()=>{
                const val = this.state.company.logo ?
                    `/storage/logos/${this.state.company.logo}` : this.state.isEdit ? '/storage/logos/default.png' : '';
                if (val) {
                    this.setState({
                        imgSrc: val,
                    })
                }
            })
            .catch(error=>{
                this.setState({
                    errors: {
                        ...this.state.errors,
                        error: error.response.data.error,
                    }
                });
            })
        }
    }

    onChangeHandle(e) {
        this.setState({
            company: { 
                ...this.state.company, 
                [e.target.name] : e.target.value 
            },
            errors: {
                ...this.state.errors,
                [e.target.name]: null,
            }
        })
    }

    onImageChangeHandle(e) {
        this.setState({
            company: {
                ...this.state.company,
                logo: e.target.files[0],
            }
        })
        let files = e.target.files || e.dataTransfer.files;
        if (!files.length)
            return;
        let reader = new FileReader();
        reader.onload = (e) => {
            this.setState({
                imgSrc: e.target.result,
            })
        };
        reader.readAsDataURL(files[0]);
    }

    formHandle(e) {
        e.preventDefault();
        const { company, isEdit } = this.state;
        const handle = isEdit ? this.apiService.updateCompany : this.apiService.createCompany;
        handle(company)
        .then(response=>{
            this.props.history.push('/companies');
        })
        .catch(error=>{
            this.setState({
                errors: error.response.data.errors,
            })
        })
    }


    render() {
        const { company, isEdit, errors } = this.state;
        if (errors.error) {
            return <ErrorBoundary error={ errors.error } />
        }
        const nameErr = errors.name ? 'err-field' : '';
        const emailErr = errors.email ? 'err-field' : '';
        const logoErr = errors.logo ? 'err-field' : '';
        return (
            <React.Fragment>
                <Header />
                <div className="container mt-5">
                    <form className="form-container" encType="multipart/form-data" onSubmit={ this.formHandle }>
                        <div className="form-group">
                            <label htmlFor="logo">Logo: </label>
                            <img src={`${this.state.imgSrc}`} style={{width: '70px'}} className="ml-2 mb-2"/>
                            <br />
                            <input type='file' id="logo" name="logo" accept="image/*" onChange={this.onImageChangeHandle}/>
                        </div>
                        { logoErr && 
                            <div className="form-group">
                                <p className="err-msg">{ errors.logo}</p>
                            </div>
                        }

                        <div className="form-group">
                            <label htmlFor="name">Company name: </label>
                            <input className={`form-control ${nameErr}`} id="name" name="name" type="text"
                                value={company.name? company.name: ''} onChange={this.onChangeHandle} required />
                        </div>
                        { nameErr && 
                            <div className="form-group">
                                <p className="err-msg">{ errors.name}</p>
                            </div>
                        }
                        <div className="form-group">
                            <label htmlFor="mail">Email: </label>
                            <input className={`form-control ${emailErr}`} id="mail" name="email" type="email"
                                value={ company.email ? company.email : ''} onChange={ this.onChangeHandle }
                                pattern="[a-z0-9._%+-]+@[a-z0-9.-]+\.[a-z]{2,}$" />
                        </div>
                        { emailErr && 
                            <div className="form-group">
                                <p className="err-msg">{ errors.email }</p>
                            </div>
                        }
                        <div className="form-group">
                            <label htmlFor="website">Website: </label>
                            <input className="form-control" id="website" name="website" type="text"
                                value={ company.website ? company.website : '' } onChange={ this.onChangeHandle } />
                        </div>
                        <button className="btn btn-outline-primary">{ isEdit? 'Edit' : 'Create' }</button>
                        <Link to="/companies" className="ml-2 btn btn-outline-success">Cancel</Link>
                    </form>
                </div>
            </React.Fragment>
        )
    }
}

export default withApiService(CompanyCreateOrEdit);