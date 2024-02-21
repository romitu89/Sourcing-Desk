<template>

<form @submit.prevent="submitForm">
     <table class="input_form">

    <tr>
    <td ><label >Candidate Name</label></td>
    <td ><input type="text"  placeholder="Employee Name" >
       </td>
    </tr>

    <tr>
    <td ><label >Candidate Mobile Number</label></td>
    <td ><input type="text" placeholder="User Name" >
       </td>
    </tr>

    <tr>
    <td ><label >Comments</label></td>
    <td ><input type="text"  placeholder="Password" >
        </td>
    </tr>

</table>

</form>

</template>

<script>
    export default {
        name:'CallingCandidateScreening',

    }
</script>
