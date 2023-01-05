<template>
    <div class="content-wrapper pt-4 pb-4">
        <div class="download-panel">
            <div class="image-panel border">
                <div class="big-icon" 
                    :style="'background:url('+ getImageUrlByImageId(id) +') no-repeat center center'">
                </div>
                <div class="icon-title">{{ getImageNameByImageId(id ,$i18n.locale) }}</div>
            </div>
            <div class="auth-panel border">
                <div class="signup-panel" v-if="getAuthStatus == false">
                    <div class="sub-title">{{ $t('create_your_free_account') }}</div>
                    <input type="email" class="col-md-12 mt-3" v-model="email" @input="emailChange" placeholder="Email address" required autofocus>
                    <span :class="emailError ? 'visible text-danger' : 'invisible'">Email Is Invalid</span>
                    <input type="password" class="col-md-12" v-model="password" @input="passwordChange" placeholder="Password" required>
                    <span :class="passwordError ? 'visible text-danger' : 'invisible'">Password Is Invalid</span>
                    <button class="btn btn-orange col-md-12" @click="login">
                        {{ $t('login') }}
                        <span class="spinner-border spinner-border-sm text-success" v-if="isSubmitting"></span>
                        </button>
                </div>
                <div class="copyright-text"  v-if="getAuthStatus == true">
                    <h6 class="col-md-12 p-0">{{ $t('remember_you_have_to_credit_the_author') }}</h6>
                    <div class="col-md-12 p-0">{{ $t('copy_the_following_link_into_the_website') }}<router-link class="col-md-12 p-0" :to="'/'">Attribution Guide</router-link>
                    </div>
                    
                    <button class="btn btn-orange col-md-12 mt-3" @click="download(id)">{{ $t('download') }}</button>
                </div>
                <!-- <button class="btn btn-orange col-md-12">Download</button> -->
                <div class="col-md-12 text-justify pl-0 pr-0 pb-3 mt-2 desc border-bottom">
                    {{ $t('i_agree_to') }} MCICON <router-link :to="'/website-terms'">{{ $t('website_terms') }}</router-link>, <router-link :to="'/privacy-policy'">{{ $t('privacy_police') }}</router-link> {{ $t('and') }} <router-link :to="'/licensing-terms'">{{ $t('pricing') }}</router-link>.
                </div>
                <div class="col-md-12 p-0 mt-3">{{ $t('already_have_an_account') }} <router-link :to="'/login'">{{ $t('login') }}</router-link></div>
            </div>
        </div>
        <div class="tag-panel p-2">
            <h5 class="col-md-12 p-0 m-0">
                {{ $t('related_keywords') }} 
                <span class="text-primary cursor-pointer" v-if="showAllFlag" @click="showAll">{{ $t('show_less') }}</span>
                <span class="text-primary cursor-pointer" v-if="!showAllFlag" @click="showAll">{{ $t('show_all') }}</span>
            </h5>
            <div class="tag-list mt-2" id="tag-list-panel">
                <router-link class="tag-item" :to="'/category/'+item.cate_id" v-for="(item, index) in getRelatedKeys" :key="index">{{ item.name }}</router-link>
            </div>
        </div>
        <div class="similar-images mt-4">
            <h6 class="col-md-12 p-0">{{ $t('similar_images') }}</h6>
        </div>
        <div class="image-gallery mt-3">
            <router-link :to="'/image/'+item.id" class="icon" 
            :style="'background:url('+ item.url + ') no-repeat center center'"
            v-for="(item, index) in getSimilarImages" :key="index"></router-link>
        </div>        
    </div>    
</template>
<script>
import { mapGetters, mapActions } from 'vuex';
import axios from 'axios';

export default {
    props:['id'],
    data(){
        return {
            email: null,
            password: null,
            emailError: false,
            passwordError: false,            
            isSubmitting: false,
            showAllFlag: false,
            cateId: null,
        }
    },
    computed:{
        ...mapGetters({
            getAuthStatus: 'user/getAuthStatus',
            getImageUrlByImageId: 'image/getImageUrlByImageId',
            getImageNameByImageId: 'image/getImageNameByImageId',
            getRelatedKeys: 'image/getRelatedKeys',
            getSimilarImages: 'image/getSimilarImages',
        })
    },
    methods:{
        ...mapActions({
            setAuthStatus: 'user/setAuthStatus',
            setCategoryGallery: 'image/setCategoryGallery',
            setSimilarImages: 'image/setSimilarImages',
            setRelatedKeys: 'image/setRelatedKeys',
        }),
        emailChange(){
            this.emailError = false;
        },
        passwordChange(){
            this.passwordError = false;
        },        
        login(){
            const app = this;
            this.isSubmitting = true;
            let formData = new FormData;
            formData.append('email', this.email);
            formData.append('password', this.password);
            axios.post('/login', formData).then(function(response){
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
                else{
                    app.isSubmitting = false;
                    app.setAuthStatus(true);
                    localStorage.setItem('is_logged', true);
                }
            }).catch(function(errors){
                console.log(errors);
            })
        },
        showAll(){
            this.showAllFlag = !this.showAllFlag;
            if(this.showAllFlag){
                document.querySelector('.tag-list').style.maxHeight = '160px';
            }else{
                document.querySelector('.tag-list').style.maxHeight = '80px';
            }
        },
        download(imageId){
            axios.get('/images/'+ this.id +'/download').then(function(response){
                console.log(response);
            }).catch(function(errors){
                console.log(errors);
            })
        }            
    },
    components:{

    },
    mounted(){
        if (localStorage.getItem('is_logged') == true) {
            this.setAuthStatus(true);
        }
        const app = this;
        axios.get('/get/category-gallery-by-image-id/'+this.id).then(function(response){
            app.cateId = response.data.cate_id;
            app.setCategoryGallery(response.data.gallery);
            app.setRelatedKeys(response.data.relatedKeys);
            app.setSimilarImages(response.data.similarImages);
        }).catch(function(errors){
            console.log(errors);
        })
    }
}
</script>
<style scoped>

</style>