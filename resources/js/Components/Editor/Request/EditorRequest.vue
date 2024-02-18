<template>
    
    <div class="container">
    <div class="form" @click="createPopUp()">
        
        <div class="icon_div"><font-awesome-icon :icon="['fas', 'chart-gantt']" /></div>
       <a ><h4>Request Creation</h4></a>
    </div>

    <div class="form" @click="viewPopUp()">
        <div class="icon_div"><font-awesome-icon :icon="['fas', 'chart-gantt']" /></div>
      <a > <h4>Active Inactive Request</h4> </a>
    </div>

   
</div>
<RequestPopup
    :showPopUp="popup"
    @closePopup ="closePopUp" 
    :title="title"
   v-if="popup">

   </RequestPopup>

</template>

<script>
import RequestPopup from './RequestPopup.vue'

    export default {
        name:'EditorCandidate',

        components:{
            RequestPopup,
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
            this.title="Request Create"
        },
        closePopUp(data){
            this.popup = data;
        },
        viewPopUp(){
            this.popup=true;
            this.title="Active Inactive Request"
        },

       }

       
       
    }

</script>

