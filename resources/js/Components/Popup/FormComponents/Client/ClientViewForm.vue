<template>
<form @submit.prevent="submitForm">
    <table class="input_form">

        <tr>
    <td ><label >Select Location</label></td>
    <td ><select id="location" v-model.trim="client.location" class="color_cell" name="location">
    <option value="">Choose Location</option>
    <option value="India">India</option>
    <option value="usa">USA</option>
    </select>
    <span v-if="submitted && !validation.location" class="error">Location is required.</span></td>
    </tr>

    <tr>
    <td ><label >Sub Location</label></td>
    <td ><input type="text" v-model.trim="client.subLocation" placeholder="Sub Location">

        <span v-if="submitted && !validation.subLocation" class="error">Sub Location is required.</span></td>
    </tr>

    <tr>
        <td></td>
       <td>
        <button  class="submit_btn">Submit</button> </td>
    </tr>
</table>
</form>
</template>

<script>
import Swal from 'sweetalert2'

export default {
    name:'ClientViewForm',

    data()
        {
            return{
                client: {

                    subLocation:"",
                    location:"",

                },
                submitted:false,
            };
        },

    computed:{
            validation(){
                return {

            subLocation: this.client.subLocation.trim() !== '',
            location: this.client.location.trim() !== '',


            };
            },

            isFormValid() {

                return Object.values(this.validation).every(value => value);
            },

            },

            methods:{
            submitForm() {
                this.submitted = true; // Set the submitted flag to true when attempting to submit the form
                if (this.isFormValid) {
                Swal.fire({
                        position: "top-center",
                        icon: "success",
                        title: "Your form has been submitted",
                        showConfirmButton: false,
                        timer: 5000
                        });
// You might want to reset the form and submitted flag here if needed
                        }
                else {
                        Swal.fire("Form not Submitted");
                        }
                },
            },

}

</script>

