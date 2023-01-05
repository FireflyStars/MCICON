import Vue from 'vue';
import Vuex from 'vuex';
import user from './user';
import description from './description';
import images from './images';

Vue.use(Vuex);
export default new Vuex.Store({
    modules: {
        user: user,
        desc: description,
        image: images,
    }
})