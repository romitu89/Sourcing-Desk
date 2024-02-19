<template>
    <div class="popup">
           <div @click="closePopup()" class="close_btn"> <a ><font-awesome-icon :icon="['fas', 'xmark']" /></a></div>
           <div class="popup-inner">
               <h2 class="title">{{ title }}</h2>
             
               <AmTeamManagementCreate 
               v-if="title=='Team Management Create'"/>
   
               <AmTeamManagementView 
               v-if="title=='Team Management View'"/>
   
           </div>
       </div>
   </template>
   
   <script>
   import AmTeamManagementCreate from './amteammanagementcreate.vue'
   import AmTeamManagementView from './AmTeamManagementView.vue'
   
       export default {
           name:'AmTeamManagementPopup',
   
           components:{
            AmTeamManagementCreate,
            AmTeamManagementView,
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
       components: { AmTeamManagementCreate, AmTeamManagementView }
   
       }
   </script>