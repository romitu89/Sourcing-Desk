<template>
    <form @submit.prevent="submitForm">
     <table class="input_form">

         <tr>
     <td ><label >Select Location</label></td>
     <td ><select id="location" v-model.trim="client.location" class="color_cell" name="location">
     <option value="">Choose Location</option>
     <option value="India">India</option>
     <option value="usa">USA</option>
     </select><br>
     <span v-if="submitted && !validation.location" class="error">Location is required.</span></td>
     </tr>

     <tr>
     <td ><label >Client Name</label></td>
     <td ><select id="client"  v-model.trim="client.name" class="color_cell"  name="client">
     <option value="">Choose Client</option>
     <option value="India">India</option>
     <option value="usa">USA</option>
     </select><br>
     <span v-if="submitted && !validation.name" class="error">Client Name is required.</span>
     </td>
     </tr>

     <tr>
     <td ><label >Business Unit</label></td>
     <td ><select id="business"  v-model.trim="client.business" class="color_cell"  name="business">
     <option value="">Choose B-Unit</option>
     <option value="India">India</option>
     <option value="usa">USA</option>
     </select><br>
     <span v-if="submitted && !validation.business" class="error">Business Unit is required.</span>
     </td>
     </tr>

     <tr>
     <td ><label >Select Matrix</label></td>
     <td ><select id="matrix"  v-model.trim="client.matrix"  name="matrix">
     <option value="">Choose Matrix</option>
     <option value="requirements">Requirements</option>
     <option value="submission">Submission</option>
     <option value="Selection">Selection</option>
     <option value="Rejections">Rejections</option>
     <option value="Onboarded">Onboarded</option>
     <option value="Dropouts">Dropouts</option>
     <option value="Offboarded">Offboarded</option>
     </select><br>
     <span v-if="submitted && !validation.matrix" class="error">Matrix is required.</span>
     </td>
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
     name: 'ClientReportForm',

     data()
         {
             return{
                 client: {
                     name:"",
                     business:"",
                     location:"",
                     matrix:"",
                     from:"",
                     to:"",
                 },
                 submitted:false,
             };
         },

         computed:{
             validation(){
                 return {
             name: this.client.name.trim() !== '',
             business: this.client.business.trim() !== '',
             location: this.client.location.trim() !== '',
             matrix: this.client.matrix.trim() !== '',
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
                 else {
                         Swal.fire("Form not Submitted");
                         }
                 },
             },


 }
 </script>
