<template>
  <div class="inbox" v-if="!selectedEmail">
    <table class="email-table">
      <thead>
        <tr>
          <th>From</th>
          <th>Subject</th>
          <th>Time</th>
        </tr>
      </thead>
      <tbody>
        <tr v-for="email in emails" :key="email.id" @click="selectEmail(email)">
          <td>{{ email.from }}</td>
          <td>{{ email.subject }}</td>
          <td>{{ email.time }}</td>
        </tr>
      </tbody>
    </table>
  </div>
  <div v-else>
    <EmailDetail :email="selectedEmail" @back="selectedEmail = null" />
  </div>
</template>

<script>
import EmailDetail from "./EmailDetail.vue";

export default {
  props: ["emails"],
  data() {
    return {
      selectedEmail: null,
    };
  },
  methods: {
    selectEmail(email) {
      this.selectedEmail = email;
    },
  },
  components: {
    EmailDetail,
  },
};
</script>

<style scoped>
.inbox {
  width: 100%;
  max-width: 800px;
  margin: 0 auto;
  background-color: #fff;
  border-radius: 8px;
  box-shadow: 0 2px 4px rgba(0, 0, 0, 0.1);
  overflow: hidden;
}

.email-table {
  width: 100%;
  border-collapse: collapse;
}

.email-table th,
.email-table td {
  padding: 12px;
  border: 1px solid #ddd;
}

.email-table th {
  background-color: #f1f3f4;
}

.email-table tr:hover {
  background-color: #f1f3f4;
}

.email-table tr {
  cursor: pointer;
}
</style>
