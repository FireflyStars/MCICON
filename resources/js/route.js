import Vue from 'vue';
import VueRouter from 'vue-router';
import Home from '@/js/pages/Home';
import AboutUs from '@/js/pages/AboutUs';
import ContactUs from '@/js/pages/ContactUs';
import Category from '@/js/pages/Category';
import Image from '@/js/pages/Image';
import Privacy from '@/js/pages/PrivacyPolicy';
import Price from '@/js/pages/Price';
import PWDRecoveryEmail from '@/js/pages/PRPEmail';
import PWDReset from '@/js/pages/PRPReset';
import ResourceRule from '@/js/pages/ResourceRule';
import Login from '@/js/pages/Login';
import SignUp from '@/js/pages/SignUp';
import VerifyResend from '@/js/pages/VerifyEmailReSend';
import Verify from '@/js/pages/Verify';

import Dashboard from '@/js/pages/backend/Dashboard';
import DownloadHistory from '@/js/pages/backend/DownloadHistory';
// import store from '@/js/stores/index';

Vue.use(VueRouter);

const router = new VueRouter({
    mode: 'history',
    routes: [{
            path: '/',
            name: 'home',
            component: Home
        },
        {
            path: '/about-us',
            name: 'about',
            component: AboutUs
        },
        {
            path: '/contact-us',
            name: 'contact',
            component: ContactUs
        },
        {
            path: '/category/:id',
            name: 'category',
            props: true,
            component: Category
        },
        {
            path: '/image/:id',
            name: 'image',
            props: true,
            component: Image
        },
        {
            path: '/privacy-policy',
            name: 'privacy',
            component: Privacy
        },
        {
            path: '/price',
            name: 'price',
            component: Price
        },
        {
            path: '/password/recovery',
            name: 'pwdrecovery',
            component: PWDRecoveryEmail
        },
        {
            path: '/password/reset/:token',
            name: 'pwdreset',
            component: PWDReset,
            props: true,
        },
        {
            path: '/resource/rule',
            name: 'resourcerule',
            component: ResourceRule
        },
        {
            path: '/login',
            name: 'login',
            component: Login
        },
        {
            path: '/register',
            name: 'register',
            component: SignUp
        },
        {
            path: '/verify',
            name: 'verifyresend',
            component: VerifyResend
        },
        {
            path: '/verify/:token',
            name: 'verify',
            component: Verify,
            props: true
        },
        {
            path: '/account/dashboard',
            name: 'dashboard',
            component: Dashboard,
            beforeEnter: (to, from, next) => {
                if (localStorage.getItem('is_logged')) {
                    next();
                } else next({ path: '/login' });
            }
        },
        {
            path: '/account/download-history',
            name: 'downloadhistory',
            component: DownloadHistory,
            beforeEnter: (to, from, next) => {
                if (localStorage.getItem('is_logged')) {
                    next();
                } else next({ path: '/login' });
            }
        }
    ]
});

export default router;