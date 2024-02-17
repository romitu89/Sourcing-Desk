<template>
    <div class="container">
        <div class="sidebar">
        <SideBar />
    </div>
    <div class="main-content">
        <router-view></router-view> 
    </div>
    </div>

  </template>

<script>
import SideBar from './SideBar.vue'



export default {
    name:'Editor',
    components:{
        SideBar,
    },
    data(){
        return{
        routeInstance: Date.now()
        }
    },

}
</script>

<style scoped>
.container {
    display: flex; /* Use flexbox to lay out children side by side */
    
}

.sidebar {
    flex: 0 0 145px; /* Fixed width for the sidebar */
    background-color: #0C1423;
    /* Other styles... */
}

.main-content {
    
    flex-grow: 1; /* The main content area takes up the remaining space */


}
</style>