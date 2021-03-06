/**
 * Import Components here
*/
import User from './mixins/user';

import HomeComponent from './components/homeComponent.vue';
import AboutComponent from './components/aboutComponent.vue';
import ContactComponent from './components/contactComponent.vue';
import NotFoundComponent from './components/notFoundComponent.vue';

import RegisterComponent from './components/auth/registerComponent.vue';
import LoginComponent from './components/auth/loginComponent.vue';
import LogoutComponent from './components/auth/logoutComponent.vue';

import UserRequestComponent from './components/user/requestFormComponent.vue';
import UserProfileComponent from './components/user/profileComponent.vue';
import UserSentFormsComponent from './components/user/sentFormsComponent.vue';

import CategoriesComponent from './components/sundries/categoriesComponent.vue';
import CategorySingleComponent from './components/sundries/categorySingleComponent.vue';

import TagsComponent from './components/sundries/tagsComponent.vue';
import TagSingleComponent from './components/sundries/tagSingleComponent.vue';

import ProductsComponent from './components/productsComponent.vue';
import ProductSingleComponent from './components/magnet/productSingleComponent.vue';
import ProductsCurriculumComponent from './components/magnet/curriculumComponent.vue';
import ProductsCalendarComponent from './components/magnet/calendarComponent.vue';
import ProductsWhiteBoardComponent from './components/magnet/whiteBoardComponent.vue';
import ProductsDifferentComponent from './components/magnet/differentComponent.vue';
import ProductsMarkerComponent from './components/magnet/markerComponent.vue';
import ProductsOnCarComponent from './components/magnet/onCarComponent.vue';
import ProductsPictureFrameComponent from './components/magnet/pictureFrameComponent.vue';
import ProductsReligionComponent from './components/magnet/religionComponent.vue';
import ProductsSubscribCardComponent from './components/magnet/subscribCardComponent.vue';
import ProductsVisitCardComponent from './components/magnet/visitCardComponent.vue';

import BlogComponent from './components/blogComponent.vue';
import BlogSingleComponent from './components/blog/blogSingleComponent.vue';
import BlogAllComponent from './components/blog/blogAllComponent.vue';


export default [
    { path: '/', component: HomeComponent , name: 'home' },
    { path: '/about', component: AboutComponent, name: 'about' },
    { path: '/contact', component: ContactComponent, name: 'contact' },

    { path: '/register', component: RegisterComponent, name: 'register' },
    { path: '/login', component: LoginComponent, name:'login' },
    { path: '/logout', component: LogoutComponent, name: 'logout' },

    { path: '/users/request', component: UserRequestComponent, name: 'requestForm' },
    { path: '/users/profile', component: UserProfileComponent, name: 'profile' },
    { path: '/users/sentForms', component: UserSentFormsComponent, name: 'sentForms' },

    { path: '/categories/:cid', component: CategorySingleComponent, name: 'categorySingle' },
    { path: '/categories', component: CategoriesComponent, name: 'categories' },

    { path: '/tags/:tid', component: TagSingleComponent, name: 'tagSingle' },
    { path: '/tags', component: TagsComponent, name: 'tags' },

    { path: '/blog', component: BlogAllComponent, name: 'blog' },
    { path: '/blog/:pid', component: BlogSingleComponent, name: 'blogSingle' },

    { path: '/products/curriculum', component: ProductsCurriculumComponent, name: 'curriculum' },
    { path: '/products/calendar', component: ProductsCalendarComponent, name: 'calendar' },
    { path: '/products/white-board', component: ProductsWhiteBoardComponent, name: 'whiteBoard' },
    { path: '/products/different', component: ProductsDifferentComponent, name: 'different' },
    { path: '/products/marker', component: ProductsMarkerComponent, name: 'marker' },
    { path: '/products/on-car', component: ProductsOnCarComponent, name: 'onCar' },
    { path: '/products/picture-frame', component: ProductsPictureFrameComponent, name: 'pictureFrame' },
    { path: '/products/religion', component: ProductsReligionComponent, name: 'religion' },
    { path: '/products/subscrib-card', component: ProductsSubscribCardComponent, name: 'subscribCard' },
    { path: '/products/visit-card', component: ProductsVisitCardComponent, name: 'visitCard' },
    { path: '/products/:id', component: ProductSingleComponent, name: 'productSingle' },
    { path: '/products', component: ProductsComponent, name: 'products' },

    { path: '/404', component: NotFoundComponent, name: 'notFound' }
];