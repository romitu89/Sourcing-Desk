import {createWebHistory, createRouter} from 'vue-router';
import Dashboard from '../Components/Dashboard.vue';
import User from '../Components/User.vue'
import Client from '../Components/Client.vue'
import ClientsMis from '../Components/ClientsMis.vue'
import UserMis from '../Components/UserMis.vue'
import Database from '../Components/Database.vue'
import ProfileUpdating from '../Components/ProfileUpdating.vue'
import ClientCreateForm from '../Components/Popup/FormComponents/ClientCreateForm.vue'
// import UserCreate  from '../Components/Popup/UserCreate.vue'





const routes=[
    {
        name:'Dashboard',
        path:'/dashboard',
        component: Dashboard
    },
    {
        name:'User',
        path:'/user',
        component: User
    },
    {
        name:'Client',
        path:'/client',
        component: Client
    },
    {
        name:'ClientsMis',
        path:'/clientsMis',
        component: ClientsMis
    },
    {
        name:'UserMis',
        path:'/userMis',
        component: UserMis
    },
    {
        name:'Database',
        path:'/database',
        component: Database
    },
    {
        name:'ProfileUpdating',
        path:'/profileUpdating',
        component: ProfileUpdating
    },
// Trial work
    {
        name:'ClientCreateForm',
        path:'/ClientCreateForm',
        component: ClientCreateForm
    },
    // {
    //     name:'UserCreate',
    //     path:'/UserCreate',
    //     component: UserCreate
    // },
    

];

const router=createRouter({
    history:createWebHistory(),
    routes
});

export default router;