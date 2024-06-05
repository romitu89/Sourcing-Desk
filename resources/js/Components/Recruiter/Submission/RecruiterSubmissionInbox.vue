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
        {
          id: 1,
          from: "kapil@test.com",
          subject: "Profiles for CCNA",
          time: "6:37 AM",
          body: "Here are the profiles you requested...",
          attachments: [
            { id: 1, name: "Profile1.pdf" },
            { id: 2, name: "Profile2.pdf" },
          ],
        },
        {
          id: 1,
          from: "kapil@test.com",
          subject: "Profiles for CCNA",
          time: "6:37 AM",
          body: "Here are the profiles you requested...",
          attachments: [
            { id: 1, name: "Profile1.pdf" },
            { id: 2, name: "Profile2.pdf" },
          ],
        },
        {
          id: 1,
          from: "kapil@test.com",
          subject: "Profiles for CCNA",
          time: "6:37 AM",
          body: "Here are the profiles you requested...",
          attachments: [
            { id: 1, name: "Profile1.pdf" },
            { id: 2, name: "Profile2.pdf" },
          ],
        },
        // Add more emails as needed
      ],
    };
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
