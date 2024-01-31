<template>

    <div class="container">

   <div class="form" @click="profileCreatePopUp()">
        <div class="icon_div"><font-awesome-icon :icon="['fas', 'chart-gantt']" /></div>
       <h4>Create</h4>
    </div>

    <div class="form" @click="profileViewPopUp()">
        <div class="icon_div"><font-awesome-icon :icon="['fas', 'chart-gantt']" /></div>
       <h4>View</h4>
    </div>
    </div>
    <ProfileUpdatingForm
    :showPopUp="popup"
    @closePopup ="closePopUp" 
    :title="title"
   v-if="popup">

    </ProfileUpdatingForm>
</template>


<script>
import ProfileUpdatingForm from './Popup/ProfileUpdatingForm.vue'

    export default {
        name: 'ProfileUpdating',
        components:{
            ProfileUpdatingForm,
        },

        data ()
       {
        return{
            popup:false,
            title:'',
        };
       },

       methods:{
        profileCreatePopUp(){
            this.popup=true;
            this.title="Profile Create"
        },
        profileViewPopUp(){
            this.popup=true;
            this.title="Profile View"
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