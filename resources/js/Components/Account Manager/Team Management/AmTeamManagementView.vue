<template>
    <form @submit.prevent="submitForm">
     <table class="input_form">

        <tr>
     <td ><label >Select Location</label></td>
     <td ><select id="location" name="location">
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

    <div v-if="results">
                    <responsive-table :results="results" :columns="columns" :buttonAction="buttonAction">


                      <!-- <template #edit="{ row }">
                        <Link

                          >Edit</Link
                        >
                      </template> -->
                    </responsive-table>
                  </div>

 </template>

<script>
    export default {
        name:'AmTeamManagementView',

        data() {
    return {
        buttonAction: false,
      teamManager:{
      selectedLocation:'',

      },
      errors:{},
      userLocation: [],

    };
  },
  methods: {
    closePopup() {
      this.$emit("closePopup");
    },

userLocationApi()
{
axios
.get('/api/amteam-view')
.then(response => {
this.userLocation = response.data.locations
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

    axios.post('/api/amteam-view', this.teamManager)
.then(response => {

  this.results = response.data.results;

  this.errors={};
  if (Object.values(this.errors).length == 0) {
            this.buttonAction = true;
          }


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
