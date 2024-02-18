<template>
    
    <div class="container">
    <div class="form" @click="createPopUp()">
        
        <div class="icon_div"><font-awesome-icon :icon="['fas', 'chart-gantt']" /></div>
       <a ><h4>Create</h4></a>
    </div>
    
    <div class="form" @click="viewPopUp()">
        <div class="icon_div"><font-awesome-icon :icon="['fas', 'chart-gantt']" /></div>
      <a > <h4>View</h4> </a>
    </div>
    <div class="form" @click="loginPopUp()">
        <div class="icon_div"><font-awesome-icon :icon="['fas', 'chart-gantt']" /></div>
        <h4>Login</h4> 
    </div>
    <div class="form">
        <div class="icon_div"><font-awesome-icon :icon="['fas', 'chart-gantt']" /></div>
       <h4>Idle Time</h4>
    </div>
   
</div>

<EditorUserPopup
    :showPopUp="popup"
    @closePopup ="closePopUp" 
    :title="title"
   v-if="popup">

   </EditorUserPopup>

</template>

<script>
import EditorUserPopup  from './EditorUserPopup.vue'

    export default {
        name:'EditorUser',

        components:{
            EditorUserPopup,
       },
       data ()
       {
        return{
            popup:false,
            title:'',
        };
       },
       methods:{
        createPopUp(){
            this.popup=true;
            this.title="Create Form"
        },
        closePopUp(data){
            this.popup = data;
        },
        viewPopUp(){
            this.popup=true;
            this.title="View Form"
        },

        loginPopUp(){
            this.popup=true;
            this.title="Login Form"
        },

       }
       
       
    }

</script>

