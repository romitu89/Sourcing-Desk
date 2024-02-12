import {createWebHistory, createRouter} from 'vue-router';
import Dashboard from '../Components/Admin/Dashboard/Dashboard.vue';
import User from '../Components/Admin/User/User.vue'
import Client from '../Components/Admin/Client/Client.vue'
import ClientsMis from '../Components/Admin/Client Mis/ClientsMis.vue'
import UserMis from '../Components/Admin/User Mis/UserMis.vue'
import Database from '../Components/Admin/Database/Database.vue'
import ProfileUpdating from '../Components/Admin/Profile Updating/ProfileUpdating.vue'



const routes=[
    {
        name:'Dashboard',
        path:'/admin',
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

];

const router = createRouter({
    history:createWebHistory(),
    routes
});

export default router;
