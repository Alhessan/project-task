<template>
    <div class="home">
    <!-- top bar -->
        <div class="top-bar">
            <h1>Projects</h1>
            <router-link to="/projects/create">Create Project</router-link>
            <button @click="logout">Logout</button>
        </div>
        
        <div class="project-list">
            <DataTable
                :columns="columns"
                :path="'/api/projects'"
                :detailsLink="'/tasks'"
                :rowColorOptions="rowColoringRules"
                :paginate="true"
            />
        </div>
    </div>
</template>

<script setup>
import { useAuthStore } from '@/store/auth';
import { useRouter } from 'vue-router';
import DataTable from '@/components/DataTable.vue';

const auth = useAuthStore();
const router = useRouter();

const columns = [
    { key: 'id', label: 'ID' },
    { key: 'name', label: 'Project Name' },
    { key: 'description', label: 'Description' },
    { key: 'created_at', label: 'Created At' }
];

const logout = () => {
    auth.logout();
    router.push({ name: 'Login' });
};
</script>
<style scoped lang="scss">
.home {
    .top-bar {
        display: flex;
        justify-content: space-between;
        align-items: center;
        padding: 20px;
        background-color: var(--primary-color);
        color: rgb(109, 105, 105);
    }

    .project-list {
        padding: 20px;
    }
}
</style>
