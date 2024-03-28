<template>

<form @submit.prevent="submitForm">
    <table class="input_form">

    <tr>
    <td ><label >Select Location</label></td>
    <td ><select id="location" v-model="employee.selectedLocation" @blur="checkValidation('selectedLocation')" name="location">
    <option value="">Select Location</option>
    <option v-for="item in getUniqueValues(loginData,'location')" :key='item' :value="item">{{ item }}</option>

    </select><br><span v-if="errors.selectedLocation" class="error">{{errors.selectedLocation[0]}}</span></td>
    </tr>

    <tr>
    <td ><label >Employee Email</label></td>
    <td ><select id="email" v-model="employee.selectedEmail" @blur="checkValidation('selectedEmail')" name="email">
    <option value="">Select Email</option>
    <option v-for="item in getUniqueValues(loginData,'email_id')" :key='item' :value="item">{{ item }}</option>

    </select><br>
    <span v-if="errors.selectedEmail" class="error">{{errors.selectedEmail[0]}}</span></td>
    </tr>

    <tr>
    <td ><label >From Date</label></td>
    <td ><input type="date" v-model="employee.fromDate" @blur="checkValidation('fromDate')">
        <span v-if="errors.fromDate" class="error">{{errors.fromDate[0]}}</span></td>
    </tr>

    <tr>
    <td ><label >To Date</label></td>
    <td ><input type="date" v-model="employee.toDate"  @blur="checkValidation('toDate')" >
        <span v-if="errors.toDate" class="error">{{errors.toDate[0]}}</span></td>
    </tr>

    <tr>
        <td></td>
       <td> <button @click="closePopup()" class="cancel_btn">Cancel</button>
        <button class="submit_btn">Submit</button> </td>
    </tr>

</table>
</form>

<div v-if="results">
                    <responsive-table :results="results" :columns="columns" :buttonAction="buttonAction">


                      <!-- <template #edit="{ row }">
                        <Link

                          >Edit</Link
                        >
                      </template> -->
                    </responsive-table>
                  </div>


</template>

<script>
import Swal from 'sweetalert2'
import { commonFunctionsMixin } from '../../../function.js';
import ResponsiveTable from '../../Shared Folder/ResponsiveTable.vue'


    export default {
        name: 'UserLoginForm',

        mixins:[commonFunctionsMixin],

    components:{
      ResponsiveTable,
        },

        data()
        {
            return{
                employee:{
                    selectedLocation:"",
                    selectedEmail:"",
                    fromDate:"",
                    toDate:"",
                },
                buttonAction: false,
                loginData:[],

                userLocation:[],
                errors:{},
                results:[],
                columns: [
                    { label: 'Email ID', key: 'email_id' },
                    { label: 'Location', key: 'location' },
                    { label: 'Created At', key: 'created_at' },
                    { label: 'Logout', key: 'logout_time' },
              ],
            };
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

            userLocationApi()
        {
            axios
      .get('/api/adminuser-login')
      .then(response => {
        this.loginData = response.data.login

        console.log(this.loginData)
      })
      .catch(error => {
        console.log(error)
        this.errored = true
      })

        },


        submitForm() {
                this.submitted = true; // Set the submitted flag to true when attempting to submit the form
                // if (this.isFormValid) {

                    axios.post('/api/adminuser-login', this.employee)
              .then(response => {
                  console.log('Form submitted:', response.data.results);

                  this.results = response.data.results;
                  this.errors={};

                    if (Object.values(this.errors).length == 0) {
            this.buttonAction = true;
              }

               })
              .catch(error => {
                //   console.error('Error submitting form:', error.response.data.errors);
                  this.errors= error.response.data.errors;
               });
    },
        },
        mounted(){
    this.userLocationApi()

}

        }
</script>

