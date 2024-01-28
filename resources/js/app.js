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
import { faChartBar, faChartColumn, faChartGantt, faDesktop, faHome, faLayerGroup, faNetworkWired, faPaperclip, faPenToSquare, faPlus, faRectangleList, faTable, faUser, faUserSecret, faXmark } from '@fortawesome/free-solid-svg-icons'

/* add icons to the library */
library.add(faUserSecret, faHome, 
    faTable, faChartColumn, faLayerGroup, faPaperclip, faPlus, faNetworkWired, faChartGantt, faUser, faXmark)

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
// .use(vuetify)
.mount("#app")
