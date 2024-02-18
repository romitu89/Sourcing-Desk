<template>
    <div class="sidebar">

           <h3>Source Desk</h3>
           <div class="subside">
               <router-link  to="/accountManager/dashboard"><h4><font-awesome-icon :icon="['fas', 'house']" /><br>
            Dashboard</h4></router-link>
           </div>
           <div class="subside">
               <router-link to="/accountManager/tracker"><h4><font-awesome-icon :icon="['fas', 'user']" /><br>
                Tracker</h4></router-link>
           </div>
           <div class="subside">
               <router-link to="/accountManager/teamManagement"><h4><font-awesome-icon :icon="['fas', 'network-wired']" /><br>
                Team Management</h4></router-link>
           </div>

           <div class="subside">
               <router-link to="/accountManager/request"><h4><font-awesome-icon :icon="['fas', 'user-check']" /><br>
                Request</h4></router-link>
           </div>

           <div class="subside">
               <router-link to="/accountManager/submission"><h4><font-awesome-icon :icon="['fas', 'person-circle-question']" /><br>
                Submission</h4></router-link>
           </div>

           <div class="subside">
               <router-link to="/accountManager/candidate"><h4><font-awesome-icon :icon="['fas', 'table']" /><br>
                Candidate</h4></router-link>
           </div>

           <div class="subside">
               <router-link to="/accountManager/candidate"><h4><font-awesome-icon :icon="['fas', 'table']" /><br>
                Candidate</h4></router-link>
           </div>

           <div class="subside">
               <router-link to="/accountManager/clientMis"><h4><font-awesome-icon :icon="['fas', 'table']" /><br>
                Client MIS</h4></router-link>
           </div>

           <div class="subside">
               <router-link to="/accountManager/userMis"><h4><font-awesome-icon :icon="['fas', 'table']" /><br>
                User MIS</h4></router-link>
           </div>


    </div>

   </template>

<script>


    export default {
        name:'SidebarAccountManager',

        data () {
            return{
                switchButton:'',
            }
        },


    }
    </script>

    <style scoped>

    body{
        margin: 0;
    }
    .sidebar{
        background-color: #0C1423;
        width: 140px;
        text-align: center;
        padding: 10px 0px;
        height: 100vh;
    }
    .sidebar h3{
        color: white;
        letter-spacing: 2px;
        text-decoration:underline;
    }

    .subside{
        line-height: 20px;
        border: 1px solid black;
    }

    .subside a{
        color: lightblue;
        font-size: 16px;
        text-decoration: none;
    }
    .subside a:hover{
        color: white;

    }
    .subside :hover{
        box-shadow: 0px 0px 5px whitesmoke;
    }

    .router-link-active h4,.router-link-active.fa{
    color: white;
    /* Change color to white */
    background-color:#1A233A;
    /* Optional: change background color */
    }

    </style>
