<template>

    <div class="container">

   <div class="form" @click="workingCandidatePopUp()">
        <div class="icon_div"><font-awesome-icon :icon="['fas', 'chart-gantt']" /></div>
       <h4>Working Candidate</h4>
    </div>

    <div class="form" @click="filteredDatabasePopUp()">
        <div class="icon_div"><font-awesome-icon :icon="['fas', 'chart-gantt']" /></div>
       <h4>Filtered Database</h4>
    </div>
    </div>
    <DatabaseForm 
    :showPopUp="popup"
    @closePopup ="closePopUp" 
    :title="title"
   v-if="popup">
   
   </DatabaseForm>
</template>

<script>
import DatabaseForm from './Popup/DatabaseForm.vue'

    export default {
        name: 'Database',

        components:{
            DatabaseForm,
        },

        data ()
       {
        return{
            popup:false,
            title:'',
        };
       },

       methods:{
        workingCandidatePopUp(){
            this.popup=true;
            this.title="Working Candidate"
        },
        filteredDatabasePopUp(){
            this.popup=true;
            this.title="Filtered Database"
        },

        closePopUp(data){
            this.popup = data;
        },
    },

    }
</script>

<style scoped>
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