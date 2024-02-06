<template>
    <form @submit.prevent="submitForm">
     <table class="input_form">

     <tr>
     <td ><label >Select Country</label></td>
     <td ><select id="Location"  v-model.trim="client.location" class="color_cell"  name="Choose Location">
     <option value="">Choose Country</option>
     <option value="India">India</option>
     <option value="usa">USA</option>
     </select>
     <span v-if="submitted && !validation.location" class="error">Country is required.</span></td>
     </tr>

     <tr>
     <td ><label >Select Duration</label></td>
     <td ><select id="Location"  v-model.trim="client.duration" name="Choose Location">
     <option value="">Choose Duration</option>
     <option value="India">India</option>
     <option value="usa">USA</option>
     </select>
     <span v-if="submitted && !validation.duration" class="error">Duration is required.</span></td>
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
 import Swal from 'sweetalert2'
     export default {
         name:'FilteredDatabaseForm',

         data()
        {
            return{
                client: {
                 location:"",
                 duration:"",


                },
                submitted:false,
            };
        },

        computed:{
            validation(){

                return {
                 location: this.client.location.trim() !== '',
                 duration: this.client.duration.trim() !== '',


            };
            },

            isFormValid() {

                return Object.values(this.validation).every(value => value);
            },

            },

            methods:{
            submitForm() {
                this.submitted = true; // Set the submitted flag to true when attempting to submit the form
                if (this.isFormValid) {
                Swal.fire({
                        position: "top-center",
                        icon: "success",
                        title: "Your form has been submitted",
                        showConfirmButton: false,
                        timer: 5000
                        });
 // You might want to reset the form and submitted flag here if needed
                        }
                else {
                        Swal.fire("Form not Submitted");
                        }
                },
            },

     }
 </script>
