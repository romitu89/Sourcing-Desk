<template>
    <form @submit.prevent="submitForm">
      <table class="input_form">
        <tr>
          <td><label>Select Location</label></td>
          <td>
            <select
              id="location"
              v-model.trim="client.selectedLocation"
              @change="filterData('location')"
              name="location"
            >
              <option value="">Select Location</option>
              <option v-for="item in uniqueLocations" :key="item" :value="item">
                {{ item }}
              </option>
            </select>
            <br />
            <span v-if="errors.selectedLocation" class="error">{{ errors.selectedLocation[0] }}</span>
          </td>
        </tr>

        <tr v-if="client.selectedLocation">
          <td><label>Client Name</label></td>
          <td>
            <select
              id="client"
              v-model.trim="client.clientName"
              @change="filterData('client')"
              name="client"
            >
              <option value="">Select Client</option>
              <option v-for="item in uniqueClients" :key="item" :value="item">
                {{ item }}
              </option>
            </select>
            <br />
            <span v-if="errors.clientName" class="error">{{ errors.clientName[0] }}</span>
          </td>
        </tr>

        <tr v-if="client.clientName">
          <td><label>Business Unit</label></td>
          <td>
            <select
              id="business"
              v-model.trim="client.businessName"
              @change="filterData('business')"
              name="business"
            >
              <option value="">Select B-Unit</option>
              <option v-for="item in uniqueBusinessUnits" :key="item" :value="item">
                {{ item }}
              </option>
            </select>
            <br />
            <span v-if="errors.businessName" class="error">{{ errors.businessName[0] }}</span>
          </td>
        </tr>

        <tr v-if="client.businessName">
          <td><label>Client Manager Name</label></td>
          <td>
            <select
              id="manager"
              v-model.trim="client.clientManager"
              @change="filterData('manager')"
              name="manager"
            >
              <option value="">Select Manager</option>
              <option v-for="item in uniqueClientManagers" :key="item" :value="item">
                {{ item }}
              </option>
            </select>
            <br />
            <span v-if="errors.clientManager" class="error">{{ errors.clientManager[0] }}</span>
          </td>
        </tr>

        <tr v-if="client.clientManager">
          <td><label>Select Matrix</label></td>
          <td>
            <select id="matrix" v-model="client.matrix" name="matrix">
              <option value="">Select Matrix</option>
              <option value="requirements">Requirements</option>
              <option value="submission">Submission</option>
              <option value="Selection">Selection</option>
              <option value="Rejections">Rejections</option>
              <option value="Onboarded">Onboarded</option>
              <option value="Dropouts">Dropouts</option>
              <option value="Offboarded">Offboarded</option>
            </select>
            <br />
            <span v-if="errors.matrix" class="error">{{ errors.matrix[0] }}</span>
          </td>
        </tr>

        <tr v-if="client.matrix">
          <td><label>From Date</label></td>
          <td>
            <input
              v-model.trim="client.fromDate"
              @blur="checkValidation('fromDate')"
              type="date"
            />
            <span v-if="errors.fromDate" class="error">{{ errors.fromDate[0] }}</span>
          </td>
        </tr>

        <tr v-if="client.fromDate">
          <td><label>To Date</label></td>
          <td>
            <input
              v-model.trim="client.toDate"
              @blur="checkValidation('toDate')"
              type="date"
            />
            <span v-if="errors.toDate" class="error">{{ errors.toDate[0] }}</span>
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
  import { commonFunctionsMixin } from "../../../function.js";
  import Swal from "sweetalert2";
  import axios from "axios";

  export default {
    name: "ClientManagerReportForm",
    mixins: [commonFunctionsMixin],
    data() {
      return {
        client: {
          clientName: "",
          businessName: "",
          selectedLocation: "",
          clientManager: "",
          matrix: "",
          fromDate: "",
          toDate: "",
        },
        submitted: false,
        clientData: [],
        filteredData: [],
        filteredClients: [],
        filteredBusinessUnits: [],
        filteredClientManagers: [],
        errors: {},
      };
    },

    computed: {
      uniqueLocations() {
        return [...new Set(this.clientData.map((item) => item.location))];
      },
      uniqueClients() {
        return [...new Set(this.filteredData.map((item) => item.client_name))];
      },
      uniqueBusinessUnits() {
        return [
          ...new Set(this.filteredClients.map((item) => item.business_unit_name)),
        ];
      },
      uniqueClientManagers() {
        return [
          ...new Set(
            this.filteredBusinessUnits.map((item) => item.client_manager_name)
          ),
        ];
      },
    },

    methods: {
      closePopup() {
        this.$emit("closePopup");
      },

      userLocationApi() {
        axios
          .get("/api/adminclient-managerreport")
          .then((response) => {
            this.clientData = response.data.clients;
            console.log(this.clientData, "clientData");
          })
          .catch((error) => {
            console.log(error);
            this.errored = true;
          });
      },

      filterData(field) {
        switch (field) {
          case "location":
            this.filteredData = this.clientData.filter(
              (item) => item.location === this.client.selectedLocation
            );
            this.resetFields(["clientName", "businessName", "clientManager", "matrix", "fromDate", "toDate"]);
            break;
          case "client":
            this.filteredClients = this.filteredData.filter(
              (item) => item.client_name === this.client.clientName
            );
            this.resetFields(["businessName", "clientManager", "matrix", "fromDate", "toDate"]);
            break;
          case "business":
            this.filteredBusinessUnits = this.filteredClients.filter(
              (item) => item.business_unit_name === this.client.businessName
            );
            this.resetFields(["clientManager", "matrix", "fromDate", "toDate"]);
            break;
          case "manager":
            this.filteredClientManagers = this.filteredBusinessUnits.filter(
              (item) => item.client_manager_name === this.client.clientManager
            );
            this.resetFields(["matrix", "fromDate", "toDate"]);
            break;
        }
      },

      resetFields(fields) {
        fields.forEach(field => {
          this.client[field] = "";
        });
        this.errors = {};
      },

      submitForm() {
        this.submitted = true;

        axios
          .post("/api/adminclient-managerreport", this.client)
          .then((response) => {
            this.errors = {};

            console.log("Form submitted:", response.data.results);
            if (Object.values(this.errors).length == 0) {
              this.buttonAction = true;
            }
            this.results = response.data.results;

            Swal.fire({
              position: "top-center",
              icon: "success",
              title: "Form submitted successfully",
              showConfirmButton: false,
              timer: 3000,
            });

            // Handle the response as needed
          })
          .catch((error) => {
            console.error("Error submitting form:", error.response.data.errors);
            this.errors = error.response.data.errors;
          });
      },
    },
    mounted() {
      this.userLocationApi();
    },
  };
  </script>
