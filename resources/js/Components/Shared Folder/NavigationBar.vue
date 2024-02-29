<template>
    <div class="nav_bar">
       <div class="nav_icon">
        <font-awesome-icon :icon="['fas', 'magnifying-glass']" />
        <div class="nav_icon_b">
            <div>
      <span> <font-awesome-icon :icon="['fas', 'message']" /></span></div>
      
      <div><span><font-awesome-icon :icon="['fas', 'bell']" /></span></div>
      
      <div class="dropdown" @click="dropDownFunction()"><span><b>Ashock kumar panday</b></span> 
        <span v-if="dropDown" style="margin-left: 10px; color: goldenrod;">        <font-awesome-icon :icon="['fas', 'chevron-down']" /> </span>
        <span v-else style="margin-left: 10px;color: goldenrod;">        <font-awesome-icon :icon="['fas', 'chevron-left']" /> </span>
        
        <div class="dropdown-content" v-if="dropDown" >
            <a href="#"><font-awesome-icon :icon="['fas', 'gear']" /> Settings</a>
            <a href="#"><font-awesome-icon :icon="['fas', 'user']" /> Profile</a>
            <a href="#"><font-awesome-icon :icon="['fas', 'envelope']" /> My message</a>
            <a href="#"><font-awesome-icon :icon="['fas', 'right-from-bracket']" /> Logout</a>
  </div>
    </div>
    </div>
</div>
    </div>
</template>

<script>
    export default {
        name:'NavigationBar',

        data ()
        {
            return{
                dropDown: false,
            }

        },

        methods:{
            dropDownFunction(){
                this.dropDown =! this.dropDown
                
            }
        }

    }
</script >

<style scoped>
.nav_bar{
    background-color: whitesmoke;
    width: 100%;
    height: 50px;
    padding: 0.5% ;
    color: #002147;
    position: sticky;
    top: 0;
    box-shadow: 0 0 4px 2px lightgray;
    
}

.nav_icon{
    display: flex;
    padding: 5px 60px;
    justify-content: space-between;
    margin-top: 10px;
    /* border: 2px solid red; */
}
.nav_icon_b{
display: flex;
gap: 40px;
/* border: 2px solid green; */
}

.dropdown-content {
  
  position: absolute;
  top: 45px;
  right: 25px;
  background-color: #f9f9f9;
  min-width: 110px;
  box-shadow: 0px 8px 16px 0px rgba(0,0,0,0.2);
  z-index: 1;
}
.dropdown-content a {
  color: black;
  padding: 12px 16px;
  text-decoration: none;
  display: block;
}



.dropdown-content a:hover {background-color: #f1f1f1}

.dropdown:hover .dropdown-content {
  display: block;
}

</style>