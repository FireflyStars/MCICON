<template>
    <div class="main-wrapper"  :style="'background:url(' + background + ') no-repeat center center'">
        <div class="custom-panel">
            <form class="border">
                <h5 class="text-capitalize mt-0 text-center">{{ $t('reset_password') }}</h5>
                <input type="password" name="password" @input="changePassword" class="input-orange col-md-12"  v-model="password" placeholder="Enter password">
                <span :class="passwordError ? 'visible text-danger' : 'invisible'">{{ passwordError }}</span>
                
                <input type="password" name="password_confirmation" class="input-orange col-md-12" v-model="password_confirmation" placeholder="Confirm password">

                <button type="button" class="btn btn-orange text-uppercase offset-md-2 col-md-8 mt-3 font-weight-bold"
                    @click="submit" >
                    {{ $t('submit') }}
                    <span class="spinner-border spinner-border-sm text-success" v-if="isSubmitting"></span>
                </button>
            </form>
        </div>
    </div>
</template>
<script>
import background from '@/js/assets/images/login_bg.jpg';

export default {
    props:['token'],
    data(){
        return{
            password: null,
            password_confirmation: null,            
            passwordError: false,
            isSubmitting: false,
            background
        }
    },
    methods:{
        changePassword(){
            this.passwordError = false;
        },  
        submit(){
            const app = this;
            this.isSubmitting = true;
            let formData = new FormData;
            formData.append('password', this.password);
            formData.append('password_confirmation', this.password_confirmation);
            formData.append('token', this.token);
            axios.post('/password/reset', formData).then(function(response){
                if(response.data.status == false){
                    app.isSubmitting = false;
                    app.passwordError = response.data.errors['password'][0];
                }else{
                    app.isSubmitting = false;
                    app.$router.push('/login');
                }
            }).catch(function(errors){
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
        padding: 20px;
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