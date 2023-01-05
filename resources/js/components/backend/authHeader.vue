<template>
    <header class="auth-header">
        <nav class="auth-header-menu border-bottom">
            <router-link class="logo d-block" :to="'/'" 
            :style="'background: url(' + logo + ') no-repeat left center'">
            </router-link>   
            <ul class="nav-menu mt-auto">
                <li class="menu-item text-capitalize">
                    <div class="burger" :class="leftSideFlag ? 'show' : ''" @click="showSideBar">
                        <span></span>
                        <span></span>
                        <span></span>
                    </div>                    
                </li>                
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
                <li class="menu-item">
                    <div class="dropdown">
                        <a href="javascript::void(0)" class="dropdown-toggle text-capitalize" data-toggle="dropdown">
                           <i class="fas fa-user"></i> my account
                        </a>
                        <div class="dropdown-menu dropdown-menu-left">
                            <router-link :to="'/account/dashboard'" class="dropdown-item"
                                >
                               <i class="fas fa-cog"></i> setting
                            </router-link>                                 
                            <a class="dropdown-item" href="javascript:void()"
                                @click="logout">
                                <i class="fas fa-sign-out-alt"></i>  logout
                            </a>                                 
                            
                        </div>
                    </div>
                </li>
            </ul>         
        </nav>
    </header>
</template>
<script>
import logo from '@/js/assets/images/logo.svg';
import { mapGetters, mapActions } from 'vuex';
import axios from 'axios';
import uk_flag from '@/js/assets/images/flags/uk.svg'
import pt_flag from '@/js/assets/images/flags/pt.svg'
import fr_flag from '@/js/assets/images/flags/fr.svg'
import it_flag from '@/js/assets/images/flags/it.svg'
import sp_flag from '@/js/assets/images/flags/sp.svg'
import du_flag from '@/js/assets/images/flags/du.svg'
export default {
    data(){
        return{
            logo,
            leftSideFlag: false,
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
    computed:{
        ...mapGetters({
            getAuthStatus: 'user/getAuthStatus'
        })
    },
    methods:{
        ...mapActions({
            setAuthStatus: 'user/setAuthStatus'
        }),
        changLang(lang){
            this.currentLang.flag = lang.flag;
            this.currentLang.code = lang.code;
            this.$i18n.locale = lang.code;
        },        
        logout(){
            const app = this;
            let formData = new FormData;
            formData.append('logout', true);
            axios.get('/logout', formData).then(function(response){
                app.setAuthStatus(false)
                localStorage.setItem('is_logged', false);
                app.$router.push('/');
            }).catch(function(errors){
                console.log(errors)
            })
        },
        showSideBar(){
            this.leftSideFlag = ! this.leftSideFlag;
            if (this.leftSideFlag) 
                document.querySelector("#left-side").classList.add('display-block');
            else
                document.querySelector("#left-side").classList.remove('display-block');

        }
    },
    beforeCreate(){
        // const app = this;
        // axios.get('/get-auth-status').then(function(response){
        //     if(response.data.status){
        //         app.setAuthStatus(true);
        //         localStorage.setItem('is_logged', true);
        //     }else{
        //         app.$router.push('/login');
        //     }
        // }).catch(function(errors){
        //     console.log(errors)
        // })
    }    
}
</script>
<style scoped>
.auth-header-menu{
    width: 100%;
    padding: 0 20px;
    height: 60px;
    display: flex;
    align-items: center;
}
.dropdown-menu{
    min-width: 140px !important;
}
</style>