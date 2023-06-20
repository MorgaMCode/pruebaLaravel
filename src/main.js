import app from './app.js';
import './plugins';
import router from './shared/router';


app.use(router);
app.mount('#app');


