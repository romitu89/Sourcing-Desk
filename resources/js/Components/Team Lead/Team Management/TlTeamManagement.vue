<template>
    <div class="container">

<div class="form" @click="updatePopUp()">
     <div class="icon_div"><font-awesome-icon :icon="['fas', 'chart-gantt']" /></div>
     <h4>Create</h4>
 </div>

 <div class="form" @click="workingPopUp()">
     <div class="icon_div"><font-awesome-icon :icon="['fas', 'chart-gantt']" /></div>
    <h4>View</h4>
 </div>

 </div>

 <TlTeamManagementPopup
:showPopUp="popup"
@closePopup ="closePopUp"
:title="title"
v-if="popup">

</TlTeamManagementPopup>
</template>

<script>

import TlTeamManagementPopup from './TlTeamManagementPopup.vue'

    export default {
        name:'TlTeamManagement',
        components:{
            TlTeamManagementPopup,
         },

         data ()
       {
        return{
            popup:false,
            title:'',
        };
       },
       methods:{
        updatePopUp(){
            this.popup=true;
            this.title="Team Management Create"
        },
        closePopUp(data){
            this.popup = data;
        },
        workingPopUp(){
            this.popup=true;
            this.title="Team Management View"
        },

       }

    }
</script>
