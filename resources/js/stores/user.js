export default {
    namespaced: true,
    state: {
        is_logged: false,
        userInfo: {
            first_name: '',
            last_name: '',
            email: '',
            image_url: ''
        },
        recentImages: [{
            id: 1,
            url: 'https://images.unsplash.com/photo-1453831362806-3d5577f014a4?ixlib=rb-1.2.1&q=85&fm=jpg&crop=entropy&cs=srgb&w=1600&fit=max&ixid=eyJhcHBfaWQiOjE0NTg5fQ',
            name: 'car'
        }],
        downloadedImages: [{
            id: 1,
            url: 'https://images.unsplash.com/photo-1453831362806-3d5577f014a4?ixlib=rb-1.2.1&q=85&fm=jpg&crop=entropy&cs=srgb&w=1600&fit=max&ixid=eyJhcHBfaWQiOjE0NTg5fQ',
            name: 'car'
        }],
    },
    mutations: {
        setAuthStatus(state, data) {
            state.is_logged = data;
        },
        setRecentImages(state, data) {
            state.recentImages = data;
        },
        setDownloadedImages(state, data) {
            state.downloadedImages = data;
        },
        setUserInfo(state, data) {
            state.userInfo = data;
        },
    },
    actions: {
        setAuthStatus(context, data) {
            context.commit('setAuthStatus', data);
        },
        setRecentImages(context, data) {
            context.commit('setRecentImages', data);
        },
        setDownloadedImages(context, data) {
            context.commit('setDownloadedImages', data);
        },
        setUserInfo(context, data) {
            context.commit('setUserInfo', data);
        },
    },
    getters: {
        getAuthStatus: (state) => {
            return state.is_logged
        },
        getUserInfo: (state) => {
            return state.userInfo
        },
        getRecentImages: (state) => {
            return state.recentImages
        },
        getDownloadedImages: (state) => {
            return state.downloadedImages
        },
    }
}