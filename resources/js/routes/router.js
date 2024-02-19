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

import AccountManager from '../Components/Account Manager/AccountManager.vue'

import AmDashboard from '../Components/Account Manager/Dashboard/AmDashboard.vue'
import AmTracker from '../Components/Account Manager/Tracker/AmTracker.vue'
import AmTeamManagement from '../Components/Account Manager/Team Management/AmTeamManagement.vue'
import AmRequest from '../Components/Account Manager/Request/AmRequest.vue'
import AmSubmission from '../Components/Account Manager/Submission/AmSubmission.vue'
import AmCandidate from '../Components/Account Manager/Candidate/AmCandidate.vue'
import AmClientMis from '../Components/Account Manager/ClientMis/AmClientMis.vue'
import AmUserMis from '../Components/Account Manager/UserMis/AmUserMis.vue'

import TeamLead from '../Components/Team Lead/TeamLead.vue'

import TlDashboard from '../Components/Team Lead/Dashboard/TlDashboard.vue'
import TlTracker from '../Components/Team Lead/Tracker/TlTracker.vue'
import TlTeamManagement from '../Components/Team Lead/Team Management/TlTeamManagement.vue'
import TlRequest from '../Components/Team Lead/Request/TlRequest.vue'
import TlSubmission from '../Components/Team Lead/Submission/TlSubmission.vue'
import TlClientMis from '../Components/Team Lead/ClientMis/TlClientMis.vue'
import TlUserMis from '../Components/Team Lead/UserMis/TlUserMis.vue'


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
                name:'AmDashboard',
                path:'dashboard',
                component: AmDashboard,
                meta: { layout: 'AmDashboard' }
            },
            {
                name:'AmTracker',
                path:'amTracker',
                component: AmTracker,
                meta: { layout: 'AmTracker' }
            },
            {
                name:'AmTeamManagement',
                path:'amTeamManagement',
                component: AmTeamManagement,
                meta: { layout: 'AmTeamManagement' }
            },
            {
                name:'AmRequest',
                path:'amRequest',
                component: AmRequest,
                meta: { layout: 'AmRequest' }
            },
            {
                name:'AmSubmission',
                path:'amSubmission',
                component: AmSubmission,
                meta: { layout: 'AmSubmission' }
            },
            {
                name:'AmTracker',
                path:'amTracker',
                component: AmTracker,
                meta: { layout: 'AmTracker' }
            },
            {
                name:'AmCandidate',
                path:'amCandidate',
                component: AmCandidate,
                meta: { layout: 'AmCandidate' }
            },
            {
                name:'AmClientMis',
                path:'amClientMis',
                component: AmClientMis,
                meta: { layout: 'AmClientMis' }
            },
             {
                name:'AmUserMis',
                path:'amUserMis',
                component: AmUserMis,
                meta: { layout: 'AmUserMis' }
            },

        ]
      },

      {
        name: 'TeamLead',
        path: '/teamLead',
        component: TeamLead,
        meta: { requiresAuth: true, allowedRoles: ['teamLead'] },   
        children: [
            {
                name:'TlDashboard',
                path:'tlDashboard',
                component: TlDashboard,
                meta: { layout: 'TlDashboard' }
            },
            {
                name:'TlTracker',
                path:'tlTracker',
                component: TlTracker,
                meta: { layout: 'TlTracker' }
            },
            {
                name:'TlTeamManagement',
                path:'tlTeamManagement',
                component: TlTeamManagement,
                meta: { layout: 'TlTeamManagement' }
            },
            {
                name:'TlRequest',
                path:'tlRequest',
                component: TlRequest,
                meta: { layout: 'TlRequest' }
            },
            {
                name:'TlSubmission',
                path:'tlSubmission',
                component: TlSubmission,
                meta: { layout: 'TlSubmission' }
            },
            {
                name:'TlClientMis',
                path:'tlClientMis',
                component: TlClientMis,
                meta: { layout: 'TlClientMis' }
            },
            {
                name:'TlUserMis',
                path:'tlUserMis',
                component: TlUserMis,
                meta: { layout: 'TlUserMis' }
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
