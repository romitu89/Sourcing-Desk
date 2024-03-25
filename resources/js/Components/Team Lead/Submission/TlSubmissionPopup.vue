<template>
    <div class="popup">
           <div @click="closePopup()" class="close_btn"> <a ><font-awesome-icon :icon="['fas', 'xmark']" /></a></div>
           <div class="popup-inner">
               <h2 class="title">{{ title }}</h2>

               <TlSubmissionRequest @closePopup="closePopup()"
               v-if="title=='Submission Request'"/>

               <TlInbox @closePopup="closePopup()"
               v-if="title=='Submission Inbox'"/>
           </div>
       </div>
</template>

<script>
import TlSubmissionRequest from './TlSubmissionRequest.vue'
import TlInbox from './TlInbox.vue'


export default {
    name:'TlSubmissionPopup',

    components:{
        TlSubmissionRequest,
        TlInbox,
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
       components: { TlSubmissionRequest, TlInbox }

}

</script>
