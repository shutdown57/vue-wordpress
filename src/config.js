// export const API_ROOT = 'http://wordpress.app/wp-json/';

export const API_ROOT = root;
export const BASE_URL = 'http://wordpress.app';
export const ASSETS_PATH = BASE_URL + '/wp-content/themes/vue-new/src/assets';
export const NAMESPACE = 'wp/v2/';
export const API_ROUTES = API_ROOT + NAMESPACE;
export const NONCE = nonce;
export const CookieDomain = 'wordpress.app';

export const APP_PASS = 'Lnru goL1 8wTD Bgrd m6UB k25W';

export const GMAPS_OPT = {
    load: {
        key: 'AIzaSyA7A9AFSDRwdFPj7OC_pImF7zpeOu3D6mw', // GOOGLE API KEY
        v: '3.29'    // GOOGLE API VERSION
    }
};

export const LOCALSTORAGE_OPT = {
    namespace: 'vuejs__'
};

/**
 * REGEX
 */
export const VALIDATIONS = {
    EMAIL: /^(([^<>()\[\]\\.,;:\s@"]+(\.[^<>()\[\]\\.,;:\s@"]+)*)|(".+"))@((\[[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\])|(([a-zA-Z\-0-9]+\.)+[a-zA-Z]{2,}))$/,
    PASSWORD: /(.){8,}/,
    NAME: /([اآبپتثئجچحخدذرزژسشصضطظعغفقکگلمنوهی\s]){3,}/,
    USERNAME: /^([a-zA-Z])+(\w|\-|\_|\.)[a-zA-z0-9]+$/,
    ADDRESS: /(.){9,}/,
    MOBILE: /^09(\d){9}/,
    PHONE: /^[0](1[137]|2[134568]|3[1458]|4[145]|5[1468]|6[16]|7[1467]|8[13467])\d{8}/,
    XY: /^[0-9]/
};