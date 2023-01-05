<template>
    <div class="main-wrapper" :style="'background:url(' + background + ') no-repeat center center'">
        <div class="custom-panel">
            <form class="border">
                <h5 class="text-capitalize mt-0 text-center">{{ $t('login') }}</h5>
                <input type="email" class="input-orange col-md-12 mt-3" :class="emailError ? 'is-invalid' : ''" v-model="email" @input="emailChange" placeholder="Enter email">
                <span :class="emailError ? 'visible text-danger' : 'invisible'" id="email-error">Email Is Invalid</span>
                <input type="password" name="password" class="input-orange col-md-12" :class="passwordError ? 'is-invalid' : ''" @input="passwordChange" v-model="password" placeholder="Enter password">
                <span :class="passwordError ? 'visible text-danger' : 'invisible'" id="password-error">Password Is Invalid</span>
                <input type="hidden" name="_token" :value="token">
                <div class="row p-3">
                    <router-link :to="'/password/recovery'" class="btn btn-orange text-uppercase col-md-5 font-weight-bold" style="font-size: 14px">{{ $t('forget_your_password') }}</router-link>
                    <button type="button" class="btn btn-orange text-uppercase offset-md-1 col-md-6 font-weight-bold"
                        @click="submit">{{ $t('submit') }} 
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
            name: null,
            email: null,
            password: null,
            emailError: false,
            passwordError: false,
            background,
            isSubmitting: false,
        }
    },
    computed:{
        ...mapGetters({
            getAuthStatus: 'user/getAuthStatus'
        }),
        token() {
            let token = document.head.querySelector('meta[name="csrf-token"]');
            return token.content
        }        
    },
    methods:{
        ...mapActions({
            setAuthStatus: 'user/setAuthStatus'
        }),
        emailChange(){
            this.emailError = false;
        },
        passwordChange(){
            this.passwordError = false;
        },
        submit(){
            const app = this;
            this.isSubmitting = true;
            let formData = new FormData;
            formData.append('email', this.email);
            formData.append('password', this.password);
            axios.post('/login', formData).then(function(response){
                console.log(response.data.status);
                if(response.data.status == false){
                    app.isSubmitting = false;
                    if (response.data.errors.email) {
                        app.emailError = true;
                    }
                    if (response.data.errors.password) {
                        app.emailError = true;
                    }
                }else if( response.data.status == 1){
                    // email is not correct
                    app.isSubmitting = false;
                    app.emailError = true;
                }else if(response.data.status == 2){
                    // password is incorrect
                    app.isSubmitting = false;
                    app.passwordError = true;
                }else if(response.data.status == 3){
                    app.$router.push('/verify')
                }
                else if(response.data.status == 4){
                    app.isSubmitting = false;
                    app.setAuthStatus(true);
                    localStorage.setItem('is_logged', true);
                    app.$router.push('/account/dashboard')
                }else{
                    window.location = '/admin'
                }
            }).catch(function(errors){
                console.log(errors);
            })
        }
    }
}
</script>
<style scoped>

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