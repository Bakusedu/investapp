require('./bootstrap');

window.Vue = require('vue');
Vue.use(require('vue-moment'));
import Notifications from 'vue-notification'
import ExampleComponent from './components/DashboardComponent.vue';
import PostComponent from './components/PostComponent.vue';
import Facilitator from './components/Facilitator.vue';
import EditProgramme from './components/EditProgramme.vue';
import Manager from './components/EventManager.vue';
import Speaker from './components/event-manager/Speaker';
import Event from './components/event-manager/Event';
import WaitingList from './components/event-manager/WaitingList';
import UserList from './components/event-manager/UserList';
Vue.component('dashboard-component', ExampleComponent);
Vue.component('post-component', PostComponent)
Vue.component('edit-component', EditProgramme)
Vue.component('facilitator-component', Facilitator)
Vue.component('speaker', Speaker)
Vue.component('manager', Manager)
Vue.component('event', Event)
Vue.component('waiting-list',WaitingList)
Vue.component('users-list',UserList)
Vue.use(Notifications)
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
