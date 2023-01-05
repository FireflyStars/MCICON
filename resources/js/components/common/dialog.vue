<template>
<div id="success" class="modal">
  <form class="modal-content animate">
    <span @click="closeConfirm" class="close" title="Close Login">&times;</span>
    <div class="col-md-12 text-center p-0">
        <h4 class="text-uppercase text-primary login-title text-uppercase">{{ $t('confirm_email') }}</h4>
    </div>
    <div class="col-md-12 p-0 text-center">
      <img :src="confirm_email" alt="Avatar" class="avatar col-md-10 pl-0 pr-0">
    </div>
  </form>
</div>
</template>
<script>
import confirm_email from '@/js/assets/images/frontend/header/mail_confirm.png';
import axios from 'axios';
export default {
    data(){
        return{
            confirm_email,
            tokenInvalid: false,
            tokenError: 'Invalid token',
            token: null,
        }
    },
    methods:{
        closeConfirm() {
            document.getElementById("confirm").style.display = "none";
        },
        doActivate(){
            const app = this;
            axios.post('/register/activate', {
                token: this.token
            }).then(function(response){
                console.log(response.data.verified);
                if(response.data.verified){
                    app.closeConfirm();
                }else{
                    app.tokenInvalid = true;
                }
            }).catch(function(errors){
                console.log(errors);
            })
        },
        resendEmail(){
            axios.post('/confirm/resend/email', {
            }).then(function(response){
            }).catch(function(errors){
                console.log(errors);
            })
        }
    }
}
</script>
<style scoped>
.modal input[type=text], input[type=password] {
  width: 100%;
  padding: 10px 0;
  text-indent: 10px;
  display: inline-block;
  border: none;
  border-bottom: 1px solid #ccc;
  box-sizing: border-box;
  margin-bottom:20px;
}
.modal input:focus{
    outline: none;
}
.login-title{
    transform: scale(.8, 1);
    font-size: 20px;
}
/* Set a style for all buttons */
button[type='button'] {
  color: white;
  padding: 10px 20px;
  font-weight: 500;
  font-size: 20px;
  margin: 8px 0;
  border: none;
  cursor: pointer;
  width: 100%;
}
.modal input.invalid{
  border-bottom: 1px solid #f00;
  margin-bottom: 0;
}
span.invalid{
    color:rgb(253, 56, 2);
    margin-bottom: 5px;
}
.btn-login{
  background-color: #4CAF50;
}
.btn-google {
  /* background-color: #dd4b39; */
  background-color: rgb(253, 56, 2);
  color: white;
}
.btn-facebook {
  background-color: #3B5998;
  color: white;
}

button:hover {
  opacity: 0.8;
}
/* Center the image and position the close button */
span.psw {
    font-size: 16px;
}
span.psw a{
    font-size: 16px;
    color: #016299;
}
span.psw a:hover{
    color: blue;
}
/* The login-modal (background) */
.modal {
  display: none; /* Hidden by default */
  position: fixed; /* Stay in place */
  z-index: 1000; /* Sit on top */
  left: 0;
  top: 0;
  width: 100%; /* Full width */
  height: 100%; /* Full height */
  overflow: hidden; /* Enable scroll if needed */
  background-color: rgb(0,0,0); /* Fallback color */
  background-color: rgba(0,0,0,0.4); /* Black w/ opacity */
}

/* login-modal Content/Box */
.modal-content {
  background-color: #fefefe;
  margin: 5% auto 35% auto; /* 5% from the top, 15% from the bottom and centered */
  /* border: 1px solid #888; */
  padding: 40px 5%;
  border-radius: 0;
  width: 30%; /* Could be more or less, depending on screen size */
}
@media only screen and (max-width: 768px){
    .modal-content {
        width: 90%;
        margin: 5% auto 5% auto; /* 5% from the top, 15% from the bottom and centered */
    }
}
/* The Close Button (x) */
.close {
  position: absolute;
  right: 10px;
  top: 0;
  color: #000;
  font-size: 35px;
  font-weight: bold;
}

.close:hover,
.close:focus {
  color: #016299;
  cursor: pointer;
}

/* Add Zoom Animation */
.animate {
  -webkit-animation: animatezoom 0.6s;
  animation: animatezoom 0.6s
}

@-webkit-keyframes animatezoom {
  from {-webkit-transform: scale(0)}
  to {-webkit-transform: scale(1)}
}

@keyframes animatezoom {
  from {transform: scale(0)}
  to {transform: scale(1)}
}

/* Change styles for span and cancel button on extra small screens */
@media screen and (max-width: 300px) {
  span.psw {
     display: block;
     float: none;
  }
  .cancelbtn {
     width: 100%;
  }
}
.checkbox_wrap {
    position: relative;
}

.checkbox_wrap label {
    margin: 0;
    display: inline-block;
    cursor: pointer;
    position: relative;
    overflow: hidden;
    font-size: 14px;
    height: 20px;
}

.checkbox_wrap label span {
    display: block;
    width: 20px;
    height: 20px;
    color: inherit;
    font-size: 13px;
}

.checkbox_wrap label span:after {
    position: absolute;
    top: 0;
    left: 0;
    content: '';
    display: block;
    width: 20px;
    height: 20px;
    margin: 0;
    border: 1px solid #eee;
    background-color: rgb(185, 180, 180);
    text-align: center;
}

.checkbox_wrap label span:before {
    content: '\2714';
    /* transition: all 0.4s; */
    font-size: 15px;
    position: absolute;
    top: 50%;
    left: 3px;
    transform: translate(0, -300%);
    font-family: FontAwesome, sans-serif;
    /* color: rgb(185, 180, 180); */
    color: black;
    z-index: 2;
}

.checkbox_wrap input[type=checkbox],
.checkbox_wrap input[type=radio] {
    display: inline;
    cursor: pointer;
    color: black;
    position: relative;
    /* width: 0;
  height: 0; */
    margin: 0;
    padding: 0;
    outline: none;
    -moz-appearance: none;
    -webkit-appearance: none;
    -ms-appearance: none;
    appearance: none;
    /* transition: all 0.3s; */
    overflow: hidden;
}

.checkbox_wrap input[type=checkbox]:checked+span:before,
.checkbox_wrap input[type=radio]:checked+span:before {
    transform: translate(0, -50%);
}

.checkbox_wrap input[type=checkbox]:checked+span:after,
.checkbox_wrap input[type=radio]:checked+span:after {
    background-color: rgb(185, 180, 180);
    /* background: #d11925; */
}
</style>
