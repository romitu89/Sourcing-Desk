<template>
    <div class="popup">
           <div @click="closePopup()" class="close_btn"> <a ><font-awesome-icon :icon="['fas', 'xmark']" /></a></div>
           <div class="popup-inner">
               <h2 class="title">{{ title }}</h2>

               <AmUserTeamLead @closePopup="closePopup()"
               v-if="title =='Team Lead'"/>

               <AmUserMisRecruiter @closePopup="closePopup()"
               v-if="title =='Recruiter'"/>



           </div>
       </div>
</template>

<script>
import AmUserTeamLead from './AmUserTeamLead.vue'
import AmUserMisRecruiter from './AmUserMisRecruiter.vue'


export default {
    name:'AmUserMisPopup',

    components:{
        AmUserTeamLead,
        AmUserMisRecruiter,

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
       components: { AmUserTeamLead, AmUserMisRecruiter }

}

</script>
