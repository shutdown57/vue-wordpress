/**
 * Import Components here
*/
import HomeComponent from './components/homeComponent.vue';
import AboutComponent from './components/aboutComponent.vue';
import ContactComponent from './components/contactComponent.vue';

import ProductsComponent from './components/productsComponent.vue';
import ProductsCurriculumComponent from './components/magnet/curriculumComponent.vue';
import ProductsCalendarComponent from './components/magnet/calendarComponent.vue';
import ProductsWhiteBoardComponent from './components/magnet/whiteBoardComponent.vue';

import BlogComponent from './components/blogComponent.vue';
import BlogSingleComponent from './components/blog/blogSingleComponent.vue';
import BlogAllComponent from './components/blog/blogAllComponent.vue';

import NotFoundComponent from './components/notFoundComponent.vue';


export default [
    { path: '/', component: HomeComponent , name: 'home' },
    { path: '/about', component: AboutComponent, name: 'about' },
    { path: '/contact', component: ContactComponent, name: 'contact' },

    { path: '/blog', component: BlogAllComponent, name: 'blog' },
    { path: '/blog/:pid', component: BlogSingleComponent, name: 'blogSingle' },
    
    { path: '/products/curriculum', component: ProductsCurriculumComponent, name: 'curriculum' },
    { path: '/products/calendar', component: ProductsCalendarComponent, name: 'calendar' },
    { path: '/products/white-board', component: ProductsWhiteBoardComponent, name: 'whiteBoard' },
    { path: '/products', component: ProductsComponent, name: 'products' },
    
    { path: '/404', component: NotFoundComponent, name: 'notFound' }
];