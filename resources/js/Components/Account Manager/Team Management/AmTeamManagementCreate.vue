<template>
    <form @submit.prevent="submitForm">
      <table class="input_form">
        <tr>
          <td><label>Select Location</label></td>
          <td>
            <select id="location" v-model="teamManager.selectedLocation" @blur="checkValidation('selectedLocation')" name="location">
              <option value="">Select Location</option>
              <option
                v-for="item in location"
                :key="item.location"
                :value="item.location"
              >
                {{ item.location }}
              </option>
            </select>
            <br />
            <span v-if="errors.selectedLocation" class="error">{{ errors.selectedLocation[0] }}</span>
          </td>
        </tr>

        <tr v-if="teamManager.selectedLocation">
          <td><label>Client Name</label></td>
          <td>
            <select id="clientName" v-model="teamManager.clientName" @blur="checkValidation('clientName')" name="clientName">
              <option value="">Select Client</option>
              <option v-for="item in client" :key="item.client_name" :value="item.client_name">
                {{ item.client_name }}
              </option>
            </select>
            <br />
            <span v-if="errors.clientName" class="error">{{ errors.clientName[0] }}</span>
          </td>
        </tr>

        <tr v-if="teamManager.selectedLocation && teamManager.clientName">
          <td><label>Job Type</label></td>
          <td>
            <select id="jobType" v-model="teamManager.jobType" @blur="checkValidation('jobType')" name="jobType">
              <option value="">Select Job</option>
              <option value="permanent">Permanent</option>
              <option value="contract">Contract</option>
              <option value="both">Both</option>
            </select>
            <br />
            <span v-if="errors.jobType" class="error">{{ errors.jobType[0] }}</span>
          </td>
        </tr>

        <tr v-if="teamManager.selectedLocation && teamManager.clientName && teamManager.jobType">
          <td><label>Select Team</label></td>
          <td>
            <multi-select
              :selectedTeam="teamManager.selectedTeam"
              :options="teams"
              @update:selected="updateSelectedOptions"
              @blur="checkValidation('selectedTeam')"
            >
            </multi-select>
            <span v-if="errors.selectedTeam" class="error">{{ errors.selectedTeam[0] }}</span>
          </td>
        </tr>

        <tr>
          <td></td>
          <td>
            <button @click="closePopup()" class="cancel_btn">Cancel</button>
            <button class="submit_btn">Submit</button>
          </td>
        </tr>
      </table>
    </form>
  </template>

  <script>
  import { commonFunctionsMixin } from '../../../function.js';
  import MultiSelect from "../../Shared Folder/MultiSelect.vue";
  import Swal from 'sweetalert2';
  import axios from 'axios';

  export default {
    name: "AmTeamManagementCreate",
    mixins:[commonFunctionsMixin],
    components: {
      MultiSelect,
    },

    data() {
      return {
        teamManager: {
          selectedLocation: "",
          jobType: "",
          clientName:"",
          selectedTeam: [],
        },
        errors: {},
        location: [],
        client:[],
        teams: [],
      };
    },
    methods: {
      closePopup() {
        this.$emit("closePopup");
      },

      userLocationApi() {
        axios
          .get("/api/amteam-create")
          .then((response) => {
            this.location = response.data.location;
            this.client = response.data.client

            const teamEmail = response.data.teamEmail;

            teamEmail.forEach((tm) => {
              this.teams.push({
                label: tm.email_id,
                value: tm.email_id,
              });
            });
          })
          .catch((error) => {
            console.error(error);
            this.errored = true;
          });
      },

      updateSelectedOptions(newVal) {
        if (JSON.stringify(newVal) !== JSON.stringify(this.teamManager.selectedTeam)) {
          this.teamManager.selectedTeam = newVal;
        }
      },

      submitForm() {
        this.submitted = true;

        axios
          .post("/api/amteam-create", this.teamManager)
          .then((response) => {
            console.log("Form submitted:", response.data.message);
            if (response.data.message) {
              this.errors = {};
              Swal.fire({
                position: "top-center",
                icon: "success",
                title: "Team created successfully",
                showConfirmButton: false,
                timer: 3000,
              });
            } else {
              Swal.fire("Form not Submitted");
            }
          })
          .catch((error) => {
            if (error.response) {
              console.error("Error submitting form:", error.response.data.errors);
              this.errors = error.response.data.errors;
            }
          });
      },
    },
    mounted() {
      this.userLocationApi();
    },
  };
  </script>
