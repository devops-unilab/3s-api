/**
 * We'll load the axios HTTP library which allows us to easily issue requests
 * to our Laravel back-end. This library automatically handles sending the
 * CSRF token as a header based on the value of the "XSRF" token cookie.
 */

import axios from 'axios';



window.axios = axios;

window.axios.defaults.headers.common['X-Requested-With'] = 'XMLHttpRequest';


import '../../node_modules/jquery/dist/jquery';
import '../../node_modules/popper.js/dist/umd/popper';
import '../../node_modules/bootstrap/dist/js/bootstrap';
import '../js/change-contraste';
