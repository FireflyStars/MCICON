import Vue from 'vue';

import VueI18n from 'vue-i18n';

Vue.use(VueI18n);
const messages = {
    'en': {
        contact_us: 'Contat Us',
        login: 'Log In',
        signup: 'sign up',
        verify: 'Please Verification Your Email',
        verify_email_content: 'We have already sent verification email to your account. please check your email. if you dont receive the email, please click resend email',
        resend: 'resend',
        verified: 'Successfully Verified',
        verified_content: 'you will be redirected to dashboard in 5 seconds',
        categories: 'Categories',
        search_title: 'thousands of free icons',
        search_sub_title: 'Search and download more than 1000,000 icons for free',
        full_licence: 'Full licence',
        full_licence_content: 'Forget about having to attribute an illustration with a Premium Subscription. use any illustration either for commercial or personal use withour crediting the author.',
        exclusive_content: 'Exclusive content',
        exclusive_content_content: 'You are a VIP member now.Gain access to our exclusive icons which only Premium Members can download for free.',
        continuous_production: 'Continuous production',
        continuous_production_content: 'At Flaticon we are constantly increasing our content available to our users offering the best quality icons in SVG, EPS, PSD and PNG',
        no_ads: 'No ads',
        no_ads_content: 'Browsing Flaticon just got easier.You can fully focus on your work without any ads.',
        cate_list_title: 'Browse image categories',
        // paginator
        next_page: 'Next page',
        previous_page: 'Previous page',
        goto_page: 'Go to page',

        next: 'Next',
        previous: 'Previous',
        goto: 'Goto',

        // footer part
        our_company: 'Our Company',
        home: 'Home',
        terms_of_use: 'Terms Of Use',
        support_center: 'Support Center',
        privacy_police: 'Privacy police',
        pricing: 'Pricing',
        popular_search: 'Popular Search',
        all_categories: 'All Categories',
        // image page
        create_your_free_account: 'Create your free account',
        already_have_an_account: 'Aready have an account?',
        remember_you_have_to_credit_the_author: 'Hey! Remember you have to credit the author',
        copy_the_following_link_into_the_website: "Copy the following link into the website you'll use this resource on if you want to know more, read the",
        attribution_guide: 'Attribution Guide',
        download: 'Download',
        i_agree_to: 'I agree to',
        website_terms: 'website terms',
        licecing_terms: 'Licecing terms',
        and: 'and',
        related_keywords: 'Related keywords',
        show_less: 'show less',
        show_all: 'show all',
        similar_images: 'Similar images',
        // dashboard
        dashboard: 'dashboard',
        downloads_history: 'downloads history',
        my_account: 'my account',
        setting: 'setting',
        logout: 'logout',
        update_profile_photo: 'Update Profile Photo',
        update_profile_photo: 'Update Profile Photo',
        first_name: 'First Name',
        last_name: 'Last Name',
        email_address: 'Email address',
        save_changes: 'Save Changes',
        recent_viewed_images: 'recent viewed images(last 30 days)',
        your_downloads: 'your downloads',
        read_more: 'read more',
        id: 'id',
        date: 'date',
        licence_type: 'licence type',
        re_download: 're-download',
        // login page
        forget_your_password: 'Forget your password',
        submit: 'submit',
        // password recovery page
        password_recovery: 'Password recovery',
        password_recovery_desc: 'Enter your email here and we will send a temporary password to it',
        successfully_send: 'Successfully Sended',
        successfully_send_desc: 'Please check your mail box.',
        // change password
        reset_password: 'Reset Your Passowrd',
        // register page
        register: 'register',
        // contact us page
        your_full_name: 'your full name',
        your_question_may_already_be_answered_in: 'your question may already be answered in',
        frequently_asked_questions: 'Frequently Asked Questions',
        how_can_we_help_you: 'how can we help you',
    },
    'pt': {

    },
    'sp': {

    },
    'fr': {

    },
    'du': {

    },
    'it': {

    },
};
const i18n = new VueI18n({
    locale: 'en', // set locale
    fallbackLocale: 'en', // set fallback locale
    messages, // set locale messages
});

export default i18n;