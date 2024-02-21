<template>
    <div class="popup">
           <div @click="closePopup()" class="close_btn"> <a ><font-awesome-icon :icon="['fas', 'xmark']" /></a></div>
           <div class="popup-inner">
               <h2 class="title">{{ title }}</h2>

               <TlTrackerCreate
               v-if="title=='Tracker Create'"/>

               <TlTrackerView
               v-if="title=='Tracker View'"/>

           </div>
       </div>
   </template>

   <script>

   import TlTrackerCreate from './TlTrackerCreate.vue'
   import TlTrackerView from './TlTrackerView.vue'

       export default {
           name:'TlTrackerPopup',

           components:{
            TlTrackerCreate,
               TlTrackerView,
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
       components: { TlTrackerCreate, TlTrackerView }

       }
   </script>
