<template>
    <div class="container">

<div class="form" @click="updatePopUp()">
     <div class="icon_div"><font-awesome-icon :icon="['fas', 'chart-gantt']" /></div>
     <h4>Screening</h4>
 </div>

 </div>
 <CallingCandidatePopup
:showPopUp="popup"
@closePopup ="closePopUp"
:title="title"
v-if="popup">

</CallingCandidatePopup>
 
</template>

<script>
import CallingCandidatePopup from './CallingCandidatePopup.vue'


    export default {
        name:'RecruiterCallingCandidate',

        components:{
            CallingCandidatePopup,
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
            this.title="Recruiter Screening"
        },
        closePopUp(data){
            this.popup = data;
        },

       }
    }
</script>