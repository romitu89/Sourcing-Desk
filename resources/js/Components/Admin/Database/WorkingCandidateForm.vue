<template>
   <form @submit.prevent="submitForm">
    <table class="input_form">

    <tr>
    <td ><label >Select Country</label></td>
    <td ><select id="location" v-model.trim="client.location" class="color_cell"  name="Choose Location">
    <option value="">Choose Country</option>
    <option value="India">India</option>
    <option value="usa">USA</option>
    </select><br>
    <span v-if="submitted && !validation.location" class="error">Country is required.</span></td>
    </tr>

    <tr>
   <td ><label >From Date</label></td>
   <td ><input  v-model.trim="client.from"  type="date" >
       <span v-if="submitted && !validation.from" class="error">From Date is required.</span></td>
   </tr>

   <tr>
   <td ><label >To Date</label></td>
   <td ><input  v-model.trim="client.to"  type="date" >
       <span v-if="submitted && !validation.to" class="error">To Date is required.</span></td>
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
        name:'WorkingCandidateForm',


        data()
       {
           return{
               client: {
                location:"",
                from:"",
                to:"",

               },
               submitted:false,
           };
       },

       computed:{
           validation(){

               return {
                location: this.client.location.trim() !== '',
                from: this.client.from.trim() !== '',
                to: this.client.to.trim() !== '',


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
            
               },
           },
    }
</script>
