<template>
    <div class="popup">
           <div @click="closePopup()" class="close_btn"> <a ><font-awesome-icon :icon="['fas', 'xmark']" /></a></div>
           <div class="popup-inner">
               <h2 class="title">{{ title }}</h2>

               <TlTeamManagementCreate @closePopup="closePopup()"
               v-if="title=='Team Management Create'"/>

               <TlTeamManagementView v-if="title=='Team Management View'"
               :empName="empNameProp"
                @updateForm="updateForm"
                @editMessageUpdated="editMessageUpdated"
                @closePopup="closePopup"/>

                <TlTeamManagementEdit
                v-if="titleProp === 'Edit Form'"
                :editId="editIdProp"
                @editSuccess="editSuccess"
                @closePopup="closePopup" 
                />

           </div>
       </div>
   </template>

   <script>
   import TlTeamManagementCreate from './Tlteammanagementcreate.vue'
   import TlTeamManagementView from './TlTeamManagementView.vue'
   import TlTeamManagementEdit from './TlTeamManagementEdit.vue'

       export default {
           name:'TlTeamManagementPopup',

           components:{
            TlTeamManagementCreate,
            TlTeamManagementView,
            TlTeamManagementEdit,
           },
           props: {
            editId: {
                type: Number,
                default: null,
            },
            empName: {
                type: String,
                default: "",
            },
            showPopUp: {
               type: Boolean,
               default: false
           },
           title: {
               type: String,
               default: 'Head'
           }
       },
       watch: {
           tab(newVal) {
               this.showUserCreate = newVal;
           },
           editId(newVal) {
                this.editIdProp = newVal;
            },
            title(newVal) {
                this.titleProp = newVal;
            },
            empName(newVal) {
                this.empNameProp = newVal;
            },
       },
       data() {
           return {
               showUserCreate: this.tab,
               editIdProp: this.editId,
                titleProp: this.title,
                empNameProp: this.empName,
           };
       },
       methods: {

        closePopup() {
            this.$emit("closePopup");
        },
        updateForm(id) {
            this.$emit("updateForm", id);
        },
        editSuccess(name) {
            this.$emit("editSuccess", name);
        },
        editMessageUpdated() {
            console.log(this.empNameProp,"Value")
            this.empNameProp = "";
        },
       },

       }
   </script>
