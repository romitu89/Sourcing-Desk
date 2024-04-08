<template>

    <div class="container">
 
    <div class="form" @click="clientPopUp()">
         <div class="icon_div"><font-awesome-icon :icon="['fas', 'chart-gantt']" /></div>
         <h4>Create</h4>
     </div>
 
     <div class="form" @click="viewPopUp()">
         <div class="icon_div"><font-awesome-icon :icon="['fas', 'chart-gantt']" /></div>
        <h4>View</h4>
     </div>
 
     </div>
     <ClientForm
     :showPopUp="popup"
     @closePopup="closePopUp"
     @updateForm="updateForm"
     @editSuccess="editSuccess"
     :title="title"
     :editId="editId"
     :empName="empName"
     v-if="popup"
     >
    </ClientForm>
 
 </template>
 
 <script>
 import ClientForm from './ClientForm.vue'
 
     export default {
         name: 'EditorClient',
     components:{
         ClientForm,
     },
 
     data ()
        {
         return{
             popup: false,
             title: "",
             editId: null,
             empName:"",
         };
        },
 
        methods:{
         clientPopUp(){
             this.popup=true;
             this.title="Client Create"
         },
         viewPopUp(){
             this.popup=true;
             this.title="Client View"
         },
 
         closePopUp(data){
             this.popup = data;
         },
         updateForm(id) {
             this.title = "Edit Form";
             this.popup = true;
             this.editId = id;
             console.log(this.editId, "client.vue edit id")
         },
         editSuccess(name){
         this.popup = true;
         this.title = "Client View";
         this.empName=name;
         console.log( "client vue")
         },
     },
 
     
     }
 </script>
 
 <style scoped>
 /* .colour {
     background-color: #162541;
     width: 1400px;
     height: 100%;
 } */
 
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
     cursor: pointer;
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
 