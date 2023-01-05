<template>
    <div class="main-wrapper">
        <app-header type='1'></app-header>
        <home-content></home-content>
        <app-footer :visibleCategory='false'></app-footer>
    </div>
</template>
<script>
    import HomeContent from '@/js/components/home/HomeContent';
    export default {
        components:{
            homeContent: HomeContent
        },
        mounted(){
            document.body.scrollTop = 0; // For Safari
            document.documentElement.scrollTop = 0; // For Chrome, Firefox, IE            
        }   
    }
</script>
<style scoped>

</style>