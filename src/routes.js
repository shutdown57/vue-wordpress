/**
 * Import Components here
*/
import HomeComponent from './components/homeComponent.vue';
import AboutComponent from './components/aboutComponent.vue';
import ContactComponent from './components/contactComponent.vue';
import BlogComponent from './components/blogComponent.vue';
import BlogSingleComponent from './components/blog/blogSingle.vue';
import NotFoundComponent from './components/notFoundComponent.vue';


export default [
    {path: '/', component: HomeComponent , name: 'home'},
    {path: '/about', component: AboutComponent, name: 'about'},
    {path: '/contact', component: ContactComponent, name: 'contact'},
    {path: '/blog', component: BlogComponent, name: 'blog'},
    {path: '/blog/:id', comments: BlogSingleComponent, name: 'blogSingle'},
    {path: '/*', component: NotFoundComponent, name: 'notFound'}
]
