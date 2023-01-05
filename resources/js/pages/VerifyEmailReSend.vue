<template>
    <div class="main-wrapper" :style="'background:url(' + background + ') no-repeat center center'">
        <div class="custom-panel">
            <form class="border">
                <h5 class="text-capitalize mt-0 text-center">{{ $t('verify') }}</h5>
                <p class="mt-0 m-0" style="font-size: 12px">{{ $t('verify_email_content') }}</p>
                <!-- <p class="mt-0 font-weight-bold m-0" style="font-size: 12px">{{ $t('email_address') }}: {{ email }}</p> -->
                <button type="button" class="btn btn-orange text-uppercase offset-md-2 col-md-8 mt-3 font-weight-bold"
                    @click="submit">
                    {{ $t('resend') }}
                    <span class="spinner-border spinner-border-sm text-success" v-if="isSubmitting"></span>
                </button>                
            </form>
        </div>
    </div>
</template>
<script>
import background from '@/js/assets/images/login_bg.jpg';
import axios from 'axios';

export default {
    data(){
        return{
            email: null,
            background,
            isSubmitting: false,
        }
    },
    methods:{
        submit(){
            const app = this;
            this.isSubmitting = true;
            axios.post('/resend/verifyemail').then(function(response){
                app.isSubmitting = false;
            }).catch(function(errors){
                app.isSubmitting = false;
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