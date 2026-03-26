import axios from 'axios';

const apiClient = axios.create({
    baseURL: 'http://localhost:8081/api',
    headers: {
        'Content-Type': 'application/json'
    }
});

export default {
    getEmployees() {
        return apiClient.get('/employees');
    },
    getEmployee(id) {
        return apiClient.get(`/employees/${id}`);
    },
    createEmployee(employee) {
        return apiClient.post('/employees', employee);
    },
    updateEmployee(employee) {
        return apiClient.put(`/employees/${employee.id}`, employee);
    },
    deleteEmployee(id) {
        return apiClient.delete(`/employees/${id}`);
    }
};