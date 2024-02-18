<template>
    
    <div class="container">
    <div class="form" @click="updatePopUp()">
        
        <div class="icon_div"><font-awesome-icon :icon="['fas', 'chart-gantt']" /></div>
       <a ><h4>Update LWD</h4></a>
    </div>

    <div class="form" @click="workingPopUp()">
        <div class="icon_div"><font-awesome-icon :icon="['fas', 'chart-gantt']" /></div>
      <a > <h4>Working Candidate</h4> </a>
    </div>

   
</div>

<CandidatePopup
    :showPopUp="popup"
    @closePopup ="closePopUp" 
    :title="title"
   v-if="popup">

   </CandidatePopup>

</template>

<script>
import CandidatePopup from './CandidatePopup.vue'

    export default {
        name:'EditorCandidate',
       
        components:{
            CandidatePopup,
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
            this.title="Candidate Update"
        },
        closePopUp(data){
            this.popup = data;
        },
        workingPopUp(){
            this.popup=true;
            this.title="Working Candidate"
        },

       }
       
    }

</script>

