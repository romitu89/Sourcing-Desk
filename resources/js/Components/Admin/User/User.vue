<template>
  <div class="container">
    <div class="form" @click="createPopUp()">
      <div class="icon_div"><font-awesome-icon :icon="['fas', 'chart-gantt']" /></div>
      <a><h4>Create</h4></a>
    </div>
    <div class="form" @click="viewPopUp()">
      <div class="icon_div"><font-awesome-icon :icon="['fas', 'chart-gantt']" /></div>
      <a> <h4>View</h4> </a>
    </div>
    <div class="form" @click="loginPopUp()">
      <div class="icon_div"><font-awesome-icon :icon="['fas', 'chart-gantt']" /></div>
      <h4>Login</h4>
    </div>
    <div class="form">
      <div class="icon_div"><font-awesome-icon :icon="['fas', 'chart-gantt']" /></div>
      <h4>Idle Time</h4>
    </div>
  </div>
  <UserCreate
    :showPopUp="popup"
    @closePopup="closePopUp"
    @updateForm="updateForm"
    @editSuccess="editSuccess"
    :title="title"
    :editId="editId"
    :empName="empName"
    v-if="popup"
  >
  </UserCreate>
</template>

<script>
import UserCreate from "./UserCreate.vue";

export default {
  name: "User",
  components: {
    UserCreate,
  },
  data() {
    return {
      popup: false,
      title: "",
      editId: null,
      empName:"",
    };
  },
  methods: {
    createPopUp() {
      this.popup = true;
      this.title = "Create Form";
    },
    closePopUp(data) {
      this.popup = data;
    },
    viewPopUp() {
      this.popup = true;
      this.title = "View Form";
    },

    loginPopUp() {
      this.popup = true;
      this.title = "Login Form";
    },
    updateForm(id) {
      this.title = "Edit Form";
      this.popup = true;
      this.editId = id;
    },
    editSuccess(name){
        this.popup = true;
      this.title = "View Form";
      this.empName=name;
    },
  },
};
</script>

<style scoped>
.container {
  margin: 2% 5%;
  display: flex;
  flex-wrap: wrap;
  gap: 2%;
}
.form {
  width: 250px;
  background-color: #002147;
  opacity: 0.9;
  border-radius: 10px;
  padding: 10px 20px;
  margin: 1%;
  cursor: pointer;
  /* box-shadow: 0 0 6px 7px whitesmoke; */
}

.form h4 {
  color: rgb(213, 242, 253);
  font-size: 25px;
  text-align: center;
}

.icon_div {
  color: lightblue;
  text-align: center;
  font-size: 30px;
}
</style>
