import axios from 'axios'

class ApiService
{
    constructor(){
        this.companiesURL = '/api/companies';
        this.employeesURL = '/api/employees';

        this.getAllCompanies = this.getAllCompanies.bind(this);
        this.getCompany = this.getCompany.bind(this);
        this.createCompany = this.createCompany.bind(this);
        this.updateCompany = this.updateCompany.bind(this);
        this.deleteCompany = this.deleteCompany.bind(this);

        this.getAllEmployees = this.getAllEmployees.bind(this);
        this.getEmployee = this.getEmployee.bind(this);
        this.deleteEmployee = this.deleteEmployee.bind(this);
        this.createEmployee = this.createEmployee.bind(this);
        this.updateEmployee = this.updateEmployee.bind(this);
    }

    getAllCompanies() {
        return this.getAllItems(this.companiesURL);
    }

    getAllEmployees() {
        return this.getAllItems(this.employeesURL);
    }

    getCompany(id) {
        return this.getItem(`${this.companiesURL}/${id}`);
    }

    getEmployee(id) {
        return this.getItem(`${this.employeesURL}/${id}`);
    }

    deleteCompany(id) {
        return this.deleteItem(`${this.companiesURL}/${id}`);
    }

    deleteEmployee(id) {
        return this.deleteItem(`${this.employeesURL}/${id}`);
    }

    async createCompany(company) {
        const { name, email, website } = company;
        return await axios.post(`${this.companiesURL}`, 
            {
                token: localStorage.getItem('token'),
                name, email, website, 
                header: {
                    'Content-Type': 'multipart/form-data',
                },
            })
    }

    async updateCompany(company) {
        const { id, name, email, website } = company;
        return await axios.put(`${this.companiesURL}/${id}`, {
            token: localStorage.getItem('token'),
            id, name, email, website,
        })
    }

    async createEmployee(employee) {
        return await axios.post(`${this.employeesURL}`, 
            {
                token: localStorage.getItem('token'),
                ...employee,
            })
    }

    async updateEmployee(employee) {
        return await axios.put(`${this.employeesURL}/${employee.id}`, {
            token: localStorage.getItem('token'),
            ...employee,
        })
    }

    // -------------------------------------------------

    async getAllItems(url) {
        const result = await axios.get(`${url}`, {
            params: {
                token: localStorage.getItem('token'),
            }
        });
        return result.data;
    }

    async getItem(url) {
        const result = await axios.get(`${url}`, {
            params: {
                token: localStorage.getItem('token'),
            }
        });
        return result.data;
    }

    async deleteItem(url) {
        const result = await axios({
            method: 'DELETE',
            url: `${url}`,
            params: {
                token:  localStorage.getItem('token'),
            }
        });
        return result.data;
    }
}

export default ApiService;