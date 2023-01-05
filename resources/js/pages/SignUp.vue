<template>
    <div class="main-wrapper" :style="'background:url(' + background + ') no-repeat center center'">
        <div class="custom-panel">
            <form class="border">
                <h5 class="text-capitalize mt-0 text-center">{{ $t('register') }}</h5>
                <div class="custom-form-group">
                    <input type="text" class="input-orange col-md-12 mt-3" @input="changeFirstName" autofocus v-model="firstname" placeholder="Enter first name">
                    <span :class="firstnameError ? 'visible text-danger' : 'invisible'">{{ firstnameError }}</span>

                    <input type="text" class="input-orange col-md-12" @input="changeLastName" v-model="lastname" placeholder="Enter last name">
                    <span :class="lastnameError ? 'visible text-danger' : 'invisible'">{{ lastnameError }}</span>

                    <input type="email" class="input-orange col-md-12" @input="changeEmail" v-model="email" placeholder="Enter email">
                    <span :class="emailError ? 'visible text-danger' : 'invisible'">{{ emailError }}</span>
                    
                    <input type="password" name="password" @input="changePassword" class="input-orange col-md-12"  v-model="password" placeholder="Enter password">
                    <span :class="passwordError ? 'visible text-danger' : 'invisible'">{{ passwordError }}</span>
                    
                    <input type="password" name="password_confirmation" class="input-orange col-md-12" v-model="password_confirmation" placeholder="Confirm password">

                    <button type="button" class="btn btn-orange text-uppercase offset-md-2 col-md-8 mt-3 font-weight-bold"
                        @click="submit">
                        {{ $t('submit') }}
                        <span class="spinner-border spinner-border-sm text-success" v-if="isSubmitting"></span>
                    </button>
                </div>
            </form>
        </div>
    </div>
</template>
<script>
import background from '@/js/assets/images/login_bg.jpg';
import { mapActions, mapGetters } from 'vuex'
import axios from 'axios';

export default {
    data(){
        return{
            firstname: null,
            lastname: null,
            email: null,
            password: null,
            password_confirmation: null,
            firstnameError: false,
            lastnameError: false,
            emailError: false,
            passwordError: false,
            background,
            isSubmitting: false
        }
    },
    methods:{
        ...mapActions({
            setAuthStatus: 'user/setAuthStatus'
        }),
        changeEmail(){
            this.emailError = false;
        },
        changePassword(){
            this.passwordError = false;
        },
        changeFirstName(){
            this.firstnameError = false;
        },
        changeLastName(){
            this.lastnameError = false;
        },
        submit(){
            const app = this;
            this.isSubmitting = true;
            let formData = new FormData;
            formData.append('firstname', this.firstname);
            formData.append('lastname', this.lastname);
            formData.append('email', this.email);
            formData.append('password', this.password);
            formData.append('password_confirmation', this.password_confirmation);
            axios.post('/register', formData).then(function(response){
                if(response.data.status == false){
                    app.isSubmitting = false;
                    if (response.data.errors.email) {
                        app.emailError = response.data.errors['email'][0];
                    }
                    if (response.data.errors.firstname) {
                        app.firstnameError = response.data.errors['firstname'][0];
                    }
                    if (response.data.errors.lastname) {
                        app.lastnameError = response.data.errors['lastname'][0];
                    }
                    if (response.data.errors.password) {
                        app.passwordError = response.data.errors['password'][0];
                    }
                }else{
                    app.isSubmitting = false;
                    // localStorage.setItem('is_logged', true);
                    // app.setAuthStatus(true);
                    app.$router.push('/verify')
                }
            }).catch(function(errors){
                    app.isSubmitting = false;
                console.log(errors);
            })
        }
    }
}
</script>
<style scoped>
    body{
        width: 100%;
        height: 100%;
    }
    .custom-panel{
        width: 100%;
        height: 100%;
        display: flex;
        justify-content: center;
        align-items: center;
    }
    .custom-panel form{
        width: 400px;
        margin: auto;
        margin-top: 5%;
        /* box-shadow: 2px 2px 2px 2px rgba(0, 0 , 0, .2); */
        padding: 40px;
        border-radius: 50px;
        background: white;
    }
    @media only screen and (max-width: 450px){
        .custom-panel{
            width: 100%;
        }
    }
    .input-orange{
        border: 2px solid #f47b21;
        border-radius: 10px;
        text-align: left;
        height: 50px;
    }
</style>