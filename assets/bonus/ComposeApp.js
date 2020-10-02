import Vue from 'vue'
import App from './Vue/App'
import axios from 'axios'
import VueAxios from 'vue-axios'
import  BootstrapVue  from 'bootstrap-vue'
import 'bootstrap/dist/css/bootstrap.css'
import 'bootstrap-vue/dist/bootstrap-vue.css'
import 'bootstrap/dist/css/bootstrap.min.css';

Vue.config.productionTip = false;


Vue.use(BootstrapVue);
Vue.use(VueAxios, axios);
new Vue({
    render: h => h(App),
}).$mount('#bonus-homepage');