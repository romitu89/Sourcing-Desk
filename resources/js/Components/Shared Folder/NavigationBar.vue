<template>
    <div class="nav_bar">
       
        <font-awesome-icon :icon="['fas', 'magnifying-glass']" />
      <span> <font-awesome-icon :icon="['fas', 'message']" /></span>
      <span><font-awesome-icon :icon="['fas', 'bell']" /></span>
      <font-awesome-icon :icon="['fas', 'bell']" />
      <font-awesome-icon :icon="['fas', 'chevron-down']" />
    </div>
</template>

<script>
    export default {
        name:'NavigationBar',

    }
</script >

<style scoped>
.nav_bar{
    background-color: lightblue;
    width: 100%;
    height: 50px;
    color: white;
    text-align: center;
    
}


</style>