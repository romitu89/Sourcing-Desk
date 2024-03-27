<template>
  <form @submit.prevent="submitForm">
    <table class="input_form">
      <tr>
        <td><label>Select Location</label></td>
        <td>
          <select
            id="location"
            v-model="employee.selectedLocation"
            @blur="checkValidation('selectedLocation')"
            name="location"
          >
            <option value="">Select Location</option>
            <option
              v-for="item in userLocation"
              :key="item.location"
              :value="item.location"
            >
              {{ item.location }}
            </option></select
          ><br /><span v-if="errors.selectedLocation" class="error">{{
            errors.selectedLocation[0]
          }}</span>
        </td>
      </tr>

      <tr>
        <td><label>Select User</label></td>
        <td>
          <select
            id="user"
            v-model="employee.user"
            @blur="checkValidation('user')"
            name="user"
          >
            <option value="">Select User</option>
            <option value="current">Current User</option>
            <option value="removed">Removed User</option></select
          ><br /><span v-if="errors.user" class="error">{{ errors.user[0] }}</span>
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

  <div v-if="results">
    <responsive-table :results="results" :columns="columns" :buttonAction="buttonAction">
      <template #edit="{ row }">
        <div>
          <button title="Edit" @click="editItem(row.id)">
            <font-awesome-icon :icon="['fas', 'pen-to-square']" />
          </button>
          <button title="Delete" @click="deleteItem(row.id)">
            <font-awesome-icon :icon="['fas', 'trash']" />
          </button>
        </div>
      </template>
    </responsive-table>
  </div>
</template>

<script>
import ResponsiveTable from "../../Shared Folder/ResponsiveTable.vue";
import Swal from "sweetalert2";

export default {
  name: "UserViewForm",

  components: {
    ResponsiveTable,
  },
  data() {
    return {
      buttonAction: false,
      employee: {
        selectedLocation: "",
        user: "",
      },
      // formData:{},
      userLocation: [],
      errors: [],
      results: [],
      columns: [
        { label: "Date-Time", key: "created_at" },
        { label: "Employee Name", key: "employee_name" },
        { label: "UserName", key: "username" },
        { label: "Employee Id", key: "employee_id" },
        { label: "Mobile Number", key: "mobile_number" },
        { label: "Email Id", key: "email_id" },
        { label: "Location", key: "location" },
        { label: "Role", key: "role" },
        { label: "Department", key: "department" },
        { label: "Reporting Manager", key: "reporting_to_am" },
        { label: "Reporting Team Lead", key: "reporting_to_tl" },
        { label: "DOB", key: "dob" },
        { label: "Edit", key: "edit" },

        // ... etc. for other columns
      ],
    };
  },

  props:{
    empName:{
      type: String,
      default: "",
    },
  },

  methods: {
    closePopup() {
      this.$emit("closePopup");
    },
    checkValidation(fieldName) {
      let dataError = Object.values(this.errors);
      if (dataError.length > 1) {
        this.submitForm();
      } else {
        if (this.errors.hasOwnProperty(fieldName)) {
          delete this.errors[fieldName];
        }
      }
    },
    editItem(id) {
      this.$emit("updateForm", id);
    },
    deleteItem(id){
      axios
        .delete("/api/adminuser-delete/" +id)
        .then((response) => {
          if (response.data.message) {
              Swal.fire({
              position: "top-center",
              icon: "success",
              title: "User deleted successfully",
              showConfirmButton: false,
              timer: 3000,
            });
            this.submitForm()
          }
        })
        .catch((error) => {
          console.log(error);
          this.errored = true;
        });
    },
    userLocationApi() {
      axios
        .get("/api/adminuser-view")
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
      this.submitted = true;

      axios
        .post("/api/adminuser-view", this.employee)
        .then((response) => {
          this.errors = {};
          if (Object.values(this.errors).length == 0) {
            this.buttonAction = true;
          }
          this.results = response.data.results;

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

    if(this.empName!=""){
      Swal.fire({
              position: "top-center",
              icon: "success",
              title: "User "+this.empName+" edited successfully",
              showConfirmButton: false,
              timer: 3000,
            });
            this.$emit("editMessageUpdated")
    }
    
    
  },
};
</script>
