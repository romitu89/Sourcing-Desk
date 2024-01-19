<template>
    <h2>The User MIS</h2>

    <div class="container">
    <div class="form">
        <div class="icon_div"><font-awesome-icon :icon="['fas', 'chart-gantt']" /></div>
       <h4>Account Manager</h4>
    </div>
    <div class="form">
        <div class="icon_div"><font-awesome-icon :icon="['fas', 'chart-gantt']" /></div>
       <h4>Team Lead</h4>
    </div>
    <div class="form">
        <div class="icon_div"><font-awesome-icon :icon="['fas', 'chart-gantt']" /></div>
       <h4>Recruiter</h4>
    </div>
    <div class="form">
        <div class="icon_div"><font-awesome-icon :icon="['fas', 'chart-gantt']" /></div>
       <h4>Matrix</h4>
    </div>
</div>
</template>

<script>
    export default {
        name: 'UserMis',
    }
</script>
<style scoped>
*{
    
    background: cover;
}
.container{
    margin: 2% 5%;
    display: flex;
    flex-wrap: wrap;
    gap: 2%;
}
.form{
    width: 250px;
    background-color:whitesmoke;
    opacity: 0.9;
    border-radius: 10px;
    padding: 10px 20px;
    box-shadow: 0 0 6px 7px #F0F1F2;
    margin: 1%;
}
.form h4{
    color: #002147;
    font-size: 25px;
    text-align: center;
}
.icon_div{
    color: #002147;
    text-align: center;
    font-size: 30px;
}
</style>