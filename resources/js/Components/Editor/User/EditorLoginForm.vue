<template>

    <form @submit.prevent="submitForm">
        <table class="input_form">
    
        <tr>
        <td ><label >Select Location</label></td>
        <td ><select id="location" v-model="employee.selectedLocation" name="location">
        <option value="">Select Location</option>
        <option v-for="item in loginData" :key='item.location' :value="item.location">{{ item.location }}</option>
    
        </select><br><span v-if="errors.selectedLocation" class="error">{{errors.selectedLocation[0]}}</span></td>
        </tr>
    
        <tr>
        <td ><label >Employee Email</label></td>
        <td ><select id="email" v-model="employee.selectedEmail" name="email">
        <option value="">Select Email</option>
        <option v-for="item in loginData" :key='item.email_id' :value="item.email_id">{{ item.email_id }}</option>
        
        </select><br>
        <span v-if="errors.selectedEmail" class="error">{{errors.selectedEmail[0]}}</span></td>
        </tr>
    
        <tr>
        <td ><label >From Date</label></td>
        <td ><input type="date" v-model="employee.fromDate" >
            <span v-if="errors.fromDate" class="error">{{errors.fromDate[0]}}</span></td>
        </tr>
    
        <tr>
        <td ><label >To Date</label></td>
        <td ><input type="date" v-model="employee.toDate" >
            <span v-if="errors.toDate" class="error">{{errors.toDate[0]}}</span></td>
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
                        selectedEmail:"",
                        fromDate:"",
                        toDate:"",
                    },
                    loginData:[],
                    userLocation:[],
                    errors:{},
                };
            },
    
    
            methods: {
    
                userLocationApi()
            {
                axios
          .get('/api/editoruser-login')
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
    
                        axios.post('/api/editoruser-login', this.employee)
                  .then(response => {
                      console.log('Form submitted:', response.data.results);
                      if(response.data.results){
                        this.errors={};
    
                         Swal.fire({
                            position: "top-center",
                            icon: "success",
                            title: "Login successfully",
                            showConfirmButton: false,
                            timer: 5000
                            });
    
                      }
                      else{
                        Swal.fire("Form not Submitted");
                      }
    
                      // Handle the response as needed
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
    
    