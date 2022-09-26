import IndexCustomer from './components/customers/Index.vue';
import CreateCustomer from './components/customers/Create.vue';

export const routes = [
    {
        name: 'home',
        path: '/',
        component: IndexCustomer
    },
    {
        name: 'add',
        path: '/add',
        component: CreateCustomer
    },
];
