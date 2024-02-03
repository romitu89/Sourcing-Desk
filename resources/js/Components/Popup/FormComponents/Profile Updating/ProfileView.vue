<template>
    <form >
    <table class="input_form">

    <tr>
    <td ><label >Select Country</label></td>
    <td ><select id="Location"  class="color_cell"  name="Choose Location">
    <option value="">Choose Country</option>
    <option value="India">India</option>
    <option value="usa">USA</option>
    </select></td>
    </tr>

    <tr>
    <td ><label >Select Duration</label></td>
    <td ><select id="Location" name="Choose Location">
    <option value="">Choose Duration</option>
    <option value="6">6 Months</option>
    <option value="1 year">1 Years</option>
    <option value="3 year">3 Years</option>
    <option value="5 years">5 Years</option>
    <option value="5 years">5 Years</option>
    <option value="more">More</option>
    </select></td>
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
    export default {
        name:'ProfileView',

    }
</script>
