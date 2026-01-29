import { defineStore } from 'pinia';
import axios from 'axios';
import { ref } from 'vue';

export const useAuthStore = defineStore('auth', () => {
    // Configure Axios defaults
    axios.defaults.headers.common['X-Requested-With'] = 'XMLHttpRequest';
    axios.defaults.headers.common['Accept'] = 'application/json';

    const user = ref(null);
    const isAuthenticated = ref(false);
    const loading = ref(false);
    const error = ref(null);
    const token = ref(localStorage.getItem('admin_token'));

    // Set initial header if token exists
    if (token.value) {
        axios.defaults.headers.common['Authorization'] = `Bearer ${token.value}`;
    }

    // Initialize auth state
    const initializeAuth = async () => {
        if (!token.value) {
            isAuthenticated.value = false;
            return;
        }

        try {
            loading.value = true;
            // Ensure header is set
            axios.defaults.headers.common['Authorization'] = `Bearer ${token.value}`;

            const response = await axios.get('/api/user');
            user.value = response.data;
            isAuthenticated.value = true;
        } catch (e) {
            console.error('Auth initialization failed', e);
            // Token invalid or expired
            localStorage.removeItem('admin_token');
            token.value = null;
            user.value = null;
            isAuthenticated.value = false;
            delete axios.defaults.headers.common['Authorization'];
        } finally {
            loading.value = false;
        }
    };

    const login = async (credentials) => {
        try {
            loading.value = true;
            error.value = null;

            // Login to get token (Note: endpoint is /api/login now)
            const response = await axios.post('/api/login', credentials);

            // Save token
            const authToken = response.data.token;
            localStorage.setItem('admin_token', authToken);
            token.value = authToken;
            axios.defaults.headers.common['Authorization'] = `Bearer ${authToken}`;

            // Set User
            user.value = response.data.user;
            isAuthenticated.value = true;
            return true;
        } catch (e) {
            error.value = e.response?.data?.message || 'Login failed';
            isAuthenticated.value = false;
            return false;
        } finally {
            loading.value = false;
        }
    };

    const logout = async () => {
        try {
            loading.value = true;
            await axios.post('/api/logout');
        } catch (e) {
            console.error('Logout failed', e);
        } finally {
            // Always clean up locally
            localStorage.removeItem('admin_token');
            token.value = null;
            user.value = null;
            isAuthenticated.value = false;
            delete axios.defaults.headers.common['Authorization'];
            loading.value = false;
        }
    };

    return {
        user,
        isAuthenticated,
        loading,
        error,
        login,
        logout,
        initializeAuth
    };
});
