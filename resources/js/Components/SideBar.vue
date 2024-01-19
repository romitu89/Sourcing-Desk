<template>
 <div class="sidebar">
    
        <h3>Source Desk</h3>
        <div class="subside">
            <router-link  to="/dashboard"><h4><font-awesome-icon :icon="['fas', 'house']" /><br>
            Dashboard</h4></router-link>
        </div>
        <div class="subside">
            <router-link to="/user"><h4><font-awesome-icon :icon="['fas', 'user']" /><br>
                User</h4></router-link>
        </div>
        <div class="subside">
            <router-link to="/client"><h4><font-awesome-icon :icon="['fas', 'network-wired']" /><br>
                Client</h4></router-link>
        </div>

        <div class="subside">
            <router-link to="/clientsMis"><h4><font-awesome-icon :icon="['fas', 'table']" /><br>
                Clients MIS</h4></router-link>
        </div>
        <div class="subside">
            <router-link to="/userMis"><h4><font-awesome-icon :icon="['fas', 'chart-column']" /><br>
                User MIS</h4></router-link>
        </div>
        <div class="subside">
            <router-link to="/database"><h4><font-awesome-icon :icon="['fas', 'layer-group']" /><br>
                Database</h4></router-link>
        </div>
        
        <div class="subside">
            <router-link to="/profileUpdating"><h4><font-awesome-icon :icon="['fas', 'paperclip']" /><br>
                Profile Updating </h4></router-link>
        </div>
       
 </div>

</template>

<script>


export default {
    name:'SideBar',
    
    
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