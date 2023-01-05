<template>
    <div class="content-wrapper pt-4 pb-4">
        <div class="sub-title">{{ getCategoryNameById(id, $i18n.locale) }}</div>
        <div class="image-gallery mt-3">
            <router-link :to="'/image/'+item.id" class="icon" 
            :style="'background:url('+ item.url + ') no-repeat center center'"
            v-for="(item, index) in gallery" :key="index"></router-link>
        </div>
        <app-paginator 
            :totalPages="totalPages" 
            :total="gallery.length" 
            :currentPage="currentPage"
            @pagechanged="onPageChange"
            :cateId="id"
        ></app-paginator>
    </div>    
</template>
<script>
import icon from '@/js/assets/images/icon1.svg';
import paginator from '@/js/components/common/paginator';
import { mapGetters, mapActions } from 'vuex';
import axios from 'axios';
export default {
    props:['id'],
    data(){
        return {
            icon,
            gallery: [],
            tempGallery: [],
            currentPage: 1,
            totalPages: 10,
            perPage: 4,
        }
    },
    computed:{
        ...mapGetters({
            isAuth: 'user/getAuthStatus',
            getCategoryImages: 'image/getCategoryImages',
            getCategoryGallery: 'image/getCategoryGallery',
            getCategoryNameById: 'image/getCategoryNameById'
        })
    },
    methods:{
        ...mapActions({
            setAuthStatus: 'user/setAuthStatus',
            setCategoryGallery: 'image/setCategoryGallery',
            setCategoryImages: 'image/setCategoryImages',
        }),   
        onPageChange(page) {
            this.totalPages = Math.ceil(this.getCategoryGallery.length / this.perPage);
            this.gallery = this.getCategoryGallery.slice(this.perPage*(page-1), this.perPage*page);          
            this.currentPage = page;
        },
        handleResize() {
            if(window.innerWidth >= 1200){
                this.perPage = 60;
            }
            if(window.innerWidth >= 1024 && window.innerWidth < 1200){
                this.perPage = 50;
            }
            if(window.innerWidth >= 768 && window.innerWidth < 1024){
                this.perPage = 30;
            }
            if(window.innerWidth < 768){
                this.perPage = 15
            }
        }          
    },
    components:{
        appPaginator: paginator
    },
    mounted(){
        if(this.getCategoryImages.length == 1){
            const app = this;
            axios.get('/get/gategory-images').then(function(response){
                app.setCategoryImages(response.data.images);
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
    },      
}
</script>
<style scoped>

</style>