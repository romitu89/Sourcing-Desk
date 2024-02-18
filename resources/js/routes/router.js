import {createWebHistory, createRouter} from 'vue-router';
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


import AccountManager from '../Components/Account Manager/Dashboard/Dashboard.vue'



const routes=[

    {
        name:'Admin',
        path:'/admin',
        component: Admin,
        meta: { requiresAuth: true, allowedRoles: ['admin'] },
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
        meta: { requiresAuth: true, allowedRoles: ['editor'] },
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

    {
        name: 'AccountManager',
        path: '/accountManager',
        component: AccountManager,
        meta: { requiresAuth: true, allowedRoles: ['accountManager'] },
        children: [
            {
                name:'Dashboard',
                path:'dashboard',
                component: Dashboard,
                meta: { layout: 'Dashboard' }
            },
        ]
      },
      // Additional routes...
    ];

const router = createRouter({
    history:createWebHistory(),
    routes
});

router.beforeEach((to, from, next) => {
    // Check if the user is authenticated
    const isAuthenticated = localStorage.getItem('isAuthenticated') === 'true';
    const userRole = localStorage.getItem('userRole');

    // If the route requires authentication
    if (to.matched.some(record => record.meta.requiresAuth)) {
        if (!isAuthenticated) {
            // Redirect to login form in App.vue if not authenticated
            next('/');
        } else {
            // Check if the route is restricted by role
            if (to.matched.some(record => record.meta.allowedRoles && !record.meta.allowedRoles.includes(userRole))) {
                // Redirect to a default route or show an error/notification
                next('/unauthorized'); // Make sure to handle this path in your routes
            } else {
                // Proceed to the route
                next();
            }
        }
    } else {
        // If the route does not require authentication, always allow
        next();
    }
});


export default router;
