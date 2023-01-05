<template>
    <div class="main-wrapper">
        <app-header type="2"></app-header>
        <div class="content-wrapper">
            <form class="contact-us-panel p-2 m-auto">
                <div class="sub-title mt-3">{{ $t('contact_us') }}</div>
                <div class="pl-2">{{ $t('your_question_may_already_be_answered_in') }} <router-link :to="''" class="text-orange">{{ $t('frequently_asked_questions') }}</router-link> section</div>
                <div class="row p-4">
                    <div class="col-md-6 p-0">
                        <label for="fullname" class="text-uppercase col-md-12 p-0">{{ $t('your_full_name') }} <span class="text-orange">*</span></label>
                        <input type="text" class="input-orange col-md-12" @input="nameChange" id="fullname" v-model="fullname" required>
                        <span :class="nameError ? 'visible text-danger' : 'invisible'">{{ nameError }}</span>
                    </div>
                    <div class="col-md-6 pl-1 p-0">
                        <label for="email" class="text-uppercase col-md-12 p-0">{{ $t('email_address') }} <span class="text-orange">*</span></label>
                        <input type="text" class="input-orange col-md-12" @input="emailChange" id="email" v-model="email" required>
                        <span :class="emailError ? 'visible text-danger' : 'invisible'">{{ emailError }}</span>
                    </div>                    
                </div>
                <h6 class="text-uppercase pl-2">{{ $t('how_can_we_help_you') }} <span class="text-orange">*</span></h6>
                <textarea name="qeustion" @input="msgChange" :class="msgError ? 'is-invalide': ''" v-model="msg" class="ml-2 p-3" id="" rows="10"></textarea>
                <vue-recaptcha class="ml-2" 
                    :sitekey="siteKey" 
                    :loadRecaptchaScript="true"
                    :lang="'en'"
                    @verify="onVerify"
                    @expired="onExpired"                    
                    ref="reCaptcha"
                    >
                </vue-recaptcha>
                <div class="ml-2" :class="verifyError ? 'visible text-danger' : 'invisible'" >Please verify the Recaptcha before submit</div>
                <button type="button" class="btn btn-orange text-uppercase ml-2 mt-3" @click="submit">
                    {{ $t('submit') }}
                    <span class="spinner-border spinner-border-sm text-success" v-if="isSubmitting"></span>
                    </button>
            </form>
        </div>
        <app-footer :visibleCategory='true'></app-footer>
    </div>   
</template>

<script>
    import VueRecaptcha from 'vue-recaptcha';
    import axios from 'axios';

    export default {
        data(){
            return{
                fullname: null,
                email: null,
                msg: null,
                isSubmitting: false,
                verifyError: false,
                emailError: false,
                msgError: false,
                nameError: false,
                token: null,
                oldLang: 'en',
                siteKey: '6LfxucMUAAAAAIM4rTXBSV3jljVG69klwJRKsVIq',
                secretKey: '6LfxucMUAAAAAHLVW7dOVtuaLIl35hirLSAFU8qm',
            }
        },
        computed:{
        },
        components:{
            VueRecaptcha        
        },
        methods:{
            submit(){
                // if(this.token == null){
                //     this.verifyError = true;
                //     return
                // }
                const app = this;
                this.isSubmitting = true;
                let formData = new FormData;
                formData.append('name', this.fullname);
                formData.append('email', this.email);
                formData.append('msg', this.msg);
                axios.post('/send/message', formData).then(function(response){
                    app.isSubmitting = false;
                    console.log(response.data.errors)
                    if(response.data.status == false){
                        if (response.data.errors['email']) {
                            app.emailError = response.data.errors['email'][0];
                        }
                        if (response.data.errors['name']) {
                            app.nameError = response.data.errors['name'][0];
                        }
                        if (response.data.errors['msg']) {
                            app.msgError = response.data.errors['msg'][0];
                        }
                        app.$refs.reCaptcha.reset()
                    }else{

                    }
                }).catch(function(errors){
                    app.isSubmitting = false;
                    console.log(errors);
                })
            },
            onVerify(response){
                this.token = response;
                this.verifyError = false;
            },
            onExpired(){
                this.token = null;
            },
            nameChange(){
                this.nameError = false;
            },
            emailChange(){
                this.emailError = false;
            },
            msgChange(){
                this.msgError = false;
            }
        },
        updated(){
            // if(this.oldLang != this.$i18n.locale){
            //     this.oldLang = this.$i18n.locale
            //     document.getElementById('__RECAPTCHA_SCRIPT').remove()
            //     // Note: vueRecaptchaApiLoaded load callback name is per the latest documentation
            //     var script = document.createElement('script');
            //     script.id = '__RECAPTCHA_SCRIPT';
            //     script.src = "https://www.google.com/recaptcha/api.js?onload=vueRecaptchaApiLoaded&render=explicit&hl=" + this.$i18n.locale;
            //     script.async = true;
            //     script.defer = true;
            //     document.head.appendChild(script);
            //     this.$refs.reCaptcha.reset()
            // }
        },
        mounted(){
            document.body.scrollTop = 0; // For Safari
            document.documentElement.scrollTop = 0; // For Chrome, Firefox, IE            
        }           
            
    }
</script>
<style scoped>
    .contact-us-panel{
        width: 600px;
    }
    @media only screen and (max-width: 600px){
        .contact-us-panel{
            width: 100%;
        }
    }
    .input-orange{
        border: 2px solid #f47b21;
        border-radius: 10px;
        text-align: left;
        height: 50px;
    }
    textarea{
        border-radius: 5px;
        border: 2px solid lightgray;
        width: 100%;
        outline: none;
    }
</style>