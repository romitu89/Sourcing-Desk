import {createWebHistory, createRouter} from 'vue-router';
import Admin from '../Components/Admin/Admin.vue';
import Home from '../App.vue';
import Dashboard from '../Components/Admin/User/User.vue'
import User from '../Components/Admin/Dashboard/Dashboard.vue'
import Client from '../Components/Admin/Client/Client.vue'
import ClientsMis from '../Components/Admin/Client Mis/ClientsMis.vue'
import UserMis from '../Components/Admin/User Mis/UserMis.vue'
import Database from '../Components/Admin/Database/Database.vue'
import ProfileUpdating from '../Components/Admin/Profile Updating/ProfileUpdating.vue'

import Editor from '../Components/Editor/Editor.vue'



const routes=[
    {
        name:'Home',
        path:'/',
        component: Home
    },
    
    {
        name:'Admin',
        path:'/admin',
        component: Admin,
        meta: { layout: 'admin' },
        children: [
            {
                name:'Dashboard',
                path:'/dashboard',
                component: Dashboard,
                meta: { layout: 'dashboard' }
            },
        
            {
                name:'User',
                path:'/user',
                component: User,
                meta: { layout: 'user' },
            },
            {
                name:'Client',
                path:'/client',
                component: Client,
                meta: { layout: 'client' },
            },
            {
                name:'ClientsMis',
                path:'/clientsMis',
                component: ClientsMis,
                meta: { layout: 'clientsMis' },
                
            },
            {
                name:'UserMis',
                path:'/userMis',
                component: UserMis,
                meta: { layout: 'userMis' },
            },
            {
                name:'Database',
                path:'/database',
                component: Database,
                meta: { layout: 'database' },
            },
            {
                name:'ProfileUpdating',
                path:'/profileUpdating',
                component: ProfileUpdating,
                meta: { layout: 'profileUpdating' },
            },
            // additional child routes can be added here
          ]
    },

    {
        name:'Editor',
        path:'/Editor',
        component: Editor,
        meta: { layout: 'Editor' },
    },

   
// Trial work

];

const router = createRouter({
    history:createWebHistory(),
    routes
});

export default router;
