<template>

    <div class="container">
    <div class="form" @click="accountManagerPopUp()">
        <div class="icon_div"><font-awesome-icon :icon="['fas', 'chart-gantt']" /></div>
       <h4>Account Manager</h4>
    </div>
    <div class="form" @click="teamLeadPopUp()">
        <div class="icon_div"><font-awesome-icon :icon="['fas', 'chart-gantt']" /></div>
       <h4>Team Lead</h4>
    </div>
    <div class="form" @click="recruiterPopUp()">
        <div class="icon_div"><font-awesome-icon :icon="['fas', 'chart-gantt']" /></div>
       <h4>Recruiter</h4>
    </div>
    <div class="form" @click="userMatrixPopUp()">
        <div class="icon_div"><font-awesome-icon :icon="['fas', 'chart-gantt']" /></div>
       <h4>Matrix</h4>
    </div>
</div>
<UserMisForm
:showPopUp="popup"
    @closePopup ="closePopUp"
    :title="title"
   v-if="popup">

</UserMisForm>

</template>

<script>
import UserMisForm from './UserMisForm.vue'

    export default {
        name: 'UserMis',

        components:{
            UserMisForm,
             },

             data ()
       {
        return{
            popup:false,
            title:'',
        };
       },

       methods:{
        accountManagerPopUp(){
            this.popup=true;
            this.title="Account Manager"
        },
        teamLeadPopUp(){
            this.popup=true;
            this.title="Team Lead"
        },
        recruiterPopUp(){
            this.popup=true;
            this.title="Recruiter"
        },
        userMatrixPopUp(){
            this.popup=true;
            this.title="User Matrix"
        },

        closePopUp(data){
            this.popup = data;
        },
    },
    }
</script>
<style scoped>
*{

    background: cover;
}
.container{
    margin: 2% 5%;
    display: flex;
    flex-wrap: wrap;
    gap: 2%;
}
.form{
    width: 250px;
    background-color:whitesmoke;
    opacity: 0.9;
    border-radius: 10px;
    padding: 10px 20px;
    box-shadow: 0 0 6px 7px #F0F1F2;
    margin: 1%;
}
.form h4{
    color: #002147;
    font-size: 25px;
    text-align: center;
}
.icon_div{
    color: #002147;
    text-align: center;
    font-size: 30px;
}
</style>
