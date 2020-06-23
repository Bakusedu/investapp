import Vue from 'vue';
import VueRouter from 'vue-router';
import DashboardComponent from './components/DashboardComponent.vue';
import EventManager from './components/EventManager.vue'
import CreateProgramme from './components/PostComponent.vue'
import CreateEvent from './components/event-manager/CreateEvent.vue';
import AddSpeaker from './components/event-manager/AddSpeakerForm.vue';
Vue.use(VueRouter);

let router = new VueRouter({
    mode: "history",
    routes: [{
        path: '/',
        name: 'home',
        meta: {
            guest: true
        }
    },
    {
        path: '/dashboard/programmes',
        name: 'dashboard',
        component: DashboardComponent,
        props: true,
        meta: {
            requiresAuth: true
        }
    },
    {
        path: '/dashboard/hosted',
        name: 'hosted',
        component: DashboardComponent,
        props: true,
        meta: {
            requiresAuth: true
        }
    },
    {
        path: '/dashboard/attended',
        name: 'attended',
        component: DashboardComponent,
        props: true,
        meta: {
            requiresAuth: true
        }
    },
    {
        path: '/events/manager',
        name: 'manager',
        component: EventManager,
        props: true,
        meta: {
            requiresAuth: true
        }
    },
    {
        path: '/create/programme',
        name: 'create',
        component: CreateProgramme,
        props: true,
        meta: {
            requiresAuth: true
        }
    },

    {
        path: '/create/event',
        name: 'addevent',
        component: CreateEvent,
        props: true,
        meta: {
            requiresAuth: true
        }
    },
    {
        path: '/add/speakers',
        name: 'addspeaker',
        component: AddSpeaker,
        props: true,
        meta: {
            requiresAuth: true
        }
    },
]
})

router.beforeEach((to, from, next) => {
    if (to.matched.some(record => record.meta.requiresAuth)) {
        if (!window.Laravel.isLoggedin) {
            console.log('hii')
            next({ name: "home" })
                // if(localStorage.getItem('user_type' === '2001439'))
        } else {
            next()
        }
    }
})

export default router;
