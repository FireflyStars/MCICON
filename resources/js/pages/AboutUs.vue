<template>
    <div class="main-wrapper">
        <app-header type="2"></app-header>
        <div class="content-wrapper">
            <div id="privacy-policy" class="pt-4 pb-4 description" v-html="getAboutUs($i18n.locale)">

            </div>
        </div>
        <app-footer :visibleCategory="true"></app-footer>
    </div>    
</template>
<script>
import { mapActions, mapGetters } from 'vuex';
import axios from 'axios';
export default {
    computed:{
        ...mapGetters({
            getAboutUs: 'desc/getAboutUs'
        })
    },
    methods:{
        ...mapActions({
            setAboutUs: 'desc/setAboutUs'
        })
    },
    mounted(){
        document.body.scrollTop = 0; // For Safari
        document.documentElement.scrollTop = 0; // For Chrome, Firefox, IE            
        const app = this;
        if(this.getAboutUs(this.$i18n.locale) == ''){
            axios.get('/get/about-us').then(function(response){
                app.setAboutUs(response.data.content);
            }).catch(function(errors){
                console.log(errors);
            })
        }
    }    
}
</script>
<style scoped>

</style>