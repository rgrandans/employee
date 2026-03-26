import { createRouter, createWebHistory } from 'vue-router'
import EmployeeListView from '@/views/EmployeeListView.vue';
import EmployeeEditView from '@/views/EmployeeEditView.vue';
import EmployeeView from '@/views/EmployeeView.vue';

const routes = [
    {
        path: '/employees',
        name: 'employee-list',
        component: EmployeeListView
    },
    {
        path: '/employees/create',
        name: 'employee-create',
        component: EmployeeEditView
    },
    {
        path: '/employees/edit/:id',
        name: 'employee-edit',
        component: EmployeeEditView
    },
    {
        path: '/employees/:id',
        name: 'employee-view',
        component: EmployeeView
    }
]

const router = createRouter({
    history: createWebHistory(),
    routes
})

export default router