<template>
    <div class="content-wrapper pt-4 pb-4">
        <div class="recent-icons">
            <router-link class="icon"  :to="'/image/'+ item.id"
                :style="'background:url('+ item.url +') no-repeat center center'"
                v-for="(item, index) in downloadedImages" :key="index">
            </router-link>
        </div>
        <div class="service-list mt-4">
            <div class="service-item">
                <div class="service-img" :style="'background:url('+ service1 +')no-repeat center center'"></div>
                <div class="service-title">{{ $t('full_licence') }}</div>
                <div class="service-desc">
                    {{ $t('full_licence_content') }}
                </div>
            </div>
            <div class="service-item">
                <div class="service-img" :style="'background:url('+ service2 +')no-repeat center center'"></div>
                <div class="service-title">{{ $t('exclusive_content') }}</div>
                <div class="service-desc">
                    {{ $t('exclusive_content_content') }}
                </div>
            </div>
            <div class="service-item">
                <div class="service-img" :style="'background:url('+ service3 +')no-repeat center center'"></div>
                <div class="service-title">{{ $t('continuous_production') }}</div>
                <div class="service-desc">
                    {{ $t('continuous_production_content') }}
                </div>
            </div>
            <div class="service-item">
                <div class="service-img" :style="'background:url('+ service4 +')no-repeat center center'"></div>
                <div class="service-title">{{ $t('no_ads') }}</div>
                <div class="service-desc">
                    {{ $t('no_ads_content') }}
                </div>
            </div>
        </div>
        <div class="categories mt-4">
            <router-link :to="'/category/'+cate.id" class="cate-item text-black" v-for="(cate, index) in getCategoryImages" :key="index">
                <div class="cate-item-img" :style="'background:url('+ cate.url +')no-repeat center center'">
                </div>
                <div class="cate-item-title">
                    <span class="name">{{ getCategoryNameById(cate.id, $i18n.locale) }}</span>
                </div>
            </router-link>
        </div>
    </div>
</template>
<script>
    import icon from '@/js/assets/images/icon1.svg'
    import service1 from '@/js/assets/images/service/1.svg'
    import service2 from '@/js/assets/images/service/2.svg'
    import service3 from '@/js/assets/images/service/3.svg'
    import service4 from '@/js/assets/images/service/4.svg'

    import { mapActions, mapGetters } from 'vuex';
    import axios from 'axios';    

    export default {
        data(){
            return {
                icon,
                downloadedImages: [],
                downloadedImageDisplayCount: 36,
                service1,
                service2,
                service3,
                service4,
            }
        },
        computed:{
            ...mapGetters({
                getMostDownloadedImages: 'image/getMostDownloadedImages',
                getCategoryImages: 'image/getCategoryImages',
                getCategoryNameById: 'image/getCategoryNameById',
            })
        },
        methods:{
            ...mapActions({
                setMostDownloadedImages: 'image/setMostDownloadedImages',
                setCategoryImages: 'image/setCategoryImages'
            }),
            handleResize() {
                console.log(window.innerWidth);
                if(window.innerWidth >= 1024 && window.innerWidth < 1200){
                    this.downloadedImageDisplayCount = 27;
                    this.downloadedImages = this.getMostDownloadedImages.slice(0, this.downloadedImageDisplayCount-1);
                }
                if(window.innerWidth >= 768 && window.innerWidth < 1024){
                    this.downloadedImageDisplayCount = 18;
                    this.downloadedImages = this.getMostDownloadedImages.slice(0, this.downloadedImageDisplayCount-1);
                }
                if(window.innerWidth < 768){
                    this.downloadedImageDisplayCount = 9
                    this.downloadedImages = this.getMostDownloadedImages.slice(0, this.downloadedImageDisplayCount-1);
                }
            }             
        },
        mounted(){
            if(this.getMostDownloadedImages.length == 0){
                const app = this;
                axios.get('/get/most-downloaded-images').then(function(response){
                    app.setMostDownloadedImages(response.data.images);
                    app.downloadedImages = response.data.images.slice(0, app.downloadedImageDisplayCount-1);
                }).catch(function(errors){
                    console.log(errors);
                })
            }
            if(this.getCategoryImages.length == 1){
                const app = this;
                axios.get('/get/gategory-images').then(function(response){
                    app.setCategoryImages(response.data.images);
                    console.log(app.getCategoryImages);
                }).catch(function(errors){
                    console.log(errors);
                })
            }
        },
        created(){
            window.addEventListener('resize', this.handleResize)
            this.handleResize();
        },
        destroyed() {
            window.removeEventListener('resize', this.handleResize)
        }                 
    }
</script>
<style scoped>

</style>