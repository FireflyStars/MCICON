<template>
    <div class="search common-search">
        <div class="search-form">
            <div class="search-input">
                <input type="text" @input="searchImage" v-on:keyup.enter="searchImage"  class="form-custom-control" v-model="name" placeholder="Search icons">
                <span class="spinner-border spinner-border-sm text-success" :class="isSearching ? '' : 'invisible'"></span>
                <span class="fas fa-search text-white search-icon"></span>
                <div class="dropdown ml-3">
                    <a href="javascript::void(0)" class="btn btn-orange" data-toggle="dropdown">
                        {{ $t('categories') }}
                    </a>
                    <div class="dropdown-menu dropdown-menu-right cate-dropdown">
                        <div class="sub-title ml-4">{{ $t('cate_list_title') }}</div>
                        <div class="cate-list">
                            <router-link class="dropdown-item" :to="'/category/'+item.id" v-for="(item ,index) in getCategoryImages" :key="index">
                                {{ getCategoryNameById(item.id, $i18n.locale) }}
                            </router-link>
                        </div>
                    </div>
                </div>
            </div>
            <div class="search-results">
                <ul class="searched-image-list">
                    <li v-for="(image, index) in searchedImages" :key="index">
                        <router-link :to="'/image/'+ image.id">
                            {{ image.name }}
                        </router-link>
                    </li>
                </ul>
            </div>            
        </div>
        <ul class="searchedImageList">
            <li v-for="(image, index) in searchedImages" :key="index">
                <router-link :to="'/image/'+ image.id">
                    image.name
                </router-link>
            </li>
        </ul>        
    </div>  
</template>
<script>
import search_bg from '@/js/assets/images/search_bg.jpg';
import { mapActions, mapGetters } from 'vuex'
import axios from 'axios';

export default {
    data(){
        return {
            search_bg,
            searchedImages: [
            ],
            isSearching: false,
            name: null            
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
        }),
        searchImage(){
            const app = this;
            app.isSearching = true;
            let formData = new FormData;
            formData.append('name', app.name);
            formData.append('lang', app.$i18n.locale);
            axios.post('/search', formData).then(function(response){
                app.isSearching = false;
                app.searchedImages = response.data.searched_images;
            }).catch(function(errors){
                console.log(errors);
            })
        }        
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