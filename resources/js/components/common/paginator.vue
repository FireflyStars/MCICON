<template>
    <ul class="pagination mt-4">
        <li class="pagination-item">
            <button
                type="button"
                class="btn btn-orange btn-previous desktop"
                @click="onClickPreviousPage"
                :disabled="isInFirstPage"
                >
                {{ $t('previous_page') }}
            </button>
            <button
                type="button"
                class="btn btn-orange btn-previous mobile"
                @click="onClickPreviousPage"
                :disabled="isInFirstPage"
                >
                {{ $t('previous') }}
            </button>
        </li>

        <li class="pagination-item d-flex justify-center align-items-center">
            {{ currentPage }}
        </li>

        <li class="pagination-item">
            <button
                type="button"
                class="btn btn-orange btn-next desktop"
                @click="onClickNextPage"
                :disabled="isInLastPage"
            >
                {{ $t('next_page') }}
            </button>
            <button
                type="button"
                class="btn btn-orange btn-next mobile"
                @click="onClickNextPage"
                :disabled="isInLastPage"
            >
                {{ $t('next') }}
            </button>
        </li>
        <li class="pagination-item">
            <input type="text" class="input-val" v-model="gotoPage">
        </li>
        <li class="pagination-item">
            <button
                type="button"
                class="btn btn-orange desktop"
                @click="onClickGotoPage"
                :disabled="isInLastPage"
            >
                {{ $t('goto_page') }}
            </button>
            <button
                type="button"
                class="btn btn-orange mobile"
                @click="onClickGotoPage"
                :disabled="isInLastPage"
            >
                {{ $t('goto') }}
            </button>
        </li>        
    </ul>
</template>
<script>
    import { mapActions } from 'vuex';

    export default {
        props: {
            totalPages: {
            type: Number,
            required: true
            },
            total: {
            type: Number,
            required: true
            },
            currentPage: {
            type: Number,
            required: true
            },
            cateId:{
                type: String,
                required: true
            }
        },
        data(){
            return {
                gotoPage: null,
                perPage: 48
            }
        },
        computed: {
            startPage() {
                // When on the first page
                if (this.currentPage === 1) {
                    return 1;
                }
                // When on the last page
                if (this.currentPage === this.totalPages) {
                    return this.totalPages;
                }
                // When in between
                return this.currentPage - 1;
            },
            isInFirstPage() {
                return this.currentPage === 1;
            },
            isInLastPage() {
                return this.currentPage === this.totalPages;
            },            
        },       
        methods: {
            ...mapActions({
                setCategoryGallery: 'image/setCategoryGallery',
            }),              
            onClickPreviousPage() {
                this.$emit('pagechanged', this.currentPage - 1);
            },
            onClickNextPage() {
                this.$emit('pagechanged', this.currentPage + 1);
            },
            onClickGotoPage() {
                if(parseInt(this.gotoPage) > this.totalPages ){
                    this.$emit('pagechanged', this.totalPages);
                }else{
                    this.$emit('pagechanged', parseInt(this.gotoPage));
                }
            },                      
        },
        mounted(){
            const app = this;
            axios.get('/get/category-gallery/'+this.cateId).then(function(response){
                app.setCategoryGallery(response.data.gallery);
                app.$emit('pagechanged', app.currentPage);
            }).catch(function(errors){
                console.log(errors);
            })
        }           
    };
</script>
<style>

</style>