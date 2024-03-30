<template>
     <form @submit.prevent="submitForm">
    <table class="input_form">

        <tr>
    <td ><label >Select Location</label></td>
    <td ><select id="location" v-model="client.selectedLocation" @blur="checkValidation('selectedLocation')" name="location">
    <option value="">Select Location</option>
    <option v-for="item in getUniqueValues(clientMis,'location')" :key='item' :value="item">{{ item }}</option>
        </select><br><span v-if="errors.selectedLocation" class="error">{{errors.selectedLocation[0]}}</span></td>
        </tr>

    <tr>
    <td ><label >Client Name</label></td>
    <td ><select id="Client"  v-model.trim="client.clientName" @blur="checkValidation('clientName')" name="Client">
    <option value="">Select Client</option>
    <option v-for="item in getUniqueValues(clientMis,'client_name')" :key='item' :value="item">{{ item }}</option>
        </select><br><span v-if="errors.clientName" class="error">{{errors.clientName[0]}}</span></td>
        </tr>

    <tr>
    <td ><label >Business Unit</label></td>
    <td ><select id="business"  v-model.trim="client.businessName" @blur="checkValidation('businessName')" name="business">
    <option value="">Select B-Unit</option>
    <option v-for="item in getUniqueValues(clientMis,'business_unit_name')" :key='item' :value="item">{{ item }}</option>
        </select><br><span v-if="errors.businessName" class="error">{{errors.businessName[0]}}</span></td>
        </tr>

    <tr>
    <td ><label >Select Matrix</label></td>
    <td ><select id="matrix"  v-model.trim="client.matrix" @blur="checkValidation('matrix')" name="matrix">
    <option value="">Select Matrix</option>
    <option value="requirements">Requirements</option>
    <option value="submission">Submission</option>
    <option value="Selection">Selection</option>
    <option value="Rejections">Rejections</option>
    <option value="Onboarded">Onboarded</option>
    <option value="Dropouts">Dropouts</option>
    <option value="Offboarded">Offboarded</option>
    </select><br>
    <span v-if="errors.matrix" class="error">{{errors.matrix[0]}}</span>
    </td>
    </tr>

    <tr>
        <td></td>
       <td> <button @click="closePopup()" class="cancel_btn">Cancel</button>
        <button class="submit_btn">Submit</button> </td>
    </tr>
</table>
</form>
</template>

<script>
import Swal from 'sweetalert2'
import { commonFunctionsMixin } from '../../../function.js';

export default {

    name:'ClienMatrixForm',

    mixins:[commonFunctionsMixin],

    data()
        {
            return{
                client: {
                    clientName:"",
                    businessName:"",
                    selectedLocation:"",
                    matrix:"",

                },
                submitted:false,
                clientMis:[],
                errors:{},
            };
        },


        methods:{
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
                .get('/api/editorclient-matrix')
                .then(response => {
                this.clientMis = response.data.clients

                console.log(this.clientMis)
            })
                .catch(error => {
                console.log(error)
                this.errored = true
            })

            },

            submitForm() {
                this.submitted = true; // Set the submitted flag to true when attempting to submit the form
                    // if (this.isFormValid) {

            axios
                .post('/api/editorclient-matrix', this.client)
                .then(response => {
                    console.log('Form submitted:', response.data.results);

                this.results = response.data.results;
                  this.errors={};



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
