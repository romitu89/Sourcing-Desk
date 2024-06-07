<template>
  <div id="app">
    <div class="container">
      <Inbox :emails="emails" />
    </div>
  </div>
</template>

<script>
import Inbox from "./Inbox.vue";

export default {
  name: "App",
  components: {
    Inbox,
  },
  data() {
    return {
      emails: [


      ],
    };
  },
  methods:{

closePopup() {
this.$emit("closePopup");
},

userLocationApi()
{
axios
.get('/api/recruiter-submission')
.then(response => {
this.emails = response.data.userEmail


})
.catch(error => {
console.log(error)
this.errored = true
})

},

},
mounted() {
    this.userLocationApi();
  },
};
</script>

<style scoped>
body {
  font-family: Arial, sans-serif;
  background-color: #f5f5f5;
  margin: 0;
  padding: 0;
}

#app {
  text-align: center;
  padding: 20px;
}

.container {
  display: flex;
  flex-direction: column;
  align-items: center;
}
</style>
