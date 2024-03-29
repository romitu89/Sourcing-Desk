<template>

    <form @submit.prevent="submitForm">
        <table class="input_form">
    
        <tr>
        <td ><label >Client Name</label></td>
        <td ><input type="text"  v-model="client.clientName" @blur="checkValidation('clientName')" placeholder="Client Name">
            <span v-if="errors.clientName" class="error">{{errors.clientName[0]}}</span></td>
        </tr>
    
        <tr>
        <td ><label >Business Unit Name</label></td>
        <td ><input type="text" v-model="client.businessName"  @blur="checkValidation('businessName')" placeholder="Business Unit Name">
            <span v-if="errors.businessName" class="error">{{errors.businessName[0]}}</span></td>
        </tr>
    
        <tr>
        <td ><label >Sub Location</label></td>
        <td ><input type="text" v-model="client.subLocation"  @blur="checkValidation('subLocation')" placeholder="Sub Location">
    
            <span v-if="errors.subLocation" class="error">{{errors.subLocation[0]}}</span></td>
        </tr>
    
        <tr>
        <td ><label >Select Location</label></td>
        <td ><select id="location" v-model="client.selectedLocation"  @blur="checkValidation('selectedLocation')" name="location">
        <option value="">Select Location</option>
        <option v-for="item in location" :key='item.country' :value="item.country">{{ item.country }}</option>

        </select><br><span v-if="errors.selectedLocation" class="error">{{errors.selectedLocation[0]}}</span></td>
        </tr>
    
        <tr>
        <td ><label >Client Manager Name</label></td>
        <td ><input type="text" v-model="client.selectedManagerName" @blur="checkValidation('selectedManagerName')" placeholder="Client Manager Name">
    
    
        </input><br><span v-if="errors.selectedManagerName" class="error">{{errors.selectedManagerName[0]}}</span></td>
        </tr>
    
        <tr>
        <td ><label >Client Manager Email ID</label></td>
        <td ><input type="text" v-model="client.selectedManager"  @blur="checkValidation('selectedManager')" placeholder="Client Manager Email ID">
    
    
        </input><br><span v-if="errors.selectedManager" class="error">{{errors.selectedManager[0]}}</span></td>
        </tr>

        <tr>
        <td ><label >Assign Account Manager</label></td>
        <td ><select id="location" v-model="client.selectedAccountManager"  @blur="checkValidation('selectedLocation')" name="location">
        <option value="">Select Account Manager</option>
        <option v-for="item in managersData" :key='item.email_id' :value="item.email_id">{{ item.email_id }}</option>

        </select><br><span v-if="errors.selectedAccountManager" class="error">{{errors.selectedAccountManager[0]}}</span></td>
        </tr>
    
        <tr>
            <td></td>
           <td> <button @click="closePopup()" class="cancel_btn">Cancel</button>
            <button class="submit_btn">Submit</button> </td>
        </tr>
    
    </table>
    </form>
    
    
    </template>
    
    <script>
    import Swal from 'sweetalert2'
    
    
    export default {
        name: 'ClientEditForm',

        props: {
        editId: {
        type: Number,
        default: null,
        },
    },
    
        data()
            {
                return{
                    client: {
                        clientName:"",
                        businessName:"",
                        subLocation:"",
                        selectedManager:"",
                        selectedLocation:"",
                        selectedManagerName:"",
                        selectedAccountManager:"",
                    },
                    location:[],
                    managersData:[],
                    userLocation:[],
                    errors:{},
                    editEmployee:{},
    
                };
            },
    
           
            methods:{
    
                closePopup() {
          this.$emit("closePopup");
        },
        checkValidation(fieldName) {
          let dataError = Object.values(this.errors);
          if (dataError.length > 1) {
            this.submitForm();
          } else {
            if (this.errors.hasOwnProperty(fieldName)) {
              delete this.errors[fieldName];
            }
          }
        },
    
        getUserDetails() {
      axios
        .get("/api/adminclient-edit/" + this.editId)
        .then((response) => {
          console.log(response.data.client, "data");
          this.editEmployee = response.data.client;
          this.client.clientName = this.editEmployee.client_name;
          this.client.businessName = this.editEmployee.business_unit_name;
          this.client.subLocation = this.editEmployee.sub_location;
          this.client.selectedManager = this.editEmployee.client_manager_email;
          this.client.selectedLocation = this.editEmployee.location;
          this.client.selectedManagerName = this.editEmployee.client_manager_name;
          this.client.selectedAccountManager = this.editEmployee.am_email;
          
        })
        .catch((error) => {
          console.log(error);
          this.errored = true;
        });
    },
    
    userLocationApi()
    {
    axios
    .get("/api/adminclient-create")
    .then(response => {
      this.managersData = response.data.accountmanagers
      this.location = response.data.location
    console.log(this.managersData)
    })
    .catch(error => {
    console.log(error)
    this.errored = true
    })
    
    },
    
       submitForm() {
      this.submitted = true;
      axios
        .patch("/api/adminclient-edit/" + this.editId, this.client)
        .then((response) => {
          if (response.data.message) {
            
            this.errors = {};
            //console.log("editSuccess")
           this.$emit("editSuccess", this.client.clientName)
           
          }
        })
        .catch((error) => {
          console.error(error.response.data.errors);
          this.errors = error.response.data.errors;
        });
    },
  },  
    
    mounted(){
        this.userLocationApi();
        this.getUserDetails();
        
    }
    
    
    }
    </script>
    
    <style scoped>
    .input_form td{
    
        /* border: 2px solid red; */
        padding: 10px 40px;
        font-size: 20px;
    }
    
    .input_form td select{
        padding: 10px 20px;
        width: 400px;
    }
    
    
    .cancel_btn{
        padding: 10px 25px;
        background-color: rgb(252, 64, 64);
        border-radius: 5px;
    
    }
    .submit_btn{
        padding: 10px 25px;
        background-color: #227C09;
        border-radius: 5px;
        margin-left: 5px;
    
    }
    
    .cancel_btn:hover{
        box-shadow: 2px 2px 4px 5px darkgray;
    }
    .submit_btn:hover{
        box-shadow: 2px 2px 4px 5px darkgray;
    }
    
    </style>
    