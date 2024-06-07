<template>
  <div class="email-detail">
    <button @click="$emit('back')" class="back-button">
      <font-awesome-icon icon="arrow-left" /> Back
    </button>
    <h2>{{ email.subject_line }}</h2>
    <p class="email-from"><strong>From:</strong> {{ email.created_by }}</p>
    <p class="email-body">{{ email.request_body }}</p>
    <div v-if="email.file_upload_jd.length" class="email-attachments">
      <h3>Attachments</h3>
      <ul>
        <li v-for="attachment in email.file_upload_jd" :key="attachment.id">
          {{ attachment.name }}
        </li>
      </ul>
    </div>
  </div>
</template>

<script>
export default {
  props: ["email"],
};
</script>

<style scoped>
.email-detail {
  width: 100%;
  max-width: 800px;
  margin: 20px auto;
  background-color: #fff;
  padding: 20px;
  border-radius: 8px;
  box-shadow: 0 2px 4px rgba(0, 0, 0, 0.1);
}

.back-button {
  background: none;
  border: none;
  color: #1a73e8;
  font-size: 16px;
  cursor: pointer;
  margin-bottom: 20px;
  display: flex;
  align-items: center;
}

.back-button svg {
  margin-right: 8px;
}

.email-detail h2 {
  margin-bottom: 10px;
  color: #202124;
}

.email-from {
  color: #5f6368;
  margin-bottom: 20px;
}

.email-body {
  color: #202124;
  margin-bottom: 20px;
}

.email-attachments {
  margin-top: 20px;
}

.email-attachments h3 {
  margin-bottom: 10px;
  color: #202124;
}

.email-attachments ul {
  list-style-type: none;
  padding: 0;
}

.email-attachments li {
  background-color: #f1f3f4;
  padding: 8px;
  border-radius: 4px;
  margin-bottom: 8px;
}
</style>
