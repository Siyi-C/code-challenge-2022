//import router from 'vue-router'
import { createRouter, createWebHistory } from "vue-router";
import HomeView from '@/view/HomeView.vue';
import MediaView from '@/view/MediaLibraryView.vue';
// import Edit from '@/components/Edit.vue';

// Vue.use(router)
const routes = [
    {
        path: '/',
        name:'home',
        component: HomeView
    },

    {
        path: '/media-library',
        name:'media',
        component: MediaView
    },

    // {
    //     path: '/media-library/:id',
    //     name:'ImageEdit',
    //     component: Edit,
    //     props: true
    // },

    // {
    //     path: '/media-library',
    //     name:'popup',
    //     component: popUp
    // }

]

const router = createRouter({
    history: createWebHistory(),
    routes
})

export default router;