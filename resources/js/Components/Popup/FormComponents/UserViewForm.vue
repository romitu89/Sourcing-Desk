<template>

<form @submit.prevent="userViewApi()">
    <table class="input_form">

    <tr>
    <td ><label >Select Location</label></td>
    <td ><select id="Location" v-model="selectedLocation" name="Location">
    <option value="">Select Location</option>
    <option v-for="item in userLocation" :key='item.location' :value="item.location">{{ item.location }}</option>
    
    </select></td>
    </tr>

    <tr>
    <td ><label >Select User</label></td>
    <td ><select id="User" v-model="selectedUser" name="User">
    <option value="">Select User</option>
    <option value="current">Current User</option>
    <option value="removed">Removed User</option>
    </select></td>
    </tr>

    <tr>
        <td></td>
       <td> <button class="cancel_btn">Cancel</button>
        <button @click="userViewApi()" class="submit_btn">Submit</button> </td>
    </tr>

</table>
</form>

</template>

<script>
export default {
    name: 'UserViewForm',
    data()
    {
        return{
            userLocation:[],
            selectedLocation:"",
            selectedUser:"",
            formData:{},
        };
    },

    methods:{
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
        userViewApi(){
            console.log(this.selectedLocation, this.selectedUser)
            const formData = {
                selectedLocation: this.selectedLocation,
                user: this.selectedUser,
               // include other data as needed
           };
 
          axios.post('/api/adminuser-view', formData)
              .then(response => {
                  console.log('Form submitted:', response.data.results);
                  // Handle the response as needed
               })
              .catch(error => {
                  console.error('Error submitting form:', error);
               });
        }
    },
mounted(){
    this.userLocationApi()
    
}


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