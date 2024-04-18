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

     <AmTeamManagementPopup
    :showPopUp="popup"
    @closePopup="closePopUp"
    @updateForm="updateForm"
    @editSuccess="editSuccess"
    :title="title"
    :editId="editId"
    :empName="empName"
    v-if="popup">

   </AmTeamManagementPopup>
 </template>

 <script>
 import AmTeamManagementPopup from './AmTeamManagementPopup.vue'

     export default {
         name: 'AmTeamManagement',

         components:{
            AmTeamManagementPopup,
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
            this.title="Team Management Create"
        },
        closePopUp(data){
            this.popup = data;
        },
        workingPopUp(){
            this.popup=true;
            this.title="Team Management View"
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

