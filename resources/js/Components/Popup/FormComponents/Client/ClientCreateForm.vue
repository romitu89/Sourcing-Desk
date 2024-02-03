<template>

<form @submit.prevent="submitForm">
    <table class="input_form">

    <tr>
    <td ><label >Client Name</label></td>
    <td ><input type="text"  v-model.trim="client.name" placeholder="Client Name">
        <span v-if="submitted && !validation.name" class="error">Client Name is required.</span></td>
    </tr>

    <tr>
    <td ><label >Business Unit Name</label></td>
    <td ><input type="text" v-model.trim="client.business" placeholder="Business Unit Name">
        <span v-if="submitted && !validation.name" class="error">Business Unit is required.</span></td>
    </tr>

    <tr>
    <td ><label >Sub Location</label></td>
    <td ><input type="text" v-model.trim="client.subLocation" placeholder="Sub Location">

        <span v-if="submitted && !validation.name" class="error">Sub Location is required.</span></td>
    </tr>

    <tr>
    <td ><label >Select Location</label></td>
    <td ><select id="location" v-model.trim="client.location" class="color_cell" name="location">
    <option value="">Choose Location</option>
    <option value="India">India</option>
    <option value="usa">USA</option>
    </select>
    <span v-if="submitted && !validation.name" class="error">Location is required.</span></td>
    </tr>

    <tr>
    <td ><label >Account Manager</label></td>
    <td ><select id="manager" v-model.trim="client.manager" class="color_cell" name="manager">
    <option value="">Choose Manager</option>
    <option value="India">India</option>
    <option value="usa">USA</option>
    </select><span v-if="submitted && !validation.name" class="error">Account Manager is required.</span></td>
    </tr>

    <tr>
        <td></td>
       <td> <button class="cancel_btn">Cancel</button><button class="submit_btn">Submit</button> </td>
    </tr>

</table>
</form>


</template>

<script>
import Swal from 'sweetalert2'


export default {
    name: 'ClientCreateForm',

    data()
        {
            return{
                client: {
                    name:"",
                    business:"",
                    subLocation:"",
                    location:"",
                    manager:"",
                },
                submitted:false,
            };
        },

        computed:{
            validation(){
                return {
            name: this.client.name.trim() !== '',
            business: this.client.business.trim() !== '',
            subLocation: this.client.subLocation.trim() !== '',
            location: this.client.location.trim() !== '',
            manager: this.client.manager.trim() !== '',

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

<style scoped>
.input_form td{

    /* border: 2px solid red; */
    padding: 10px 40px;
    font-size: 20px;
}

.input_form td select{
    padding: 10px 20px;
    width: 400px;
}


.cancel_btn{
    padding: 10px 25px;
    background-color: rgb(252, 64, 64);
    border-radius: 5px;

}
.submit_btn{
    padding: 10px 25px;
    background-color: #227C09;
    border-radius: 5px;
    margin-left: 5px;

}

.cancel_btn:hover{
    box-shadow: 2px 2px 4px 5px darkgray;
}
.submit_btn:hover{
    box-shadow: 2px 2px 4px 5px darkgray;
}

</style>
