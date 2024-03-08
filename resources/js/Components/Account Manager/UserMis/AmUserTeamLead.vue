<template>
    <form @submit.prevent="submitForm">
   <table class="input_form">

       <tr>
   <td ><label >Employee Name</label></td>
   <td ><select id="location" class="color_cell" name="location">
   <option value="">Choose Location</option>

   </select>
   <!-- <span v-if="submitted && !validation.location" class="error">Location is required.</span> -->
   </td>
   </tr>

   <tr>
   <td ><label >Employee Email Id</label></td>
   <td ><select id="Client"  class="color_cell"  name="Client">
   <option value="">Choose Client</option>

   </select>
   <!-- <span v-if="submitted && !validation.name" class="error">Client Name is required.</span> -->
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
   </select>
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

   name:'AmUserTeamLead',

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
    }



</script>
