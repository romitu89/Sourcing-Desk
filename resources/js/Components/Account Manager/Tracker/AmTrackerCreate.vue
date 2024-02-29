<template>
  <form @submit.prevent="submitForm">
    <table class="input_form">
      <tr>
        <td><label>Client Name</label></td>
        <td>
          <select id="client" v-model="tracker.selectedClient" name="client">
            <option value="">Select Client</option>
            <!-- <span v-if="errors.selectedClient" class="error">{{errors.selectedClient[0]}}</span> -->
            <option
              v-for="item in clientData"
              :key="item.client_name"
              :value="item.client_name"
            >
              {{ item.client_name }}
            </option>
          </select>
        </td>
      </tr>

      <tr>
        <td><label>Client Manager Name</label></td>
        <td>
          <input
            type="text"
            v-model="tracker.clientManagerName"
            placeholder="Client Manager Name"
          />
          <!-- <span v-if="errors.clientManagerName" class="error">{{errors.clientManagerName[0]}}</span> -->
        </td>
      </tr>

      <tr>
        <td><label>Buisness Unit</label></td>
        <td>
          <select id="buisness" v-model="tracker.selectedBusiness" name="buisness">
            <option value="">Select Unit</option>
            <span v-if="errors.selectedBusiness" class="error">{{errors.selectedBusiness[0]}}</span>

            <option
              v-for="item in clientData"
              :key="item.client_name"
              :value="item.business_unit_name"
            >
              {{ item.business_unit_name }}
            </option>
          </select>
        </td>
      </tr>

      <tr>
        <td><label>Select Location</label></td>
        <td>
          <select id="location" v-model="tracker.selectedLocation" name="location">
            <option value="">Select Location</option>
            <span v-if="errors.selectedLocation" class="error">{{errors.selectedLocation[0]}}</span>

            <option
              v-for="item in clientData"
              :key="item.location"
              :value="item.location"
            >
              {{ item.location }}
            </option>
          </select>
        </td>
      </tr>

      <tr>
        <td><label>Upload File</label></td>
        <td>
          <input
            type="file"
            @change="handleFileChange"
            accept=".xls, .xlsx"
            name="file"
            placeholder="Upload"
          />
          <!-- <span v-if="errors.file" class="error">{{errors.file[0]}}</span> -->
        </td>
      </tr>

      <tr>
        <td></td>
        <td>
          <button class="cancel_btn">Cancel</button>
          <button class="submit_btn">Submit</button>
        </td>
      </tr>
    </table>
  </form>
</template>

<script>
import Swal from "sweetalert2";

export default {
  name: "AmTrackerCreate",
  data() {
    return {
      tracker: {
        selectedClient: "",
        clientManagerName: "",
        selectedBusiness: "",
        selectedLocation: "",
        file: null,
      },
      submitted: false,
      clientData: [],
      errors: {},
    };
  },

  methods: {
    userLocationApi() {
      axios
        .get("/api/amtracker-create")
        .then((response) => {
          console.log(response.data, "data");
          // console.log(response.data.location, "location")

          this.clientData = response.data.client;
          console.log(this.clientData, "client");
        })
        .catch((error) => {
          console.log(error);
          this.errored = true;
        });
    },

    submitForm() {
      this.submitted = true; // Set the submitted flag to true when attempting to submit the form
      // if (this.isFormValid) {

      axios
        .post("/api/amtracker-create", this.tracker)
        .then((response) => {
          console.log("Form submitted:", response.data.message);
          if (response.data.message) {
            this.errors = {};

            Swal.fire({
              position: "top-center",
              icon: "success",
              title: "User created successfully",
              showConfirmButton: false,
              timer: 5000,
            });
          } else {
            Swal.fire("Form not Submitted");
          }

          // Handle the response as needed
        })
        .catch((error) => {
            console.error('Error submitting form:', error.response.data.errors);
          this.errors = error.response.data.errors;
          console.log(this.errors, "Tracker error")
        });

      // You might want to reset the form and submitted flag here if needed
    },
  },

  mounted() {
    this.userLocationApi();
  },
};
</script>
