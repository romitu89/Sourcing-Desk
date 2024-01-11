import './bootstrap';
import {createApp} from 'vue'

import App from './App.vue'

/* import the fontawesome core */
import { library } from '@fortawesome/fontawesome-svg-core'

/* import font awesome icon component */
import { FontAwesomeIcon } from '@fortawesome/vue-fontawesome'

/* import specific icons */
import { faChartBar, faChartColumn, faDesktop, faHome, faLayerGroup, faNetworkWired, faPaperclip, faPenToSquare, faPlus, faRectangleList, faTable, faUser, faUserSecret } from '@fortawesome/free-solid-svg-icons'

/* add icons to the library */
library.add(faUserSecret, faDesktop, faHome, faPenToSquare, 
    faTable, faChartColumn, faLayerGroup, faPaperclip, faPlus, faNetworkWired)

createApp(App).component('font-awesome-icon', FontAwesomeIcon).mount("#app")
