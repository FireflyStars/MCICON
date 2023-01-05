<template>
    <ul class="pagination mt-4">
        <li class="pagination-item">
            <button
                type="button"
                class="btn btn-orange btn-previous"
                @click="onClickPreviousPage"
                :disabled="isInFirstPage"
            >
                {{ $t('previous_page') }}
            </button>
        </li>

        <li class="pagination-item d-flex justify-center align-items-center">
            {{ currentPage }}
        </li>

        <li class="pagination-item">
            <button
                type="button"
                class="btn btn-orange btn-next"
                @click="onClickNextPage"
                :disabled="isInLastPage"
            >
                {{ $t('next_page') }}
            </button>
        </li>
        <li class="pagination-item">
            <input type="text" class="input-val" v-model="gotoPage">
        </li>
        <li class="pagination-item">
            <button
                type="button"
                class="btn btn-orange"
                @click="onClickGotoPage"
                :disabled="isInLastPage"
            >
                {{ $t('goto_page') }}
            </button>
        </li>        
    </ul>
</template>
<script>

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
                    return this.totalPages - this.maxVisibleButtons;
                }
                // When in between
                return this.currentPage - 1;
            },
            pages() {
                const range = [];

                for (let i = this.startPage;
                    i <= Math.min(this.startPage + this.maxVisibleButtons - 1, this.totalPages);
                    i+= 1 ) {
                    range.push({
                    name: i,
                    isDisabled: i === this.currentPage
                    });
                }

                return range;
            },
            isInFirstPage() {
                return this.currentPage === 1;
            },
            isInLastPage() {
                return this.currentPage === this.totalPages;
            },            
        },       
        methods: {
            onClickPreviousPage() {
                this.$emit('pagechanged', this.currentPage - 1);
            },
            onClickPage(page) {
                this.$emit('pagechanged', page);
            },
            onClickNextPage() {
                this.$emit('pagechanged', this.currentPage + 1);
            },
            onClickGotoPage() {
                this.$emit('pagechanged', this.currentPage + 1);
            },
            isPageActive(page) {
                return this.currentPage === page;
            },
            handleResize() {
                if(window.innerWidth >= 1024){
                    this.perPage = 48;
                }
                if(window.innerWidth >= 768 && window.innerWidth < 1024){
                    this.perPage = 24;
                }
                if(window.innerWidth < 768){
                    this.perPage = 12
                }
            }                        
        },
        created(){
            window.addEventListener('resize', this.handleResize)
            this.handleResize();
        },
        destroyed() {
            window.removeEventListener('resize', this.handleResize)
        },                         
    };
</script>
<style>

</style>