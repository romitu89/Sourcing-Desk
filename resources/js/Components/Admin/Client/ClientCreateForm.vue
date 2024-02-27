<template>

<form @submit.prevent="submitForm">
    <table class="input_form">

    <tr>
    <td ><label >Client Name</label></td>
    <td ><input type="text"  v-model="client.clientName" placeholder="Client Name">
        <span v-if="errors.clientName" class="error">{{errors.clientName[0]}}</span></td>
    </tr>

    <tr>
    <td ><label >Business Unit Name</label></td>
    <td ><input type="text" v-model="client.businessName" placeholder="Business Unit Name">
        <span v-if="errors.businessName" class="error">{{errors.businessName[0]}}</span></td>
    </tr>

    <tr>
    <td ><label >Sub Location</label></td>
    <td ><input type="text" v-model="client.subLocation" placeholder="Sub Location">

        <span v-if="errors.subLocation" class="error">{{errors.subLocation[0]}}</span></td>
    </tr>

    <tr>
    <td ><label >Select Location</label></td>
    <td ><select id="location" v-model="client.selectedLocation" name="location">
    <option value="">Select Location</option>
    <option v-for="item in managersData" :key='item.location' :value="item.location">{{ item.location }}</option>

    </select><span v-if="errors.selectedLocation" class="error">{{errors.selectedLocation[0]}}</span></td>
    </tr>

    <tr>
    <td ><label >Account Manager</label></td>
    <td ><select id="location" v-model="client.selectedManager" name="location">
    <option value="">Select Location</option>
    <option v-for="item in managersData" :key='item.email_id' :value="item.email_id">{{ item.email_id }}</option>

    </select><span v-if="errors.selectedManager" class="error">{{errors.selectedManager[0]}}</span></td>
    </tr>

    <tr>
        <td></td>
       <td> <button class="cancel_btn">Cancel</button><button class="submit_btn">Submit</button> </td>
    </tr>

</table>
</form>


</template>

<script>
import Swal from 'sweetalert2'


export default {
    name: 'ClientCreateForm',

    data()
        {
            return{
                client: {
                    clientName:"",
                    businessName:"",
                    subLocation:"",
                    selectedManager:"",
                    selectedLocation:"",
                },
                managersData:[],
                userLocation:[],
                errors:{},
            };
        },

        methods:{

userLocationApi()
{
axios
.get('/api/adminclient-create')
.then(response => {
this.managersData = response.data.accountmanagers
console.log(this.userLocation)
})
.catch(error => {
console.log(error)
this.errored = true
})

},

submitForm() {
    this.submitted = true; // Set the submitted flag to true when attempting to submit the form
    // if (this.isFormValid) {

        axios.post('/api/adminclient-create', this.client)
  .then(response => {
      console.log('Form submitted:', response.data.successMessage);
      if(response.data.successMessage){
        this.errors={};

         Swal.fire({
            position: "top-center",
            icon: "success",
            title: "User created successfully",
            showConfirmButton: false,
            timer: 5000
            });

      }
      else{
        Swal.fire("Form not Submitted");
      }

      // Handle the response as needed
   })
  .catch(error => {
      console.error('Error submitting form:', error.response.data.errors);
      this.errors= error.response.data.errors;
   });




// You might want to reset the form and submitted flag here if needed

    },
},

mounted(){
    this.userLocationApi()

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
