<template>

<form @submit.prevent="submitForm">
    <table class="input_form">

    <tr>
    <td ><label >Select Location</label></td>
    <td ><select id="location" v-model="employee.selectedLocation" name="location">
    <option value="">Select Location</option>
    <option v-for="item in userLocation" :key='item.location' :value="item.location">{{ item.location }}</option>

    </select><span v-if="submitted && !validation.location" class="error">Mobile Number is required.</span></td>
    </tr>

    <tr>
    <td ><label >Employee Email</label></td>
    <td ><select id="email" v-model="employee.email" name="email">
    <option value="">Select Email</option>
    <option value="India">India</option>
    <option value="usa">USA</option>
    </select><span v-if="submitted && !validation.email" class="error">Employee email is required.</span></td>
    </tr>

    <tr>
    <td ><label >From Date</label></td>
    <td ><input type="date" v-model="employee.fromDate" >
        <span v-if="submitted && !validation.fromDate" class="error"> From Date is required.</span></td>
    </tr>

    <tr>
    <td ><label >To Date</label></td>
    <td ><input type="date" v-model="employee.toDate" >
        <span v-if="submitted && !validation.toDate" class="error"> To Date is required.</span></td>
    </tr>

    <tr>
        <td></td>
       <td> <button class="submit_btn">Submit</button> </td>
    </tr>

</table>
</form>

</template>

<script>
import Swal from 'sweetalert2'


    export default {
        name: 'UserLoginForm',

        data()
        {
            return{
                employee:{
                    selectedLocation:"",
                    email:"",
                    fromDate:"",
                    toDate:"",
                },
                submitted:false,
                userLocation:[],
            };
        },

        computed:{
            validation(){
                return {
            location: this.employee.selectedLocation.trim() !== '',
            email:this.employee.email.trim() !== '',
            fromDate: this.employee.fromDate.trim() !== '',
            toDate: this.employee.toDate.trim() !== '',
            };
            },
            isFormValid() {
        return Object.values(this.validation).every(value => value);
            },
        },

        methods: {

            userLocationApi()
        {
            axios
      .get('/api/adminuser-view')
      .then(response => {
        this.userLocation = response.data.locations
        console.log(this.userLocation)
      })
      .catch(error => {
        console.log(error)
        this.errored = true
      })

        },



submitForm() {
        this.submitted = true; // Set the submitted flag to true when attempting to submit the form
        if (this.isFormValid) {

           

            // Swal.fire({
            //             position: "top-center",
            //             icon: "success",
            //             title: "Your form has been submitted",
            //             showConfirmButton: false,
            //             timer: 1500
            //             });
        // You might want to reset the form and submitted flag here if needed
        }
        else {
            Swal.fire("Form not Submitted");
        }
    },
        },
        mounted(){
    this.userLocationApi()

}

        }
</script>

