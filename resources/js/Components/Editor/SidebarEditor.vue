<template>

<div class="sub_button">
<component :is="switchButton" />
</div>  

 <div class="sidebar">

    <h3>Source Desk</h3>


        <div class="subside">
            <a  @click = "switchButton='EditorDashboard'"><h4><font-awesome-icon :icon="['fas', 'house']" /><br>
            Dashboard</h4></a>
        </div>

        <div class="subside">
            <a  @click = "switchButton='EditorUser'"><h4><font-awesome-icon :icon="['fas', 'user']" /><br>
                User</h4></a>
        </div>

        <div class="subside">
            <a  @click = "switchButton='EditorClient'"><h4><font-awesome-icon :icon="['fas', 'network-wired']" /><br>
                Client</h4></a>
        </div>

        <div class="subside">
            <a  @click = "switchButton='EditorCandidate'"><h4><font-awesome-icon :icon="['fas', 'user-check']" /><br>
                Candidate</h4></a>
        </div>
        
        <div class="subside">
            <a  @click = "switchButton='EditorRequest'"><h4><font-awesome-icon :icon="['fas', 'person-circle-question']" /><br>
                Request</h4></a>
        </div>
        
        <div class="subside">
            <a  @click = "switchButton='EditorClientsMis'"><h4><font-awesome-icon :icon="['fas', 'table']" /><br>
                Clients MIS</h4></a>
        </div>
 

 </div>
</template>

<script>
import EditorDashboard from './Dashboard/EditorDashboard.vue'
import EditorUser from './User/EditorUser.vue'
import EditorClient from './Client/EditorClient.vue'
import EditorCandidate from './Candidate/EditorCandidate.vue'
import EditorRequest from './Request/EditorRequest.vue'
import EditorClientsMis from './Clients MIS/EditorClientsMis.vue'

    export default {
        name:'SidebarEditor',

        components:{
            EditorDashboard,
            EditorUser,
            EditorClient,
            EditorCandidate,
            EditorRequest,
            EditorClientsMis,
        },

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

    .sub_button{
        position: absolute;
        margin-left: 10%;
    }
    
    </style>