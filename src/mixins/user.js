export default {
    __name: '',
    __username: '',
    __token: '',
    __email: '',
    
    getToken() {
        return this.__token;
    },

    setUserInfo(name, username, token, email) {
        this.__name = name;
        this.__token = token;
        this.__email = email;
        this.__username = username;
    },

    getName() {
        return this.__name;
    },

    getEmail() {
        return this.__email;
    },

    getUsername() {
        return this.__username;
    },

    clearData() {
        this.__email = '';
        this.__name = '';
        this.__token = '';
        this.__username = '';
        return true;
    }
};