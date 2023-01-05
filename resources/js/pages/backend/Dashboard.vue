<template>
    <div class="auth-main-wrapper">
        <auth-header></auth-header>
        <div class="wrapper">
            <auth-left-side selectedMenu="dashboard"></auth-left-side>
            <div class="auth-content-wrapper">
                <h2>{{ user.first_name + ' ' + user.last_name }}</h2>
                <form class="profile-setting-panel border-bottom pb-4 mt-3">
                    <div class="user-img" @click="triggerImage">
                        <span class="far fa-user" v-if="userImgPath == null && user.image_url == ''"></span>
                        <img :src="userImgPath" alt="" v-if="userImgPath" height="100" width="100">
                        <img :src="user.image_url" alt="" v-if="userImgPath == null && user.image_url != ''" height="100" width="100">
                        <div class="edit-avatar">
                            <input type="file" ref="user_img" id="user_avatar" accept="image/*" @change="fileSelected">
                            <div class="avatar-edit-title">
                                <span class="mdi mdi-camera text-capitalize ml-3 mr-4"></span>
                                {{ $t('update_profile_photo') }}
                            </div>
                        </div>
                    </div>
                    <div class="user-info">
                        <div class="d-flex">
                            <div class="form-group col-md-6 pl-0">
                                <label for="firstname" class="text-uppercase">{{ $t('first_name') }}: <span class="text-orange">*</span></label>
                                <input type="firstname" name="firstname" v-model="user.first_name" class="form-control" id="firstname" autofocus>
                            </div>
                            <div class="form-group col-md-6">
                                <label for="lastname" class="text-uppercase">{{ $t('last_name') }}: <span class="text-orange">*</span></label>
                                <input type="lastname" class="form-control" id="lastname" v-model="user.last_name">
                            </div>
                        </div>
                            <div class="form-group col-md-12 pl-0">
                                <label for="email" class="text-uppercase">{{ $t('email_address') }}: <span class="text-orange">*</span></label>
                                <input type="email" class="form-control" v-model="user.email" id="email">
                            </div>
                    </div>
                    <button type="button" class="btn btn-orange text-capitalize mt-1 pt-3 pb-3"
                        @click="update">{{ $t('save_changes') }}</button>
                </form>

                <h5 class="text-capitalize mt-4">recent viewed images(last 30 days)</h5>
                <agile class="thumbnails mb-4 mt-4" :options="options" ref="thumbnails">
                    <div class="thumbnail slide slide--thumbnail" 
                        v-for="(slide, index) in getRecentImages" 
                        :key= "index" 
                        :class="'slide--'+index">
                        <img :src="slide.url">
                        <router-link :to="'/image/'+slide.id">{{ slide.name }}</router-link>
                        <router-link v-if="$i18n.locale == 'sp'" :to="'/image/'+slide.id">{{ slide.name_sp }}</router-link>
                        <router-link v-if="$i18n.locale == 'pt'" :to="'/image/'+slide.id">{{ slide.name_pt }}</router-link>
                        <router-link v-if="$i18n.locale == 'fr'" :to="'/image/'+slide.id">{{ slide.name_fr }}</router-link>
                        <router-link v-if="$i18n.locale == 'du'" :to="'/image/'+slide.id">{{ slide.name_du }}</router-link>
                        <router-link v-if="$i18n.locale == 'it'" :to="'/image/'+slide.id">{{ slide.name_it }}</router-link>
                    </div>
                    <template slot="prevButton"><i class="mdi mdi-chevron-left"></i></template>
                    <template slot="nextButton"><i class="mdi mdi-chevron-right"></i></template>
                </agile>
                <h5 class="text-capitalize mt-4">{{ $t('your_downloads') }}</h5>
                <agile class="thumbnails mb-4 mt-4" :options="options" ref="thumbnails">
                    <div class="thumbnail slide slide--thumbnail" 
                        v-for="(slide, index) in getDownloadedImages" 
                        :key= "index" 
                        :class="'slide--'+index">
                        <img :src="slide.url" style="object-fit:contain">
                        <router-link :to="'/image/'+slide.id">{{ slide.name }}</router-link>
                        <router-link v-if="$i18n.locale == 'sp'" :to="'/image/'+slide.id">{{ slide.name_sp }}</router-link>
                        <router-link v-if="$i18n.locale == 'pt'" :to="'/image/'+slide.id">{{ slide.name_pt }}</router-link>
                        <router-link v-if="$i18n.locale == 'fr'" :to="'/image/'+slide.id">{{ slide.name_fr }}</router-link>
                        <router-link v-if="$i18n.locale == 'du'" :to="'/image/'+slide.id">{{ slide.name_du }}</router-link>
                        <router-link v-if="$i18n.locale == 'it'" :to="'/image/'+slide.id">{{ slide.name_it }}</router-link>
                    </div>
                    <template slot="prevButton"><i class="mdi mdi-chevron-left"></i></template>
                    <template slot="nextButton"><i class="mdi mdi-chevron-right"></i></template>
                </agile>                
            </div>
        </div>
        <app-footer></app-footer>
    </div>    
</template>
<script>
import { VueAgile } from 'vue-agile';
import user_avatar from '@/js/assets/images/user.png';
import AuthHeader from '@/js/components/backend/authHeader.vue';
import AuthLeftSide from '@/js/components/backend/leftside.vue';
import {mapActions, mapGetters} from 'vuex';
import axios from 'axios';

export default {
    data(){
        return {
			options: {
				autoplay: true,
				centerMode: true,
				dots: false,
				navButtons: true,
				slidesToShow: 10,
				responsive: [
                    {
                        breakpoint: 600,
                        settings: {
                            slidesToShow: 7
                        }
                    },
                    
                    {
                        breakpoint: 1000,
                        settings: {
                            navButtons: true
                        }
                    }
                ]
				
            },
            user:{
                first_name: '',
                last_name: '',
                email: '',
                image_url: '',
            },
            userImg: null,
            userImgPath: null,
            filename: '' 
        }
    },
    components:{
        agile: VueAgile,
        authHeader: AuthHeader,
        authLeftSide: AuthLeftSide
    },
    computed:{
        ...mapGetters({
            getRecentImages: 'user/getRecentImages',
            getDownloadedImages: 'user/getDownloadedImages',
            getUserInfo: 'user/getUserInfo',
        })
    },
    methods:{
        ...mapActions({
            setRecentImages: 'user/setRecentImages',
            setDownloadedImages: 'user/setDownloadedImages',
            setUserInfo: 'user/setUserInfo',
        }),
        triggerImage () {
            this.$refs.user_img.click()
        },
        fileSelected(event){
            const file = event.target.files[0];
            this.filename = file.name
            const reader = new FileReader();
            reader.onload = e => {
                this.userImgPath = reader.result;
            };
            reader.readAsDataURL(file);                
            this.userImg = file;
        },
        update(){
            const app = this;
            let formData = new FormData;
            formData.append('first_name', this.user.first_name);
            formData.append('last_name', this.user.last_name);
            formData.append('email', this.user.email);
            if(this.userImgPath != null){
                formData.append('user_image', this.userImg);
            }
            axios.post('/userinfo/update', formData).then(function(response){
                console.log('successfully updated')
            }).catch(function(errors){
                console.log(errors)
            });
        }
    },
    mounted(){
        document.body.scrollTop = 0; // For Safari
        document.documentElement.scrollTop = 0; // For Chrome, Firefox, IE            
        const app = this;
        if(this.getUserInfo.first_name == ''){
            axios.get('/userinfo').then(function(response){
                app.setUserInfo(response.data.user);
                app.user = response.data.user
                app.setRecentImages(response.data.recentImages);
                app.setDownloadedImages(response.data.downloadedImages);
            })
        }else{
            app.user = app.getUserInfo
        }
    },
    created(){

    }        
}
</script>
<style>

</style>