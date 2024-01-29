<template>

    <div class="container">

    <div class="form" @click="clientMisPopUp()">
        <div class="icon_div"><font-awesome-icon :icon="['fas', 'chart-gantt']" /></div>
       <h4>Client Report</h4>
    </div>
    <div class="form" @click="clientManagerPopUp()">
        <div class="icon_div"><font-awesome-icon :icon="['fas', 'chart-gantt']" /></div>
       <h4>Client Manager Report</h4>
    </div>
    <div class="form" @click="clientMatrixPopUp()">
        <div class="icon_div"><font-awesome-icon :icon="['fas', 'chart-gantt']" /></div>
       <h4>Matrix</h4>
    </div>
</div>
<ClientMisForm 
:showPopUp="popup"
    @closePopup ="closePopUp" 
    :title="title"
   v-if="popup">

</ClientMisForm>
</template>

<script>
import ClientMisForm from './Popup/ClientMisForm.vue'

    export default{
        name: 'ClientsMis',
        components:{
            ClientMisForm,
        },
        data ()
       {
        return{
            popup:false,
            title:'',
        };
       },
       methods:{
        clientMisPopUp(){
            this.popup=true;
            this.title="Client Report"
        },
        clientManagerPopUp(){
            this.popup=true;
            this.title="Client Manager Report"
        },
        clientMatrixPopUp(){
            this.popup=true;
            this.title="Client Matrix"
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