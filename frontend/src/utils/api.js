import { useAuth } from '@/composables/useAuth';

export async function useAPIFetch(url, options = {}) {
    const { getToken } = useAuth();
    const token = getToken();

    const headers = {
        'Accept': 'application/json',
        'Content-Type': 'application/json',
        ...options.headers,
        ...(token ? { Authorization: `Bearer ${token}` } : {})
    };

    try {
        const response = await fetch(url, { ...options, headers });
        if (!response.ok) {
            throw new Error('Network response was not ok');
        }
        const data = await response.json();
        return { data };
    } catch (error) {
        console.error('Fetch error:', error);
        return { error };
    }
}
