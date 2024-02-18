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
    name:'Admin',
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
    height: 100vh; /* Adjust height as needed */
}

.sidebar {
    flex: 0 0 145px; /* Fixed width for the sidebar */
    background-color: #0C1423;
    /* Other styles... */
}

.main-content {
    /* background-image: url(./image/abstract-textured-backgound.jpg); */
    /* background-color: #080d15; */
    /* dark shade upper one */

    /* background-color: #0C1423; */
    flex-grow: 1; /* The main content area takes up the remaining space */


}
</style>
