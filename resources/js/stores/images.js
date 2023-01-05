export default {
    namespaced: true,
    state: {
        mostDownloadedImages: [],
        categoryImages: [],
        categoryGallery: [],
        relatedKeys: [],
        similarImages: [],
    },
    mutations: {
        setMostDownloadedImages(state, data) {
            state.mostDownloadedImages = data;
        },
        setCategoryImages(state, data) {
            state.categoryImages = data;
        },
        setCategoryGallery(state, data) {
            state.categoryGallery = data;
        },
        setRelatedKeys(state, data) {
            state.relatedKeys = data;
        },
        setSimilarImages(state, data) {
            state.similarImages = data;
        },

    },
    actions: {
        setMostDownloadedImages(context, data) {
            context.commit('setMostDownloadedImages', data);
        },
        setCategoryImages(context, data) {
            context.commit('setCategoryImages', data);
        },
        setCategoryGallery(context, data) {
            context.commit('setCategoryGallery', data);
        },
        setRelatedKeys(context, data) {
            context.commit('setRelatedKeys', data);
        },
        setSimilarImages(context, data) {
            context.commit('setSimilarImages', data);
        },
    },
    getters: {
        getMostDownloadedImages: (state) => {
            return state.mostDownloadedImages
        },
        getCategoryImages: (state) => {
            return state.categoryImages
        },
        getCategoryGalleryById: (state) => (categoryId) => {
            return state.categoryGallery[categoryId];
        },
        getCategoryGallery: (state) => {
            return state.categoryGallery;
        },
        getCategoryNameById: (state) => (categoryId, locale) => {
            if (state.categoryImages.length == 0) {
                return ''
            }
            if (locale == 'en') {
                return state.categoryImages.find(item => item.id == categoryId).name;
            } else if (locale == 'sp')
                return state.categoryImages.find(item => item.id == categoryId).name_sp;
            else if (locale == 'pt')
                return state.categoryImages.find(item => item.id == categoryId).name_pt;
            else if (locale == 'fr')
                return state.categoryImages.find(item => item.id == categoryId).name_fr;
            else if (locale == 'du')
                return state.categoryImages.find(item => item.id == categoryId).name_du;
            else(locale == 'it')
            return state.categoryImages.find(item => item.id == categoryId).name_it;

        },
        getImageUrlByImageId: (state) => (imageId) => {
            if (state.categoryGallery.find(item => item.id == imageId) == undefined) {
                return 'ddd'
            }
            return state.categoryGallery.find(item => item.id == imageId).url;
        },
        getImageNameByImageId: (state) => (imageId, locale) => {
            if (state.categoryGallery.find(item => item.id == imageId) == undefined) {
                return 'empty'
            }
            if (locale == 'en') {
                return state.categoryGallery.find(item => item.id == imageId).name;
            } else if (locale == 'sp')
                return state.categoryGallery.find(item => item.id == imageId).name_sp;
            else if (locale == 'pt')
                return state.categoryGallery.find(item => item.id == imageId).name_pt;
            else if (locale == 'fr')
                return state.categoryGallery.find(item => item.id == imageId).name_fr;
            else if (locale == 'du')
                return state.categoryGallery.find(item => item.id == imageId).name_du;
            else(locale == 'it')
            return state.categoryGallery.find(item => item.id == imageId).name_it;
        },
        getRelatedKeys: (state) => {
            return state.relatedKeys;
        },
        getSimilarImages: (state) => {
            return state.similarImages;
        }
    }
}