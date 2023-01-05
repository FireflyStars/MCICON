<template>
    <div class="auth-main-wrapper">
        <auth-header></auth-header>
        <div class="wrapper">
            <auth-left-side selectedMenu="download"></auth-left-side>
            <div class="auth-content-wrapper pt-0 pr-0 pl-1">
                <ul class="download-history-panel m-0 p-0 mb-4">
                    <li class="download-item p-1 bg-transparent">
                        <div class="download-img d-flex justify-content-center">
                        </div>
                        <div class="download-id text-uppercase font-weight-bold" style="color:#747b84">{{ $t('id') }}</div>
                        <div class="download-date text-capitalize font-weight-bold" style="color:#747b84">{{ $t('date') }}</div>
                        <div class="download-license text-capitalize font-weight-bold" style="color:#747b84;">{{ $t('licence_type') }}</div>
                        <!-- <div class="upgrade-membership"></div> -->
                    </li>
                    <li class="download-item p-1 border-bottom bg-white" v-for="(item, index) in getDownloadedImages" :key="index">
                        <div class="download-img d-flex justify-content-center">
                            <router-link class="p-2" :to="'/image/'+item.id">
                                <img :src="item.url" alt="">
                            </router-link>
                        </div>
                        <div class="download-id">{{ item.id }}</div>
                        <div class="download-date">{{ item.created_at | moment('mm/DD/YYYY') }}</div>
                        <div class="download-license">Free</div>
                        <div class="redownload text-center"><span class="text-capitalize text-orange cursor-pointer re-download-btn" @click="download(item.id)">{{ $t('re_download') }}</span></div>
                        <!-- <div class="upgrade-membership"></div> -->
                    </li>
                </ul>
                <button class="btn btn-orange offset-2 p-2 text-capitalize mb-4" v-if="loadMore" @click="loadMore">load more</button>
            </div>
        </div>
        <app-footer></app-footer>
    </div>
</template>
<script>
import img from '@/js/assets/images/user.png'
import AuthHeader from '@/js/components/backend/authHeader.vue';
import AuthLeftSide from '@/js/components/backend/leftside.vue';
import { mapActions, mapGetters } from 'vuex';
import axios from 'axios';

export default {
    data(){
        return {
            img,
            loadMore: false,
            perPage: 10,
            totalCount: null,
        }
    },
    computed:{
        ...mapGetters({
            getDownloadedImages: 'user/getDownloadedImages',
            getRecentImages: 'user/getRecentImages',
            getUserInfo: 'user/getUserInfo',
        }),
    },
    methods:{
        ...mapActions({
            setDownloadedImages: 'user/setDownloadedImages',
            setRecentImages: 'user/setRecentImages',
            setUserInfo: 'user/setUserInfo',
        }),
        download(imageId){
            axios.get('/images/'+ imageId +'/download').then(function(response){
                console.log(response);
            }).catch(function(errors){
                console.log(errors);
            })
        }
    },
    components:{
        authHeader: AuthHeader,
        authLeftSide: AuthLeftSide        
    },    
    mounted(){
        document.body.scrollTop = 0; // For Safari
        document.documentElement.scrollTop = 0; // For Chrome, Firefox, IE            
        const app = this;
        if(this.getDownloadedImages.length == 1){
            axios.get('/userinfo').then(function(response){
                app.user = response.data.user;
                app.setUserInfo(response.data.user)
                app.setRecentImages(response.data.recentImages);
                app.setDownloadedImages(response.data.downloadedImages);
                app.totalCount = response.data.downloadedImages.length;
                if (app.totalCount - app.perPage > 0) {
                    app.loadMore = true;
                }
            })
        }        
    }
}
</script>
<style scoped>

</style>