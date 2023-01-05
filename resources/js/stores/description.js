export default {
    namespaced: true,
    state: {
        privacy: {
            en: '',
            sp: '',
            pt: '',
            fr: '',
            du: '',
            it: '',
        },
        price: {
            en: '',
            sp: '',
            pt: '',
            fr: '',
            du: '',
            it: '',
        },
        aboutus: {
            en: '',
            sp: '',
            pt: '',
            fr: '',
            du: '',
            it: '',
        },
        resourceRule: {
            en: '',
            sp: '',
            pt: '',
            fr: '',
            du: '',
            it: '',
        },
    },
    mutations: {
        setPrivacy(state, data) {
            state.privacy.en = data.content;
            state.privacy.sp = data.content_sp;
            state.privacy.pt = data.content_pt;
            state.privacy.fr = data.content_fr;
            state.privacy.du = data.content_du;
            state.privacy.it = data.content_it;
        },
        setPrice(state, data) {
            state.price.en = data.content;
            state.price.sp = data.content_sp;
            state.price.pt = data.content_pt;
            state.price.fr = data.content_fr;
            state.price.du = data.content_du;
            state.price.it = data.content_it;
        },
        setAboutUs(state, data) {
            state.aboutus.en = data.content;
            state.aboutus.sp = data.content_sp;
            state.aboutus.pt = data.content_pt;
            state.aboutus.fr = data.content_fr;
            state.aboutus.du = data.content_du;
            state.aboutus.it = data.content_it;
        },
        setResourceRule(state, data) {
            state.resourceRule.en = data.content;
            state.resourceRule.sp = data.content_sp;
            state.resourceRule.pt = data.content_pt;
            state.resourceRule.fr = data.content_fr;
            state.resourceRule.du = data.content_du;
            state.resourceRule.it = data.content_it;
        },
    },
    actions: {
        setPrivacy(context, data) {
            context.commit('setPrivacy', data);
        },
        setPrice(context, data) {
            context.commit('setPrice', data);
        },
        setAboutUs(context, data) {
            context.commit('setAboutUs', data);
        },
        setResourceRule(context, data) {
            context.commit('setResourceRule', data);
        },
    },
    getters: {
        getPrivacy: (state) =>
            (locale) => {
                return state.privacy[locale];
            },
        getPrice: (state) =>
            (locale) => {
                return state.price[locale];
            },
        getAboutUs: (state) =>
            (locale) => {
                return state.aboutus[locale];
            },
        getResourceRule: (state) =>
            (locale) => {
                return state.resourceRule[locale];
            },
    }
}