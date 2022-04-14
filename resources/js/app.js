require('./bootstrap');

import {createApp} from 'vue';
import RollComponent from './components/RollComponent';

createApp({
    components:{
        RollComponent

    },

}).mount('#app')