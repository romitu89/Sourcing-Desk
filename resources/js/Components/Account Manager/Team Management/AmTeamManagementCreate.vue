<template>
    <form @submit.prevent="submitForm">
     <table class="input_form">

        <tr>
     <td ><label >Select Location</label></td>
     <td ><select id="location" name="location">
     <option value="">Select Location</option>
     <option v-for="item in userLocation" :key='item.location' :value="item.location">{{ item.location }}</option>

     </select></td>
     </tr>

     <tr>
    <td ><label >Job Type</label></td>
    <td ><select id="role" name="role">
    <option value="">Select Job</option>
    <option value="Admin">Admin</option>
    <option value="Team Lead">Team Lead</option>
    </select></td>
    </tr>

    <tr>
        <td><label>Select Team</label></td>
        <td>
          <multi-select :selectedTeam="selectedTeam" :options="teams" @update:selected="updateSelectedOptions"></multi-select>
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
import MultiSelect from '../../Shared Folder/MultiSelect.vue';

    export default {

        name:'AmTeamManagementCreate',

        components: {
    MultiSelect
  },

  data() {
    return {
      userLocation: [],
      teams: [],
      selectedTeam: [],
    };
  },


};
</script>
