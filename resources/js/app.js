import './bootstrap';
import {createApp} from 'vue'

import App from './App.vue'
import '../assets/css/common.css'
import router from './routes/router.js';
import store from '../src/store/store.js';



/* import the fontawesome core */
import { library } from '@fortawesome/fontawesome-svg-core'

/* import font awesome icon component */
import { FontAwesomeIcon } from '@fortawesome/vue-fontawesome'

/* import specific icons */
import { faBell, faSearch, faChartBar, faChartColumn, faChartGantt, faChevronDown, faDesktop, faHome, faLayerGroup, faMagnifyingGlass, faMessage, faNetworkWired, faPaperclip, faPenToSquare, faPersonCircleQuestion, faPlus, faRectangleList, faTable, faUser, faUserCheck, faUserSecret, faXmark, faGears, faGear, faEnvelope, faRightFromBracket, faChevronUp, faChevronLeft } from '@fortawesome/free-solid-svg-icons'

/* add icons to the library */
library.add(faUserSecret, faHome, faNetworkWired, faChartGantt, faUser, faXmark, faMagnifyingGlass, faGear, faEnvelope, faRightFromBracket,faChevronLeft,
    faTable, faChartColumn, faSearch, faLayerGroup, faPaperclip, faPlus, faPersonCircleQuestion, faUserCheck, faMessage, faBell, faChevronDown )

    // Vuetify
//     import '@mdi/font/css/materialdesignicons.css'
//     import 'vuetify/styles'
//     import { createVuetify } from 'vuetify'
//     import * as components from 'vuetify/components'
//     import * as directives from 'vuetify/directives'

// const vuetify = createVuetify({
//     components,
//     directives,
//   })

createApp(App).component('font-awesome-icon', FontAwesomeIcon)
.use(router)
.use(store)
// .use(vuetify)
.mount("#app")

