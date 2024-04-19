<template>
    <div class="popup">
           <div @click="closePopup()" class="close_btn"> <a ><font-awesome-icon :icon="['fas', 'xmark']" /></a></div>
           <div class="popup-inner">
               <h2 class="title">{{ title }}</h2>

               <TlTrackerCreate @closePopup="closePopup()"
               v-if="title=='Tracker Create'"/>

               <TlTrackerView 
               v-if="title=='Tracker View'"
               :empName="empNameProp"
                @updateForm="updateForm"
                @editMessageUpdated="editMessageUpdated"
                @closePopup="closePopup"
               />

               <TlTrackerEdit
                v-if="titleProp === 'Edit Form'"
                :editId="editIdProp"
                @editSuccess="editSuccess"
                @closePopup="closePopup" 
                />

           </div>
       </div>
   </template>

   <script>

   import TlTrackerCreate from './TlTrackerCreate.vue'
   import TlTrackerView from './TlTrackerView.vue'
   import TlTrackerEdit from './TlTrackerEdit.vue'

       export default {
           name:'TlTrackerPopup',

           components:{
            TlTrackerCreate,
               TlTrackerView,
               TlTrackerEdit,
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
