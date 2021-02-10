/**
 * First we will load all of this project's JavaScript dependencies which
 * includes Vue and other libraries. It is a great starting point when
 * building robust, powerful web applications using Vue and Laravel.
 */

require('./bootstrap');

window.Vue = require('vue').default;

import router from './routes.js'
import { BootstrapVue, IconsPlugin } from "bootstrap-vue" //Importing
import Paginate from 'vuejs-paginate'
import { Form, HasError, AlertError } from 'vform';
import Swal from 'sweetalert2';
import VueProgressBar from 'vue-progressbar'

window.Form = Form;

Vue.use(BootstrapVue)
Vue.use(IconsPlugin)

Vue.component('paginate', Paginate);
Vue.component(HasError.name, HasError)
Vue.component(AlertError.name, AlertError)



const Toast = Swal.mixin({
    toast: true,
    position: 'top-end',
    showConfirmButton: false,
    timer: 3000,
    timerProgressBar: true,
    onOpen: (toast) => {
        toast.addEventListener('mouseenter', Swal.stopTimer)
        toast.addEventListener('mouseleave', Swal.resumeTimer)
    }
})
window.Swal = Swal;
window.Toast = Toast;

Vue.use(VueProgressBar, {
    color: 'rgb(143, 255, 199)',
    failedColor: 'red',
    height: '3px'
});

/**
 * Routes imports and assigning
 */

/**
 * The following block of code may be used to automatically register your
 * Vue components. It will recursively scan this directory for the Vue
 * components and automatically register them with their "basename".
 *
 * Eg. ./components/ExampleComponent.vue -> <example-component></example-component>
 */

// const files = require.context('./', true, /\.vue$/i)
// files.keys().map(key => Vue.component(key.split('/').pop().split('.')[0], files(key).default))

Vue.component('app-component', require('./components/AppComponent.vue').default);
Vue.component('produtos', require('./components/ProdutosComponent.vue').default);
Vue.component('produtos-detalhes', require('./components/ProdutosDetalhesComponent.vue').default);
Vue.component('meu-produtos', require('./components/MeusProdutosComponent.vue').default);
Vue.component('favoritos', require('./components/FavoritosComponent.vue').default);
Vue.component('not-found', require('./components/NotFound.vue').default);
Vue.component('menu-component', require('./components/MenuComponent.vue').default);

/**
 * Next, we will create a fresh Vue application instance and attach it to
 * the page. Then, you may begin adding components to this application
 * or customize the JavaScript scaffolding to fit your unique needs.
 */

const app = new Vue({
    el: '#app',
    router
});