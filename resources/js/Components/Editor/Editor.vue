<template>
    <div class="container_main">
        <div class="sidebar">
        <SideBar />
    </div>
    <div class="main-content">
        <div><NavigationBar /></div>
        <router-view></router-view> 
    </div>
    </div>

  </template>

<script>
import NavigationBar from '../Shared Folder/navigationBar.vue'
import SideBar from './SideBar.vue'



export default {
    name:'Editor',
    components:{
        SideBar,
        NavigationBar,

    },
    data(){
        return{
        routeInstance: Date.now()
        }
    },

}
</script>

<style scoped>
.container_main {
    display: flex; /* Use flexbox to lay out children side by side */
    
}

.sidebar {
    flex: 0 0 145px; /* Fixed width for the sidebar */
    background-color: #0C1423;
    /* Other styles... */
}

.main-content {
    /* background-color: #0C1423; */
    flex-grow: 1; /* The main content area takes up the remaining space */

}
</style>