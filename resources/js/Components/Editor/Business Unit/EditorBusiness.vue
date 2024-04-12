<template>
    <div class="container">

<div class="form" @click="businessPopUp()">
     <div class="icon_div"><font-awesome-icon :icon="['fas', 'chart-gantt']" /></div>
    <h4>Buniness Unit</h4>
 </div>
</div>

<BusinessPopup
:showPopUp="popup"
    @closePopup ="closePopUp"
    :title="title"
   v-if="popup">

</BusinessPopup>

</template>

<script>
import BusinessPopup from './BusinessPopup.vue'

    export default {
    name:'EditorBusiness',
    components:{
        BusinessPopup,
    },
    data ()
       {
        return{
            popup:false,
            title:'',
        };
       },
       methods:{
        businessPopUp(){
            this.popup=true;
            this.title="Business Unit Form"
        },
        closePopUp(data){
            this.popup = data;
        },
    }
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
    background-color: #002147;
    opacity: 0.9;
    border-radius: 10px;
    padding: 10px 20px;
    margin: 1%;
    /* box-shadow: 0 0 6px 7px whitesmoke; */
}

.form h4{
    color: rgb(213, 242, 253);
    font-size: 25px;
    text-align: center;
}

.icon_div{
    color: lightblue;
    text-align: center;
    font-size: 30px;
}
</style>