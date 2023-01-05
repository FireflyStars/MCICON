<template>
    <header class="header">
        <div class="top-navbar">
            <router-link class="logo" :to="'/'" 
            :style="'background: url(' + logo + ') no-repeat left center'">
            </router-link>
            <ul class="nav-menu mt-auto">
                <li class="menu-item text-capitalize pc-only"> <router-link :to="'/contact-us'">{{ $t('contact_us') }}</router-link></li>
                <li class="menu-item text-capitalize language-menu">
                    <div class="dropdown">
                        <a href="javascript::void(0)" class="dropdown-toggle" data-toggle="dropdown">
                            <span class="flag mr-1" :style="'background:url(' + currentLang.flag + ') no-repeat center center'"></span>
                        </a>
                        <div class="dropdown-menu dropdown-menu-right">
                            <a class="dropdown-item" href="javascript::void()"
                                :class="currentLang.code == lang.code ? 'active': ''"
                                v-for="(lang, index) in langs" :key="index"
                                @click="changLang(lang)">
                                <span class="flag mr-2" :style="'background:url(' + lang.flag + ') no-repeat center center'"></span>
                                 {{ lang.name }}</a>
                        </div>
                    </div>
                </li>
                <li class="menu-item text-capitalize"><router-link class="btn btn-orange" :to="'/login'">{{ $t('login') }}</router-link></li>
                <li class="menu-item text-capitalize"><router-link class="btn btn-orange" :to="'/register'">{{ $t('signup') }}</router-link></li>
            </ul>
        </div>
        <app-search v-if="type == 1"></app-search>
        <app-common-search v-if="type != 1"></app-common-search>
    </header>
</template>
<script>
import logo from '@/js/assets/images/logo.svg';
import uk_flag from '@/js/assets/images/flags/uk.svg'
import pt_flag from '@/js/assets/images/flags/pt.svg'
import fr_flag from '@/js/assets/images/flags/fr.svg'
import it_flag from '@/js/assets/images/flags/it.svg'
import sp_flag from '@/js/assets/images/flags/sp.svg'
import du_flag from '@/js/assets/images/flags/du.svg'
import search from './search';
import commonSearch from './common-search';

export default {
    props:['type'],
    data(){
        return {
            logo,
            langs: [
                {
                    name: 'Português',
                    flag: pt_flag,
                    code: 'pt'
                },
                {
                    name: 'Dutch',
                    flag: du_flag,
                    code: 'du'
                },
                {
                    name: 'English',
                    flag: uk_flag,
                    code: 'en'
                },
                {
                    name: 'Español',
                    flag: sp_flag,
                    code: 'sp'
                },
                {
                    name: 'Français',
                    flag: fr_flag,
                    code: 'fr'
                },
                {
                    name: 'Italiano',
                    flag: it_flag,
                    code: 'it'
                },
            ],
            currentLang: {
                flag: uk_flag,
                code: 'en'
            }
        }
    },
    components:{
        appSearch: search,
        appCommonSearch: commonSearch
    },
    methods:{
        changLang(lang){
            this.currentLang.flag = lang.flag;
            this.currentLang.code = lang.code;
            this.$i18n.locale = lang.code;
        }
    },
    mounted(){
    }

}
</script>
<style scoped>

</style>