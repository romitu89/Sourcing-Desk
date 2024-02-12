<template>
    <div class="main">
          <div class="logo_div"><h2 class="logo">Sourcing Desk </h2></div>
          <div class="sub">
              <div class="content">
                  <h1>Web Design & <br><span>Development</span><br>Course</h1>
              <p class="par">Never Fight With A Pig, You Will Get Dirty <br> Then Pig Will Love It.</p>
  
              <button class="cn"><a href="#">JOIN US</a></button>
              </div>
  
              <div class="form">
                  <form action=""
               @submit.prevent="subLogin()"
                  >
                  <h2>Login Here</h2>
                  <input type="text" name="username" v-model="email"  placeholder="Enter Username Here">
                  <span v-if="submitted && !validation.email" class="error">Enter Username.</span>
                  <input type="password" name="" v-model="password" placeholder="Enter Password Here">
                  <span v-if="submitted && !validation.password" class="error">Password is required.</span>
                  <button type="submit" class="btnn">Login</button>
              </form>
  
              </div>
          </div>
      </div>
  
  
  </template>
  <script>
import {mapState} from 'vuex';
import axios from 'axios';

  export default {
    name: 'App',
    data() {
        return{
            login: {
            email:"",
            password:"",
            },
            submitted:false,
            loginData:[],
        };
    },

    computed:{
            validation(){

                return {
                    email: this.login.email.trim() !== '',
                    password: this.login.password.trim() !== '',


            };
            },

            isFormValid() {

                return Object.values(this.validation).every(value => value);
            },

            },

    methods:{
        userLocationApi()
{
                axios
      .get('/api/login')
      .then(response => {
        this.loginData = response.data.user
        console.log(this.loginData)
      })
      .catch(error => {
        console.log(error)
        this.errored = true
      })
    }   ,
    
        subLogin(){
            this.submitted = true; 
                if (this.isFormValid) {
                    console.log("login successful")
                    axios.post('/api/login', {
       email: this.email,
       password: this.password
   }).then(response => {
       localStorage.setItem('auth_token', response.data.token);
       localStorage.setItem('user_role', response.data.role);
      this.redirectUserBasedOnRole(response.data.role);
   }).catch(error => {
       console.error("There was an error:", error.response);
   });
                }
              
        },

        redirectUserBasedOnRole(role) {
   switch(role) {
       case 'admin':
          this.$router.push('/admin/create');
           break;
       case 'account-manager':
          this.$router.push('/account-manager/dashboard');
           break;
       case 'teamlead':
          this.$router.push('/teamlead/dashboard');
           break;
       case 'recruiter':
          this.$router.push('/recruiter/dashboard');
           break;
       default:
           console.log('Role does not have a specific dashboard');
   }},

    },

    mounted(){
    this.userLocationApi()

}

  }
   
  </script>
  
  <style scoped>
  *{
      margin: 0;
      padding: 0;
      box-sizing: border-box;
  }
  
  .main{
      width: 100%;
      background: linear-gradient(to top,rgba(0,0,0,0.5)50%,rgba(0,0,0,0.5)50%),url(./image/loginpage.jpg);
      background-position: center;
      background-size: cover;
      height: 100vh;
  }
  .logo_div{
  line-height: 75px;
  }
  
  .sub{
      display: flex;
      margin: 1% 2%;
      gap: 25%;
  
  }
  .logo{
      color: orange;
      font-size: 35px;
      padding-left: 20px;
      padding-top: 10px;
      margin-left: 10%;
  }
  
  
  .content{
  
  
      height: auto;
  
      color: white;
      position: relative;
  }
  .content .par{
      padding-left: 20px;
      padding-bottom: 25px;
      font-family: Arial;
      letter-spacing: 1.2px;
      line-height: 30px;
  }
  
  .content h1{
      font-family: 'Times New Roman';
      font-size: 50px;
      padding-left: 20px;
      margin-top: 9%;
      letter-spacing: 2px;
  }
  
  .content .cn{
      width: 160px;
      height: 40px;
      background: orange;
      border: none;
      margin-bottom: 10px;
      margin-left: 20px;
      font-size: 18px;
      border-radius: 10px;
      cursor: pointer;
  }
  
  .content .cn a{
      text-decoration: none;
      color: #000;
      transition: .3s ease;
  }
  
  .cn:hover{
      background-color: white;
  }
  
  .content span{
      color: orange;
      font-size: 60px;
  }
  .form{
      width: 300px;
  
      background: linear-gradient(to top, rgba(0,0,0,0.8)50%, rgba(0,0,0,0.8)50%);
      position: relative;
      border-radius: 10px;
      padding: 25px;
      box-shadow: 0 0 9px 7px #097C7C;
  
  }
  
  .form h2{
      width: 220px;
      font-family: sans-serif;
      text-align: center;
      color: darkgreen;
      font-size: 22px;
      background-color: white;
      margin: 2px;
      padding: 8px;
  }
  
  .form input{
      width: 240px;
      height: 35px;
      background: transparent;
      border-bottom: 1px solid orange;
      border-top: none;
      border-right: none;
      border-left: none;
      color: white;
      font-size: 15px;
      letter-spacing: 1px;
      margin-top: 50px;
      font-family: sans-serif;
  }
  
  .form input:focus{
      outline: none;
  }
  
  ::placeholder{
      color: white;
      font-family: Arial;
  }
  
  .btnn{
      width: 240px;
      height: 40px;
      background: orange;
      border: none;
      margin-top: 75px;
      font-size: 18px;
      border-radius: 10px;
      cursor: pointer;
      color: white;
      transition: 0.2s ease;
  }
  
  .btnn:hover{
      background: white;
      color: orange;
  }
  
  .btnn a{
      text-decoration: none;
      color: black;
      font-weight: bold;
  }
  @media only screen and (max-width: 920px){
      .sub{flex-direction: column-reverse;}
      .content span{font-size: 50px;}
      .main{height: auto;}
  }
  
  </style>
  