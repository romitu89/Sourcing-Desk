<template>
    <form @submit.prevent="submitForm">
     <table class="input_form">

        <tr>
     <td ><label >Select Country</label></td>
     <td ><select id="Location"  class="color_cell"  name="Choose Location">
     <option value="">Choose Country</option>
     <option value="India">India</option>
     <option value="usa">USA</option>
     </select>
     <!-- <span v-if="submitted && !validation.location" class="error">Country is required.</span> -->
     </td>
     </tr>

     <tr>
    <td ><label >From Date</label></td>
    <td ><input type="date" >
        <!-- <span v-if="submitted && !validation.from" class="error">From Date is required.</span> -->
        </td>
    </tr>

    <tr>
    <td ><label >To Date</label></td>
    <td ><input  type="date" ></td>
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
        name: 'WorkingCandidate',

    }
</script>
