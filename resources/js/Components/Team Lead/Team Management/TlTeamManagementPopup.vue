<template>
    <div class="popup">
           <div @click="closePopup()" class="close_btn"> <a ><font-awesome-icon :icon="['fas', 'xmark']" /></a></div>
           <div class="popup-inner">
               <h2 class="title">{{ title }}</h2>

               <TlTeamManagementCreate
               v-if="title=='Team Management Create'"/>

               <TlTeamManagementView
               v-if="title=='Team Management View'"/>

           </div>
       </div>
   </template>

   <script>
   import TlTeamManagementCreate from './Tlteammanagementcreate.vue'
   import TlTeamManagementView from './TlTeamManagementView.vue'

       export default {
           name:'TlTeamManagementPopup',

           components:{
            TlTeamManagementCreate,
            TlTeamManagementView,
           },
           props: {
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
           }
       },
       data() {
           return {
               showUserCreate: this.tab,
           };
       },
       methods: {
           closePopup() {
               console.log(this.showUserCreate);
               this.showUserCreate = false;
               this.$emit('closePopup', this.showUserCreate);
           }
       },
       components: { TlTeamManagementCreate, TlTeamManagementView }

       }
   </script>
