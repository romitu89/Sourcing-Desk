<template>
 <Div class="sidebar">
    
        <h3>General</h3>
        <div class="subside">
            <a href=""><h4><font-awesome-icon :icon="['fas', 'house']" /><br>
            Dashboard</h4></a>
        </div>
        <div class="subside">
            <a href=""><h4><font-awesome-icon :icon="['fas', 'pen-to-square']" /><br>
                Forms</h4></a>
        </div>
        <div class="subside">
            <a href=""><h4><font-awesome-icon :icon="['fas', 'desktop']" /><br>
                UI Elements</h4></a>
        </div>

        <div class="subside">
            <a href=""><h4><font-awesome-icon :icon="['fas', 'table']" /><br>
                Tables</h4></a>
        </div>
        <div class="subside">
            <a href=""><h4><font-awesome-icon :icon="['fas', 'chart-column']" /><br>
                Data Presentation</h4></a>
        </div>
        <div class="subside">
            <a href=""><h4><font-awesome-icon :icon="['fas', 'layer-group']" /><br>
                Layouts</h4></a>
        </div>
        
        <h3>Live On</h3>
        <div class="subside">
            <a href=""><h4><font-awesome-icon :icon="['fas', 'paperclip']" /><br>
                Additional Pages</h4></a>
        </div>
        <div class="subside">
            <a href=""><h4><font-awesome-icon :icon="['fas', 'plus']" /><br>
                Extras</h4></a>
        </div>
        <div class="subside">
            <a href=""><h4><font-awesome-icon :icon="['fas', 'network-wired']" /><br>
                Multilevel Menu</h4></a>
        </div>

 </Div>
 
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
    height: 100%;
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


</style>