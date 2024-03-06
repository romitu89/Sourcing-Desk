<template>
    <form @submit.prevent="submitForm">
     <table class="input_form">

        <tr>
    <td ><label >Select Location</label></td>
    <td ><select id="location" name="location">
    <option value="">Select Location</option>
    <option v-for="item in managersData" :key='item.location' :value="item.location">{{ item.location }}</option>

    </select>
    <!-- <span v-if="errors.selectedLocation" class="error">{{errors.selectedLocation[0]}}</span> -->
    </td>
    </tr>

    <tr>
    <td ><label >Candidate Mobile Number</label></td>
    <td ><select id="location" name="location">
    <option value="">Select Location</option>
    <!-- <option v-for="item in managersData" :key='item.location' :value="item.location">{{ item.location }}</option> -->

    </select>
    <!-- <span v-if="errors.selectedLocation" class="error">{{errors.selectedLocation[0]}}</span> -->
    </td>
    </tr>

    <tr>
     <td ><label >Date For LWD</label></td>
     <td ><input  type="date" >
         <!-- <span v-if="errors.dob" class="error">{{errors.dob[0]}}</span> -->
         </td>
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
        name: 'CandidateUpdate',

    }
</script>
