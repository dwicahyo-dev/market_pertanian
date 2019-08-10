
/**
 * First we will load all of this project's JavaScript dependencies which
 * includes Vue and other libraries. It is a great starting point when
 * building robust, powerful web applications using Vue and Laravel.
 */

require('./bootstrap');

window.Vue = require('vue');
import VueCurrencyFilter from 'vue-currency-filter'




/**
 * The following block of code may be used to automatically register your
 * Vue components. It will recursively scan this directory for the Vue
 * components and automatically register them with their "basename".
 *
 * Eg. ./components/ExampleComponent.vue -> <example-component></example-component>
 */

// const files = require.context('./', true, /\.vue$/i)
// files.keys().map(key => Vue.component(key.split('/').pop().split('.')[0], files(key).default))

Vue.component('example-component', require('./components/ExampleComponent.vue').default);
Vue.component('notification-component', require('./components/NotificationsComponent.vue').default);
// Vue.component('carts-component', require('./components/CartsComponent.vue').default);
// Vue.component('cart-component', require('./components/CartComponent.vue').default);
// Vue.component('cart-total-component', require('./components/CartTotalComponent.vue').default);
Vue.component('checkout-component', require('./components/CheckoutComponent.vue').default);

import VueSweetalert2 from 'vue-sweetalert2';
 
Vue.use(VueSweetalert2);

Vue.use(VueCurrencyFilter,
    {
        symbol : 'Rp.',
        thousandsSeparator: '.',
        fractionCount: 0,
        fractionSeparator: ',',
        symbolPosition: 'front',
        symbolSpacing: true
    });

/**
 * Next, we will create a fresh Vue application instance and attach it to
 * the page. Then, you may begin adding components to this application
 * or customize the JavaScript scaffolding to fit your unique needs.
 */

const app = new Vue({
    el: '#app'
});
