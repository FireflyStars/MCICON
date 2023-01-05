<template>
    <div class="main-wrapper">
        <app-header type="2"></app-header>
        <div class="content-wrapper">
            <div id="price" class="pt-4 pb-4 description" v-html="getPrice($i18n.locale)">

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
            getPrice: 'desc/getPrice'
        })
    },
    methods:{
        ...mapActions({
            setPrice: 'desc/setPrice'
        })
    },    
    mounted(){
        document.body.scrollTop = 0; // For Safari
        document.documentElement.scrollTop = 0; // For Chrome, Firefox, IE            
        const app = this;
        if(this.getPrice(this.$i18n.locale) == ''){
            axios.get('/get/price').then(function(response){
                app.setPrice(response.data.content);
            }).catch(function(errors){
                console.log(errors);
            })
        }        
    }    
}
</script>
<style scoped>

</style>