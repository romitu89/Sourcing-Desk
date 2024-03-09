<template>
  <form @submit.prevent="submitForm">
    <table class="input_form">
      <tr>
        <td><label>Select Location</label></td>
        <td>
          <select id="location" v-model="employee.selectedLocation" name="location">
            <option value="">Select Location</option>
            <option
              v-for="item in userLocation"
              :key="item.location"
              :value="item.location"
            >
              {{ item.location }}
            </option></select
          ><br><span v-if="errors.selectedLocation" class="error">{{
            errors.selectedLocation[0]
          }}</span>
        </td>
      </tr>

      <tr>
        <td><label>Select User</label></td>
        <td>
          <select id="user" v-model="employee.user" name="user">
            <option value="">Select User</option>
            <option value="current">Current User</option>
            <option value="removed">Removed User</option></select
          ><br><span v-if="errors.user" class="error">{{ errors.user[0] }}</span>
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

  <div v-if="results">
    <responsive-table :results="results" :columns="columns">
      <!-- <template #edit="{ row }">
                        <Link

                          >Edit</Link
                        >
                      </template> -->
    </responsive-table>
  </div>
</template>

<script>
import ResponsiveTable from "../../Shared Folder/ResponsiveTable.vue";

export default {
  name: "EditorUserViewForm",
  components: {
    ResponsiveTable,
  },
  data() {
    return {
      employee: {
        selectedLocation: "",
        user: "",
      },
      // formData:{},
      userLocation: [],
      errors: [],
      results: [],

      columns: [
        { label: "Date&Time", key: "created_at" },
        { label: "Employee Name", key: "employee_name" },
        { label: "UserName", key: "username" },
        { label: "Employee Id", key: "employee_id" },
        { label: "Mobile Number", key: "mobile_number" },
        { label: "Email Id", key: "email_id" },
        { label: "Location", key: "location" },
        { label: "Role", key: "role" },
        { label: "Department", key: "department" },
        { label: "Reporting To", key: "reporting_to" },
        { label: "DOB", key: " dob" },
        { label: "Edit", key: "edit" },

        // ... etc. for other columns
      ],
    };
  },

  methods: {
    userLocationApi() {
      axios
        .get("/api/editoruser-view")
        .then((response) => {
          this.userLocation = response.data.locations;
          console.log(this.userLocation);
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
        .post("/api/editoruser-view", this.employee)
        .then((response) => {
          console.log("Form submitted:", response.data.results);
          this.results = response.data.results;
        //   this.errors = error.response.data.errors;

          this.errors = {};

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
