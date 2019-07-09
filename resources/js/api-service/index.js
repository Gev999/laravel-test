import axios from 'axios'

class ApiService
{
    constructor(){
        
    }

    async getAllCompanies() {
        const result = await axios.get('/api/companies', {
            params: {
                token: localStorage.getItem('token'),
            }
        });
        return result.data;
    }

    async getCompany(id) {
        const result = await axios.get(`/api/companies/${id}`, {
            params: {
                token: localStorage.getItem('token'),
            }
        });
        return result.data;
    }

    async createCompany(company) {
        const { name, email, website } = company;
        return await axios.post(`/api/companies`, 
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
        return await axios.put(`/api/companies/${id}`, {
            token: localStorage.getItem('token'),
            id, name, email, website,
        })
    }

    async deleteCompany(id) {
        const result = await axios({
            method: 'DELETE',
            url: `/api/companies/${id}`,
            params: {
                token:  localStorage.getItem('token'),
            }
        });
        return result.data;
    }
}

export default ApiService;