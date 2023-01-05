<template>
    <div class="main-wrapper"  :style="'background:url(' + background + ') no-repeat center center'">
        <div class="custom-panel">
            <form class="border" v-if="!isSuccess">
                <h5 class="text-capitalize mt-0 text-center">{{ $t('password_recovery') }}</h5>
                <span class="mt-0 text-center" style="font-size: 12px">{{ $t('password_recovery_desc') }}</span>
                <input type="email" class="input-orange col-md-12 mt-3" autofocus v-model="email" placeholder="Enter email">
                <div :class="emailError ? 'visible text-danger' : 'invisible'" id="email-error">{{ emailError }}</div>
                <button type="button" class="btn btn-orange text-uppercase offset-md-2 col-md-8 font-weight-bold"
                    @click="submit" >
                    {{ $t('submit') }}
                    <span class="spinner-border spinner-border-sm text-success" v-if="isSubmitting"></span>
                </button>
            </form>
            <form class="border" v-if="isSuccess">
                <h5 class="text-capitalize mt-0 text-center">{{ $t('successfully_send') }}</h5>
                <div class="mt-0 text-center mt-3" style="font-size: 14px">{{ $t('successfully_send_desc') }}</div>
            </form>
        </div>
    </div>
</template>
<script>
import background from '@/js/assets/images/login_bg.jpg';

export default {
    data(){
        return{
            email: null,
            emailError: false,
            isSubmitting: false,
            isSuccess: false,
            background
        }
    },
    methods:{
        emailChange(){
            this.emailError = false;
        },   
        submit(){
            const app = this;
            this.isSubmitting = true;
            let formData = new FormData;
            formData.append('email', this.email);
            axios.post('/password/recovery', formData).then(function(response){
                if(response.data.status == false){
                    app.isSubmitting = false;
                    app.emailError = response.data.errors['email'][0];
                }else{
                    app.isSuccess = true;
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