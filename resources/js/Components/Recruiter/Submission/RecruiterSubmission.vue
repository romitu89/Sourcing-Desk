<template>
    <div class="container">

<div class="form" @click="updatePopUp()">
     <div class="icon_div"><font-awesome-icon :icon="['fas', 'chart-gantt']" /></div>
     <h4>Inbox</h4>
 </div>

 <RecruiterSubmissionPopup
:showPopUp="popup"
@closePopup ="closePopUp"
:title="title"
v-if="popup">

</RecruiterSubmissionPopup>

 </div>

 
</template>

<script>
import RecruiterSubmissionPopup from './RecruiterSubmissionPopup.vue'

    export default {
        name:'RecruiterSubmission',

        components:{
            RecruiterSubmissionPopup,
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
            this.title="Recruiter Inbox"
        },
        closePopUp(data){
            this.popup = data;
        },

       }
        
    }
</script>