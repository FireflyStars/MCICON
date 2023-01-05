<template>
    <footer>
        <div v-if="visibleCategory" class="category-map">
            <div class="sub-title ml-4 pl-2">{{ $t('all_categories') }}</div>
            <div class="cate-list pb-4 pt-4">
                <router-link class="dropdown-item" :to="'/category/'+item.id" v-for="(item, index) in getCategoryImages" :key="index">
                {{ getCategoryNameById(item.id, $i18n.locale) }}</router-link>
            </div>
        </div>
        <div class="footer-content border-bottom">
            <div class="site-map">
                <div class="sub-title text-capitalize text-white" style="width:100%">
                    {{ $t('our_company') }}
                </div>
                <ul class="pl-3">
                    <li><router-link :to="'/'">{{ $t('home') }}</router-link></li>
                    <li><router-link :to="'/about-us'">{{ $t('terms_of_use') }}</router-link></li>
                    <li><router-link :to="'/support-center'">{{ $t('support_center') }}</router-link></li>
                    <li><router-link :to="'/privacy-policy'">{{ $t('privacy_police') }}</router-link></li>
                    <li><router-link :to="'/price'">{{ $t('pricing') }}</router-link></li>
                </ul>
            </div>
            <div class="popular-map">
                <div class="sub-title text-capitalize text-white" style="width:100%">{{ $t('popular_search') }}</div>
                <div class="popular-list pl-3">
                    <div class="popular-item"><router-link :to="''">Car icon</router-link></div>
                    <div class="popular-item"><router-link :to="''">Car icon</router-link></div>
                    <div class="popular-item"><router-link :to="''">Car icon</router-link></div>
                    <div class="popular-item"><router-link :to="''">Car icon</router-link></div>
                    <div class="popular-item"><router-link :to="''">Food icon</router-link></div>
                    <div class="popular-item"><router-link :to="''">Food icon</router-link></div>
                    <div class="popular-item"><router-link :to="''">Food icon</router-link></div>
                    <div class="popular-item"><router-link :to="''">Food icon</router-link></div>
                    <div class="popular-item"><router-link :to="''">Abstract icon</router-link></div>
                    <div class="popular-item"><router-link :to="''">Abstract icon</router-link></div>
                    <div class="popular-item"><router-link :to="''">Abstract icon</router-link></div>
                    <div class="popular-item"><router-link :to="''">Abstract icon</router-link></div>
                    <div class="popular-item"><router-link :to="''">Animal icon</router-link></div>
                    <div class="popular-item"><router-link :to="''">Animal icon</router-link></div>
                    <div class="popular-item"><router-link :to="''">Animal icon</router-link></div>
                    <div class="popular-item"><router-link :to="''">Animal icon</router-link></div>
                    <div class="popular-item"><router-link :to="''">Beauty icon</router-link></div>
                    <div class="popular-item"><router-link :to="''">Beauty icon</router-link></div>
                    <div class="popular-item"><router-link :to="''">Beauty icon</router-link></div>
                    <div class="popular-item"><router-link :to="''">Beauty icon</router-link></div>
                </div>
            </div>
            <div class="world-map" :style="'background:url('+ world_map +') no-repeat center center'">
            </div>
        </div>
        <div class="footer-info text-white">
            <span class="copyright">&copy; 2019-2020 MCICON</span>
            <ul class="soc-link">
                <li class="soc-item"><a href=""><i class="mdi mdi-twitter-circle"></i></a></li>
                <li class="soc-item"><a href=""><i class="mdi mdi-pinterest"></i></a></li>
                <li class="soc-item"><a href=""><i class="mdi mdi-instagram"></i></a></li>
                <li class="soc-item"><a href=""><i class="mdi mdi-facebook"></i></a></li>
                <li class="soc-item"><a href=""><i class="mdi mdi-google"></i></a></li>
                <li class="soc-item"><a href=""><i class="ti-tumblr"></i></a></li>
            </ul>
        </div>
    </footer>
</template>
<script>
    import world_map from '@/js/assets/images/world_map.png';
    import { mapGetters, mapActions } from 'vuex';

    export default {
        props:['visibleCategory'],
        data(){
            return {
                world_map
            }
        },
        computed:{
            ...mapGetters({
                getCategoryImages: 'image/getCategoryImages',
                getCategoryNameById: 'image/getCategoryNameById'
            })
        },
        methods:{
            ...mapActions({
                setCategoryImages: 'image/setCategoryImages'
            })
        },

        mounted(){
            if(this.getCategoryImages.length == 0){
                const app = this;
                axios.get('/get/gategory-images').then(function(response){
                    app.setCategoryImages(response.data.images);
                }).catch(function(errors){
                    console.log(errors);
                })
            }             
        }
    }
</script>
<style scoped>

</style>