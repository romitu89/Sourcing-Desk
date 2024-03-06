<template>
    <form @submit.prevent="submitForm">
     <table class="input_form">

        <tr>
    <td ><label >Client Name</label></td>
    <td ><input type="text" placeholder="Subject Line" >
      <!-- <span v-if="errors.subject" class="error">{{errors.subject[0]}}</span> -->
      </td>
    </tr>

    <tr>
    <td ><label >Business Unit Name</label></td>
    <td ><input type="text" placeholder="Request Body" >
      <!-- <span v-if="errors.requestBody" class="error">{{errors.requestBody[0]}}</span> -->
      </td>
    </tr>

        <tr>
    <td ><label >Sub Location </label></td>
    <td ><input type="text" placeholder="Requirement Name" >
      <!-- <span v-if="errors.requirement" class="error">{{errors.requirement[0]}}</span> -->
      </td>
    </tr>

    <tr>
    <td ><label >Account Manager </label></td>
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
        name: 'ActiveRequest',

    }
</script>
