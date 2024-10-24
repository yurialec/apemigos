import './bootstrap';
import { createApp } from 'vue';
import axios from 'axios';
import store from './store';
import { mask } from 'vue-the-mask'

let token = document.head.querySelector('meta[name="csrf-token"]');
if (token) {
    axios.defaults.headers.common['X-CSRF-TOKEN'] = token.content;
} else {
    console.error('CSRF token not found: https://laravel.com/docs/csrf#csrf-x-csrf-token');
}

axios.defaults.baseURL = 'http://localhost:8000/';
axios.defaults.headers.common['Content-Type'] = 'application/json';
window.axios = axios;

const app = createApp({});
app.directive('mask', mask);

//Theme
import ExampleComponent from './components/ExampleComponent.vue';
import HomeHomeComponent from './components/Admin/Theme/HomeComponent.vue';
import SidebarComponent from './components/Admin/Theme/SidebarComponent.vue';
import HeaderComponent from './components/Admin/Theme/HeaderComponent.vue';
import AlerComponent from './components/Admin/Theme/AlerComponent.vue';

//User
import UsersIndexComponent from './components/Admin/Users/UsersIndexComponent.vue';
import UsersCreateComponent from './components/Admin/Users/UsersCreateComponent.vue';
import UsersEditComponent from './components/Admin/Users/UsersEditComponent.vue';
import UsersProfileComponent from './components/Admin/Users/UsersProfileComponent.vue';

//Role
import RolesIndexComponent from './components/Admin/Roles/RolesIndexComponent.vue';
import RolesCreateComponent from './components/Admin/Roles/RolesCreateComponent.vue';
import RolesEditComponent from './components/Admin/Roles/RolesEditComponent.vue';

//Permissions
import PermissionsIndexComponent from './components/Admin/Permissions/PermissionsIndexComponent.vue';
import PermissionsCreateComponent from './components/Admin/Permissions/PermissionsCreateComponent.vue';
import PermissionsEditComponent from './components/Admin/Permissions/PermissionsEditComponent.vue';

//Menus
import MenusIndexComponent from './components/Admin/Menus/MenusIndexComponent.vue';
import MenusEditComponent from './components/Admin/Menus/MenusEditComponent.vue';
import MenusCreateComponent from './components/Admin/Menus/MenusCreateComponent.vue';


//SITE
//LOGO
import SiteLogoIndexComponent from './components/Site/Logo/SiteLogoIndexComponent.vue';
import SiteLogoCreateComponent from './components/Site/Logo/SiteLogoCreateComponent.vue';
import SiteLogoEditComponent from './components/Site/Logo/SiteLogoEditComponent.vue';

//Carousel
import SiteCarrouselIndexComponent from './components/Site/Carousel/SiteCarrouselIndexComponent.vue';
import SiteCarouselCreateComponent from './components/Site/Carousel/SiteCarouselCreateComponent.vue';
import SiteCarouselEditComponent from './components/Site/Carousel/SiteCarouselEditComponent.vue';

//MAINTEXT
import SiteMainTextIndexComponent from './components/Site/MainText/SiteMainTextIndexComponent.vue';
import SiteMainTextCreateComponent from './components/Site/MainText/SiteMainTextCreateComponent.vue';
import SiteMainTextEditComponent from './components/Site/MainText/SiteMainTextEditComponent.vue';

//SOCIALMEDIA
import SiteSocialMediaIndexComponent from './components/Site/SocialMedia/SiteSocialMediaIndexComponent.vue';
import SiteSocialMediaCreateComponent from './components/Site/SocialMedia/SiteSocialMediaCreateComponent.vue';
import SiteSocialMediaEditComponent from './components/Site/SocialMedia/SiteSocialMediaEditComponent.vue';

//ABOUT
import SiteAboutIndexComponent from './components/Site/About/SiteAboutIndexComponent.vue';
import SiteAboutCreateComponent from './components/Site/About/SiteAboutCreateComponent.vue';
import SiteAboutEditComponent from './components/Site/About/SiteAboutEditComponent.vue';

//CONTACT
import SiteContactIndexComponent from './components/Site/Contact/SiteContactIndexComponent.vue';
import SiteContactCreateComponent from './components/Site/Contact/SiteContactCreateComponent.vue';
import SiteContactEditComponent from './components/Site/Contact/SiteContactEditComponent.vue';

//BLOG
import BlogIndexComponent from './components/Blog/BlogIndexComponent.vue';
import BlogCreateComponent from './components/Blog/BlogCreateComponent.vue';
import BlogEditComponent from './components/Blog/BlogEditComponent.vue';

//Theme
app.component('example-component', ExampleComponent);
app.component('home-component', HomeHomeComponent);
app.component('sidebar-component', SidebarComponent);
app.component('header-component', HeaderComponent);
app.component('alert-component', AlerComponent);

//USERS
app.component('users-index-component', UsersIndexComponent);
app.component('users-create-component', UsersCreateComponent);
app.component('users-profile-component', UsersProfileComponent);
app.component('users-edit-component', UsersEditComponent);

//ROLES
app.component('roles-index-component', RolesIndexComponent);
app.component('roles-create-component', RolesCreateComponent);
app.component('roles-edit-component', RolesEditComponent);

//PERMISSION
app.component('permissions-index-component', PermissionsIndexComponent);
app.component('permissions-create-component', PermissionsCreateComponent);
app.component('permissions-edit-component', PermissionsEditComponent);

//MENUS
app.component('menus-index-component', MenusIndexComponent);
app.component('menus-edit-component', MenusEditComponent);
app.component('menus-create-component', MenusCreateComponent);


//SITE
//LOGOTIPO
app.component('site-logo-index-component', SiteLogoIndexComponent);
app.component('site-logo-create-component', SiteLogoCreateComponent);
app.component('site-logo-edit-component', SiteLogoEditComponent);

//CARROUSEL
app.component('site-carousel-index-component', SiteCarrouselIndexComponent);
app.component('site-carousel-create-component', SiteCarouselCreateComponent);
app.component('site-carousel-edit-component', SiteCarouselEditComponent);

//MAINTEXT
app.component('site-main-text-index-component', SiteMainTextIndexComponent);
app.component('site-main-text-create-component', SiteMainTextCreateComponent);
app.component('site-main-text-edit-component', SiteMainTextEditComponent);

//SOCIALMEDIA
app.component('site-socialmedia-index-component', SiteSocialMediaIndexComponent);
app.component('site-socialmedia-create-component', SiteSocialMediaCreateComponent);
app.component('site-socialmedia-edit-component', SiteSocialMediaEditComponent);

//ABOUT
app.component('site-about-index-component', SiteAboutIndexComponent);
app.component('site-about-create-component', SiteAboutCreateComponent);
app.component('site-about-edit-component', SiteAboutEditComponent);

//CONTACT
app.component('site-contact-index-component', SiteContactIndexComponent);
app.component('site-contact-create-component', SiteContactCreateComponent);
app.component('site-contact-edit-component', SiteContactEditComponent);


//BLOG
app.component('blog-index-component', BlogIndexComponent);
app.component('blog-create-component', BlogCreateComponent);
app.component('blog-edit-component', BlogEditComponent);

app.use(store);
app.mount('#app');
