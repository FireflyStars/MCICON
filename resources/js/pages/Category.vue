<template>
    <div class="main-wrapper">
        <app-header type='2'></app-header>
        <app-cate-content :id="id"></app-cate-content>
        <app-footer :visibleCategory='true'></app-footer>
    </div>    
</template>
<script>
    import cateContent from '@/js/components/category/CategoryContent';
export default {
    props:['id'],
    components:{
        appCateContent: cateContent
    },
    mounted(){
        document.body.scrollTop = 0; // For Safari
        document.documentElement.scrollTop = 0; // For Chrome, Firefox, IE            
    }           
}
</script>
<style scoped>

</style>