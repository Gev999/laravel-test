import React, { Component } from 'react';
import './login.css';

export default class Login extends Component {
    constructor(props) {
        super(props);
        this.state = {
            email: '',
            password: '',
            error: false,
        }
        this.isLoggedIn = this.isLoggedIn.bind(this);
        this.onChangeHandle = this.onChangeHandle.bind(this);
    }
    componentWillMount() {
        if (localStorage.getItem('token')) {
            this.props.history.push('/');
        }
    }

    isLoggedIn(e) {
        e.preventDefault();
        const { email, password } = this.state;
        axios.post('/api/auth/login', {
            email,
            password,
        })
        .then(res => {
            localStorage.setItem('token', res.data.access_token);
            this.props.history.push('/');
        })
        .catch(err => {
            this.setState({ error: true})
        })
    }

    onChangeHandle(e) {
        this.setState({
            [e.target.name]: e.target.value,
        })
    }

    render() {
        const { email, password, error } = this.state;
        const clazz = error? "form-control err-field" : "form-control";
        return (
            <div className="container mt-5">
                <form onSubmit={this.isLoggedIn} className="form-block">
                    <div className="form-group">
                        <input type="text" name="email" placeholder="Email" className={clazz}
                            value={email} onChange={this.onChangeHandle} required
                            pattern="[a-z0-9._%+-]+@[a-z0-9.-]+\.[a-z]{2,}$" />
                    </div>
                    <div className="form-group">
                        <input type="password" name="password" placeholder="Password" className={clazz}
                            value={password} onChange={this.onChangeHandle} required/>
                    </div>
                    {error && (<p className='err-msg'>Wrong email or password</p>)}
                    <button className="btn btn-outline-secondary mt-2">Sign in</button>
                </form>
            </div>
        )
    }
}