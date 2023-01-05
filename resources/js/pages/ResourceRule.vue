<template>
    <div class="main-wrapper">
        <app-header type="2"></app-header>
        <div class="content-wrapper description" >
            <div id="resource-rule" class="pt-4 pb-4 description" v-html="getResourceRule($i18n.locale)">
                
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
            getResourceRule: 'desc/getResourceRule'
        })
    },
    methods:{
        ...mapActions({
            setResourceRule: 'desc/setResourceRule'
        })
    },      
    mounted(){
        document.body.scrollTop = 0; // For Safari
        document.documentElement.scrollTop = 0; // For Chrome, Firefox, IE            
        const app = this;
        if(this.getResourceRule(this.$i18n.locale) == ''){
            axios.get('/get/resource-rule').then(function(response){
                app.setResourceRule(response.data.content);
            }).catch(function(errors){
                console.log(errors);
            })
        }        
    }      
}
</script>
<style scoped>

</style>