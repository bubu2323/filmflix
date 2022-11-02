
import './bootstrap';
import { createApp } from 'vue';


const app = createApp({});

import RootComponent from './components/RootComponent.vue';
app.component('example-component', RootComponent);
import ProfileComponent from './components/ProfileImageComponent.vue'
app.component('profile-image-component', ProfileComponent)

// import WelcomeMainComponent from './components/WelcomeMainComponent.vue';
// app.component('welcome-main-component', WelcomeMainComponent);







Object.entries(import.meta.glob('./**/*.vue', { eager: true })).forEach(([path, definition]) => {
    app.component(path.split('/').pop().replace(/\.\w+$/, ''), definition.default);
});



app.mount('#app');
