/* eslint-disable no-new */
import Vue from 'vue';
import App from './App.vue';
import router from './router/index';
import vuetify from './plugins/vuetify';

require('./bootstrap');

new Vue({
    vuetify,
    router,
    el: '#todo-app',
    render: h => h(App),
});
