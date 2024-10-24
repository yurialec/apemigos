import { createStore } from 'vuex';
import axios from 'axios';

const store = createStore({
    state: {
        user: null
    },
    mutations: {
        setUser(state, user) {
            state.user = user;
        },
        clearUser(state) {
            state.user = null;
        }
    },
    actions: {
        fetchUser({ commit }) {
            axios.get('admin/users/profile')
                .then(response => {
                    commit('setUser', response.data);
                })
                .catch(() => {
                    commit('clearUser');
                });
        },
        login({ commit }, credentials) {
            return axios.post('admin/users/profile', credentials)
                .then(response => {
                    commit('setUser', response.data.user);
                    // Armazenar no localStorage, se necessário
                    localStorage.setItem('user', JSON.stringify(response.data.user));
                });
        },
        logout({ commit }) {
            return axios.post('admin/logout')
                .then(() => {
                    commit('clearUser');
                    localStorage.removeItem('user');
                });
        }
    },
    getters: {
        isAuthenticated(state) {
            return !!state.user;
        },
        getUser(state) {
            return state.user || JSON.parse(localStorage.getItem('user'));
        }
    }
});

export default store;
