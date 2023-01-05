<template>
    <div class="search main-search"
        :style="'background:url('+ search_bg +') center center no-repeat'">
        <div class="title text-capitalize text-center text-white">{{ $t('search_title') }}</div>
        <div class="search-form">
            <div class="search-input">
                <input type="text" @input="searchImage" v-on:keyup.enter="searchImage" class="form-custom-control" v-model="name" placeholder="Search icons">
                <span class="spinner-border spinner-border-sm text-success" :class="isSearching ? '' : 'invisible'"></span>
                <span class="fas fa-search text-white search-icon"></span>
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
        <div class="sub-title text-center text-white">{{ $t('search_sub_title') }}</div>
    </div>    
</template>
<script>
import search_bg from '@/js/assets/images/search_bg.jpg';
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
    methods:{
        searchImage(){
            const app = this;
            app.isSearching = true;
            console.log(this.$i18n.locale)
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
    }    
}
</script>
<style scoped>

</style>