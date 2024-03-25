<template>
    <form @submit.prevent="submitForm">
     <table class="input_form">
     <tr>
     <td ><label >Select Location</label></td>
     <td ><select id="location" v-model="amSubmission.selectedLocation" name="location">
     <option value="">Select Location</option>
     <option v-for="item in userLocation" :key='item.location' :value="item.location">{{ item.location }}</option>

     </select><br><span v-if="errors.selectedLocation" class="error">{{errors.selectedLocation[0]}}</span></td>
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
    export default {

        name:'AmSubmissionRequest',

        data ()
        {
            return{
                amSubmission:{
                    selectedLocation:"",
                },
                userLocation:[],
                errors:[],
            };
        },

        methods:{
            closePopup() {
      this.$emit("closePopup");
    },

userLocationApi()
{
axios
.get('/api/amrequest-create')
.then(response => {
console.log(response.data, "data")
// console.log(response.data.location, "location")

this.userLocation = response.data
console.log(this.userLocation, "location")
})
.catch(error => {
console.log(error)
this.errored = true
})

},

submitForm() {
    this.submitted = true; // Set the submitted flag to true when attempting to submit the form
    // if (this.isFormValid) {

        axios.post('/api/amrequest-create', this.amSubmission)
  .then(response => {
      console.log('Form submitted:', response.data.message);
      if(response.data.message){
        this.errors={};

         Swal.fire({
            position: "top-center",
            icon: "success",
            title: "User created successfully",
            showConfirmButton: false,
            timer: 3000
            });

      }
      else{
        Swal.fire("Form not Submitted");
      }

      // Handle the response as needed
   })
  .catch(error => {
    //   console.error('Error submitting form:', error.response.data.errors);
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
