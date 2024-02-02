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

