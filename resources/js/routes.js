import AllCustomer from './components/AllCustomer.vue';
import AddCustomer from './components/AddCustomer.vue';
import EditPost from './components/EditPost.vue';

export const routes = [
    {
        name: 'home',
        path: '/',
        component: AllCustomer
    },
    {
        name: 'add',
        path: '/add',
        component: AddCustomer
    },
    {
        name: 'edit',
        path: '/edit/:id',
        component: EditPost
    }
];
