import {createWebHistory, createRouter} from 'vue-router';
import Home from '../App.vue'
import Admin from '../Components/Admin/Admin.vue';
import Dashboard from  '../Components/Admin/Dashboard/Dashboard.vue'
import User from '../Components/Admin/User/User.vue'
import Client from '../Components/Admin/Client/Client.vue'
import ClientsMis from '../Components/Admin/Client Mis/ClientsMis.vue'
import UserMis from '../Components/Admin/User Mis/UserMis.vue'
import Database from '../Components/Admin/Database/Database.vue'
import ProfileUpdating from '../Components/Admin/Profile Updating/ProfileUpdating.vue'

import Editor from '../Components/Editor/Editor.vue'
import EditorDashboard from '../Components/Editor/Dashboard/EditorDashboard.vue'
import EditorUser from '../Components/Editor/User/EditorUser.vue'
import EditorClient from '../Components/Editor/Client/EditorClient.vue'
import EditorCandidate from '../Components/Editor/Candidate/EditorCandidate.vue'
import EditorRequest from '../Components/Editor/Request/EditorRequest.vue'
import EditorClientsMis from '../Components/Editor/Clients MIS/EditorClientsMis.vue'



const routes=[

{
    name:'Home',
    path:'/',
    component: Home,
},    

    {
        name:'Admin',
        path:'/admin',
        component: Admin,
        meta: { layout: 'admin' },
        children: [
            {
                name:'Dashboard',
                path:'dashboard',
                component: Dashboard,
                meta: { layout: 'dashboard' }
            },
        
            {
                name:'User',
                path:'user',
                component: User,
                meta: { layout: 'user' },
            },
            {
                name:'Client',
                path:'client',
                component: Client,
                meta: { layout: 'client' },
            },
            {
                name:'ClientsMis',
                path:'clientsMis',
                component: ClientsMis,
                meta: { layout: 'clientsMis' },
                
            },
            {
                name:'UserMis',
                path:'userMis',
                component: UserMis,
                meta: { layout: 'userMis' },
            },
            {
                name:'Database',
                path:'database',
                component: Database,
                meta: { layout: 'database' },
            },
            {
                name:'ProfileUpdating',
                path:'profileUpdating',
                component: ProfileUpdating,
                meta: { layout: 'profileUpdating' },
            },
            // additional child routes can be added here
          ]
    },

    {
        name:'Editor',
        path:'/editor',
        component: Editor,
        meta: { layout: 'Editor' },
        children: [
            {
                name:'EditorDashboard',
                path:'dashboard',
                component: EditorDashboard,
                meta: { layout: 'EditorDashboard' }
            },
        
            {
                name:'EditorUser',
                path:'user',
                component: EditorUser,
                meta: { layout: 'EditorUser' },
            },
            {
                name:'EditorClient',
                path:'client',
                component: EditorClient,
                meta: { layout: 'EditorClient' },
            },
            {
                name:'EditorCandidate',
                path:'candidate',
                component: EditorCandidate,
                meta: { layout: 'EditorCandidate' },
                
            },
            {
                name:'EditorRequest',
                path:'request',
                component: EditorRequest,
                meta: { layout: 'EditorRequest' },
            },
            {
                name:'EditorClientsMis',
                path:'clientsMis',
                component: EditorClientsMis,
                meta: { layout: 'EditorClientsMis' },
            },
        
            // additional child routes can be added here
          ]
    },
   
// Trial work

];

const router = createRouter({
    history:createWebHistory(),
    routes
});

router.beforeEach((to, from, next) => {
    const requiresAuth = to.matched.some(record => record.meta.requiresAuth);
    const userRole = localStorage.getItem('userRole'); // Assuming user role is stored in localStorage after login
    const isAuthenticated = localStorage.getItem('isAuthenticated'); // Or however you choose to determine if the user is logged in
   
    if (requiresAuth && isAuthenticated) {
     
      if (userRole == 'admin'){
        next('/admin/dashboard'); 

      }
      else if (userRole == 'editor'){
        next('/editor/dashboard');
      }
      else {
        next('/');
      }
    }
    else {
        next('/');
      }
  });

export default router;
