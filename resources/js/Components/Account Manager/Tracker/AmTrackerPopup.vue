<template>
    <div class="popup">
           <div @click="closePopup()" class="close_btn"> <a ><font-awesome-icon :icon="['fas', 'xmark']" /></a></div>
           <div class="popup-inner">
               <h2 class="title">{{ title }}</h2>

               <AmTrackerCreate @closePopup="closePopup()"
               v-if="title=='Tracker Create'"/>

               <AmTrackerView
               v-if="title=='Tracker View'"
               :empName="empNameProp"
                @updateForm="updateForm"
                @editMessageUpdated="editMessageUpdated"
                @closePopup="closePopup"
               />

               <AmTrackerEdit
                v-if="titleProp === 'Edit Form'"
                :editId="editIdProp"
                @editSuccess="editSuccess"
                @closePopup="closePopup"
                />

           </div>
       </div>
   </template>

   <script>
   import { outsideClickMixin } from '../../../outsideClick.js';
   import AmTrackerCreate from './AmTrackerCreate.vue'
   import AmTrackerView from './AmTrackerView.vue'
   import AmTrackerEdit from './AmTrackerEdit.vue'

       export default {
           name:'AmTrackerPopup',
           mixins:[outsideClickMixin],
           components:{
            AmTrackerCreate,
               AmTrackerView,
               AmTrackerEdit
           },
           props: {
            editId: {
        type: Number,
        default: null,
        },
           showPopUp: {
               type: Boolean,
               default: false
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
