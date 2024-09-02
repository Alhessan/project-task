// src/store/auth.js
import { defineStore } from 'pinia';
import axios from 'axios';

export const useAuthStore = defineStore('auth', {
    state: () => ({
        token: null,
        authenticated: false,
    }),
    actions: {
        async login(credentials) {
            try {
                const response = await axios.post('http://localhost:8000/api/login', credentials);
                this.token = response.data.token;
                this.authenticated = true;
                localStorage.setItem('token', this.token);
            } catch (error) {
                console.error('Login failed:', error);
            }
        },
        logout() {
            this.token = null;
            this.authenticated = false;
            localStorage.removeItem('token');
        },
        checkAuth() {
            const token = localStorage.getItem('token');
            if (token) {
                this.token = token;
                this.authenticated = true;
            }
        },
    },
});
