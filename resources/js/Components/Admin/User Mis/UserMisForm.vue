<template>

    <div class="popup">

        <div @click="closePopup()" class="close_btn"> <a ><font-awesome-icon :icon="['fas', 'xmark']" /></a></div>
        <div class="popup-inner">
            <h2 class="title">{{ title }}</h2>

            <UserAccountManagerForm @closePopup="closePopup()"
            v-if="title=='Account Manager'"/>

            <UserTeamLeadForm @closePopup="closePopup()"
            v-if="title=='Team Lead'"/>

            <UserRecruiterForm @closePopup="closePopup()"
            v-if="title=='Recruiter'"/>

            <UserMatrixForm @closePopup="closePopup()"
            v-if="title=='User Matrix'"/>

        </div>
    </div>
</template>

<script>
import UserAccountManagerForm from './UserAccountManagerForm.vue'
import UserTeamLeadForm from './UserTeamLeadForm.vue'
import UserRecruiterForm from './UserRecruiterForm.vue'
import UserMatrixForm from './UserMatrixForm.vue'

    export default {
        name: 'UserMisForm',

components:{
    UserAccountManagerForm,
    UserTeamLeadForm,
    UserRecruiterForm,
    UserMatrixForm,
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

    }
</script>

<style scoped>
.popup{
    position: fixed;
    top: 25px;
    left: 190px;
    padding: 15px 25px;
    z-index: 1;
    background-color: whitesmoke;
    /* opacity: 0.9; */
    width: 70%;
    height: 90%;
    border-radius: 25px;
    box-shadow: 2px 2px 7px 8px lightgray;

    overflow: scroll;
}

    .close_btn {
        position: absolute;
        right: 25px;
        color: #002147;
        font-size: 25px;
        cursor: pointer;
        padding: 10px;
    }

    .title{
        color: #002147;
        margin-left: 5%;
        font-size: 30px;
        letter-spacing: 5px;
        text-decoration: underline;
    }

</style>
