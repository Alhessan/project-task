<template>
    <div class="tasks-page">
      <h1>Tasks for Project ID: {{ projectId }}</h1>
  
      <!-- DataTable Component -->
      <DataTable
        :columns="columns"
        :path="tasksPath"
        :paginate="true"
      />
    </div>
  </template>
  
  <script>
  import {  computed } from 'vue';
  import { useRoute } from 'vue-router';
  import DataTable from '@/components/DataTable.vue';
  
  export default {
    name: 'TasksPage',
    components: {
      DataTable
    },
    setup() {
      const route = useRoute();
      const projectId =route.query.project_id;
  
      const columns = [
        { key: 'name', label: 'Task Name' },
        { key: 'status', label: 'Status' },
        // Add other columns as needed
      ];
      console.log("projectId", route.query.project_id);
  
      const tasksPath = computed(() => `/api/projects/${projectId}/tasks`);
  
      return {
        projectId,
        columns,
        tasksPath
      };
    }
  };
  </script>
  
  <style scoped lang="scss">
  h1 {
    margin-bottom: 20px;
  }
  
  .tasks-page {
    padding: 20px;
  }
  
  .tasks-page .table {
    width: 100%;
    border-collapse: collapse;
  }
  
  .tasks-page .table thead {
    background-color: #f4f4f4;
  }
  </style>
  