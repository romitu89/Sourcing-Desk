<template>
    
   <h2> Client</h2>
   <div class="container">

   <div class="form">
        <div class="icon_div"><font-awesome-icon :icon="['fas', 'chart-gantt']" /></div>
       <router-link to="/UserCreate"> <h4>Create</h4> </router-link>
    </div>

    <div class="form">
        <div class="icon_div"><font-awesome-icon :icon="['fas', 'chart-gantt']" /></div>
       <h4>View</h4>
    </div>

    </div>

</template>

<script>

    export default {
        name: 'Client',
    
    }
</script>

<style scoped>
/* .colour {
    background-color: #162541;
    width: 1400px;
    height: 100%;
} */

.container{
    margin: 2% 5%;
    display: flex;
    flex-wrap: wrap;
    gap: 2%;
    
}
.form{
    width: 250px;
    background-color: #002147;
    opacity: 0.9;
    border-radius: 10px;
    padding: 10px 20px;
    margin: 1%;
    cursor: pointer;
    /* box-shadow: 0 0 6px 7px whitesmoke; */
}

.form h4{
    color: rgb(213, 242, 253);
    font-size: 25px;
    text-align: center;
}

.icon_div{
    color: lightblue;
    text-align: center;
    font-size: 30px;
}
</style>