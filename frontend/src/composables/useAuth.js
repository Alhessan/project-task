import { ref } from 'vue';

const token = ref(localStorage.getItem('auth_token') || null);

export function useAuth() {
    function setToken(newToken) {
        token.value = newToken;
        localStorage.setItem('auth_token', newToken);
    }

    function getToken() {
        return token.value;
    }

    function clearToken() {
        token.value = null;
        localStorage.removeItem('auth_token');
    }

    return { setToken, getToken, clearToken };
}
