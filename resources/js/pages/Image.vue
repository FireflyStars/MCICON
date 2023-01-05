<template>
    <div class="main-wrapper">
        <app-header type='2'></app-header>
        <app-image-content :id="id"></app-image-content>
        <app-footer :visibleCategory='true'></app-footer>
    </div>    
</template>
<script>
    import imageContent from '@/js/components/image/ImageContent';
export default {
    props:['id'],
    components:{
        appImageContent: imageContent
    },
    mounted(){
        document.body.scrollTop = 0; // For Safari
        document.documentElement.scrollTop = 0; // For Chrome, Firefox, IE            
    }           
}
</script>
<style scoped>

</style>