<template>
    <form @submit.prevent="submitForm">
     <table class="input_form">

        <tr>
    <td ><label >Subject Line</label></td>
    <td ><input type="text" placeholder="Subject Line" >
      <!-- <span v-if="errors.subject" class="error">{{errors.subject[0]}}</span> -->
      </td>
    </tr>

    <tr>
    <td ><label >Request Body</label></td>
    <td ><input type="text" placeholder="Request Body" >
      <!-- <span v-if="errors.requestBody" class="error">{{errors.requestBody[0]}}</span> -->
      </td>
    </tr>

        <tr>
    <td ><label >Requirement Name</label></td>
    <td ><input type="text" placeholder="Requirement Name" >
      <!-- <span v-if="errors.requirement" class="error">{{errors.requirement[0]}}</span> -->
      </td>
    </tr>

    <tr>
     <td ><label >Requester</label></td>
     <td ><select id="client"  name="client">
     <option value="">Select Client</option>
     <!-- <option v-for="item in userLocation" :key='item.location' :value="item.location">{{ item.location }}</option> -->

     </select>
     <!-- <span v-if="errors.selectedClient" class="error">{{errors.selectedClient[0]}}</span> -->
     </td>
     </tr>

        <tr>
    <td ><label >Job Type</label></td>
    <td ><select id="role" name="role">
    <option value="">Select Job</option>
    <option value="Admin">Admin</option>
    <option value="Team Lead">Team Lead</option>
    </select>
    <!-- <span v-if="errors.jobType" class="error">{{errors.jobType[0]}}</span> -->
    </td>
    </tr>

        <tr>
     <td ><label >Client Name</label></td>
     <td ><select id="client"  name="client">
     <option value="">Select Client</option>
     <!-- <option v-for="item in userLocation" :key='item.location' :value="item.location">{{ item.location }}</option> -->

     </select>
     <!-- <span v-if="errors.selectedClient" class="error">{{errors.selectedClient[0]}}</span> -->
     </td>
     </tr>

     <tr>
     <td ><label >Buisness Unit</label></td>
     <td ><select id="buisness" name="buisness">
     <option value="">Select Unit</option>
     <!-- <option v-for="item in userLocation" :key='item.location' :value="item.location">{{ item.location }}</option> -->

     </select>
     <!-- <span v-if="errors.selectedBusiness" class="error">{{errors.selectedBusiness[0]}}</span> -->
     </td>
     </tr>

     <tr>
     <td ><label >Client Location</label></td>
     <td ><select id="location"  name="location">
     <option value="">Select Location</option>
     <!-- <option v-for="item in userLocation" :key='item.location' :value="item.location">{{ item.location }}</option> -->

     </select>
     <!-- <span v-if="errors.selectedLocation" class="error">{{errors.selectedLocation[0]}}</span> -->
     </td>
     </tr>

     <tr>
    <td ><label >Client Manager Name</label></td>
    <td ><input type="text" placeholder="Requirement Name" >
      <!-- <span v-if="errors.requirement" class="error">{{errors.requirement[0]}}</span> -->
      </td>
    </tr>

     <tr>
         <td></td>
        <td> <button class="cancel_btn">Cancel</button>
         <button  class="submit_btn">Submit</button> </td>
     </tr>

     </table>

    </form>

 </template>

<script>
    export default {
        name: 'RequestCreate',

    }
</script>
