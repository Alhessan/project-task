<script setup>

import { ref } from 'vue';
import { useRouter } from 'vue-router';
import { useAuth } from '@/composables/useAuth';

const email = ref('');
const password = ref('');
const router = useRouter();
const { setToken } = useAuth();

async function login() {
    try {
        const response = await fetch('http://127.0.0.1:8000/api/login', {
            method: 'POST',
            headers: {
                'Content-Type': 'application/json'
            },
            body: JSON.stringify({ email: email.value, password: password.value })
        });
        const data = await response.json();

        if (response.ok) {
            setToken(data.token); // Store token in localStorage
            router.push({ name: 'home' }); // Redirect to home
        } else {
            console.error('Login failed', data.message);
        }
    } catch (error) {
        console.error('Login error:', error);
    }
}

</script>

<template>
    <div class="login">
        <h1>Login</h1>
        <form @submit.prevent="login">
            <input id="email" v-model="email" type="email" placeholder="Email" required />
            <input id="password" v-model="password" type="password" placeholder="Password" required />
            <button type="submit">Login</button>
        </form>
    </div>
</template>

<style scoped lang="scss">

.login {
    display: flex;
    flex-direction: column;
    align-items: center;
    justify-content: center;
    height: 100vh;

    form {
        display: flex;
        flex-direction: column;
        align-items: center;
        justify-content: center;
        margin-top: 20px;

        input {
            margin-bottom: 10px;
            padding: 10px;
            width: 300px;
            border: 1px solid #ccc;
            border-radius: 5px;
        }

        button {
            padding: 10px 20px;
            background-color: #007bff;
            color: white;
            border: none;
            border-radius: 5px;
            cursor: pointer;
        }
    }
}


</style>
