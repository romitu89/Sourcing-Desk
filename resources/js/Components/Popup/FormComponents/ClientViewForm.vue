<template>
<form >
    <table class="input_form">

    <tr>
    <td ><label >Select Location</label></td>
    <td ><select id="Location"  class="color_cell"  name="Location">
    <option value="">Choose Location</option>
    <option value="India">India</option>
    <option value="usa">USA</option>
    </select></td>
    </tr>

    <tr>
    <td ><label >Sub Location</label></td>
    <td ><select id="Location"  class="color_cell"  name="Location">
    <option value="">Choose Sub Location</option>
    <option value="India">India</option>
    <option value="usa">USA</option>
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
    name:'ClientViewForm',
    
}

</script>