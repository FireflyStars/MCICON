<template>
    <div class="left-side" id="left-side">
        <ul class="sidebar-menu">
            <li class="sidebar-menu-item text-capitalize p-3" :class="selectedMenu == 'dashboard' ? 'active': ''">
                <router-link :to="'/account/dashboard'">
                    <i class="fas fa-home pr-4"></i> 
                    {{ $t('dashboard') }}
                </router-link>
            </li>
            <li class="sidebar-menu-item text-capitalize p-3" :class="selectedMenu == 'download' ? 'active': ''">
                <router-link :to="'/account/download-history'" class="">
                    <i class="fas fa-download pr-4"></i> 
                    {{ $t('downloads_history') }}
                </router-link>
            </li>
        </ul>
    </div>
</template>
<script>
    export default {
        props: ['selectedMenu']
    }
</script>
<style scoped>

</style>