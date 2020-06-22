require('./bootstrap');

window.Vue = require('vue');

import ExampleComponent from './components/DashboardComponent.vue';
import PostComponent from './components/PostComponent.vue';
Vue.component('dashboard-component', ExampleComponent);
Vue.component('post-component', PostComponent)
/**
 * Next, we will create a fresh Vue application instance and attach it to
 * the page. Then, you may begin adding components to this application
 * or customize the JavaScript scaffolding to fit your unique needs.
 */
var filter = function(text, length, clamp){
    clamp = clamp || '...';
    var node = document.createElement('div');
    node.innerHTML = text;
    var content = node.textContent;
    return content.length > length ? content.slice(0, length) + clamp : content;
};

Vue.filter('truncate', filter);

const app = new Vue({
    el: '#app',
});
