import './bootstrap';
import {createApp} from 'vue'

import App from './App.vue'
// import '../assets/css/common.css'
import router from './routes/router.js';

/* import the fontawesome core */
import { library } from '@fortawesome/fontawesome-svg-core'

/* import font awesome icon component */
import { FontAwesomeIcon } from '@fortawesome/vue-fontawesome'

/* import specific icons */
import { faChartBar, faChartColumn, faChartGantt, faDesktop, faHome, faLayerGroup, faNetworkWired, faPaperclip, faPenToSquare, faPlus, faRectangleList, faTable, faUser, faUserSecret } from '@fortawesome/free-solid-svg-icons'

/* add icons to the library */
library.add(faUserSecret, faHome, 
    faTable, faChartColumn, faLayerGroup, faPaperclip, faPlus, faNetworkWired, faChartGantt, faUser)

createApp(App).component('font-awesome-icon', FontAwesomeIcon).use(router).mount("#app")
