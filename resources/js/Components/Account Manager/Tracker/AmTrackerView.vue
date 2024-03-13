<template>
    <form @submit.prevent="submitForm">
     <table class="input_form">
        
        <tr>
     <td ><label >Select Location</label></td>
     <td ><select id="location" v-model="tracker.selectedLocation" name="location">
     <option value="">Select Location</option>
     <option v-for="item in userLocation" :key='item.location' :value="item.location">{{ item.location }}</option>

     </select><br><span v-if="errors.selectedLocation" class="error">{{errors.selectedLocation[0]}}</span></td>
     </tr>

        <tr>
     <td ><label >Client Name</label></td>
     <td ><select id="client" v-model="tracker.selectedClient" name="client">
     <option value="">Select Client</option>
     <option v-for="item in userLocation" :key='item.client_name' :value="item.client_name">{{ item.client_name }}</option>

     </select><br><span v-if="errors.selectedClient" class="error">{{errors.selectedClient[0]}}</span></td>
     </tr>

     <tr>
     <td ><label >Buisness Unit</label></td>
     <td ><select id="buisness" v-model="tracker.selectedBusiness" name="buisness">
     <option value="">Select Unit</option>
     <option v-for="item in userLocation" :key='item.business_unit' :value="item.business_unit">{{ item.business_unit }}</option>

     </select><br><span v-if="errors.selectedBusiness" class="error">{{errors.selectedBusiness[0]}}</span></td>
     </tr>

     <tr>
     <td ><label >Client Manager Name</label></td>
     <td ><select id="buisness" v-model="tracker.selectedManager" name="buisness">
     <option value="">Select Manager</option>
     <option v-for="item in userLocation" :key='item.client_manager_name' :value="item.client_manager_name">{{ item.client_manager_name }}</option>

     </select><br><span v-if="errors.selectedManager" class="error">{{errors.selectedManager[0]}}</span></td>
     </tr>


     <tr>
         <td></td>
        <td>
         <button  class="submit_btn">Submit</button> </td>
     </tr>

     </table>

    </form>

 </template>

<script>
    export default {
        name:'AmTrackerView',

        data ()
        {
            return {
                tracker:{
                selectedLocation:'',
                selectedClient:'',
                selectedBusiness:'',
                selectedManager:'',
                },
                userLocation:[],
                errors:{},
            };
        },

        methods: {

    userLocationApi()
    {
    axios
    .get('/api/amtracker-view')
    .then(response => {
    this.userLocation = response.data.client
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

        axios.post('/api/amtracker-view', this.tracker)
    .then(response => {
      console.log('Form submitted:', response.data.results);
      this.results = response.data.results;
      console.log(this.results,"results")

      this.errors={};


      // Handle the response as needed
    })
    .catch(error => {
      console.error('Error submitting form:', error.response.data.errors);
      this.errors= error.response.data.errors;
      console.log(this.errors, "error")
    });
},
    },
    mounted(){
    this.userLocationApi()

},


    }
</script>
