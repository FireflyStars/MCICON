<template>
    <div class="main-wrapper" :style="'background:url(' + background + ') no-repeat center center'">
        <div class="custom-panel" v-if="isSuccess">
            <form class="border">
                <h5 class="text-capitalize mt-0 text-center">{{ $t('verified') }}</h5>
                <p class="mt-0 m-0 text-center" style="font-size: 14px">{{ $t('verified_content') }}</p>
            </form>
        </div>
    </div>
</template>
<script>
import background from '@/js/assets/images/login_bg.jpg';
import { mapActions } from 'vuex'
import axios from 'axios';

export default {
    props:['token'],
    data(){
        return{
            background,
            isSuccess : false
        }
    },
    methods:{
        ...mapActions({
            setAuthStatus: 'user/setAuthStatus'
        }),        
    },
    mounted(){
        const app = this;
        axios.post('/verify/'+this.token).then(function(response){
            app.isSuccess = true;
            setTimeout(function(){
                localStorage.setItem('is_logged', true);
                app.setAuthStatus(true);
                app.$router.push('/account/dashboard');
            }, 5000)
        }).catch(function(errors){
            app.isSubmitting = false;
            console.log(errors);
        })
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