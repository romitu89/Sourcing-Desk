<template>
    <div class="popup">
           <div @click="closePopup()" class="close_btn"> <a ><font-awesome-icon :icon="['fas', 'xmark']" /></a></div>
           <div class="popup-inner">
               <h2 class="title">{{ title }}</h2>
             
               <AmTrackerCreate 
               v-if="title=='Tracker Create'"/>
   
               <AmTrackerView 
               v-if="title=='Tracker View'"/>
   
           </div>
       </div>
   </template>
   
   <script>
   import AmTrackerCreate from './AmTrackerCreate.vue'
   import AmTrackerView from './AmTrackerView.vue'
   
       export default {
           name:'AmTrackerPopup',
   
           components:{
            AmTrackerCreate,
               AmTrackerView,
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
       components: { AmTrackerCreate, AmTrackerView }
   
       }
   </script>