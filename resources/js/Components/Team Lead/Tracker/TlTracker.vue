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

  <TlTrackerPopup
    :showPopUp="popup"
    @closePopup="closePopUp"
    @updateForm="updateForm"
    @editSuccess="editSuccess"
    :title="title"
    :editId="editId"
    :empName="empName"
    v-if="popup">

   </TlTrackerPopup>

</template>

<script>

import TlTrackerPopup from './TlTrackerPopup.vue'

    export default {
        name:'TlTracker',
        components:{
            TlTrackerPopup,
         },

         data ()
       {
        return{
            popup:false,
            title:'',
            editId: null,
            empName:"",
        };
       },
       methods:{
        updatePopUp(){
            this.popup=true;
            this.title="Tracker Create"
        },
        closePopUp(data){
            this.popup = data;
        },
        workingPopUp(){
            this.popup=true;
            this.title="Tracker View"
        },
        updateForm(id) {
            this.title = "Edit Form";
            this.popup = true;
            this.editId = id;
        },
        editSuccess(name){
            this.popup = true;
            this.title = "View Form";
            this.empName=name;
        },

       }

     }
</script>
