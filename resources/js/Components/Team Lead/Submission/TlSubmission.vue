<template>
        <div class="container">

 <div class="form" @click="updatePopUp()">
      <div class="icon_div"><font-awesome-icon :icon="['fas', 'chart-gantt']" /></div>
      <h4>Request For Approval</h4>
  </div>


  </div>

  <TlSubmissionPopup
 :showPopUp="popup"
 @closePopup ="closePopUp"
 :title="title"
v-if="popup">

</TlSubmissionPopup>
</template>

<script>

import TlSubmissionPopup from './TlSubmissionPopup.vue'

    export default {
        name:'TlSubmission',
        components:{
            TlSubmissionPopup,
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
            this.title="Submission Request"
        },
        closePopUp(data){
            this.popup = data;
        },

       }
    }
</script>
