<template>
    <div class="data-table">
      <!-- Search Filter -->
      <input v-model="searchTerm" placeholder="Search..." />
  
      <!-- Items List -->
      <div v-if="items.length">
        <table>
          <thead>
            <tr>
              <th v-for="column in columns" :key="column.key">
                {{ column.label }}
              </th>
            </tr>
          </thead>
          <tbody>
            <tr v-for="item in items" :key="item.id" @click="goToDetails(item)">
              <td v-for="column in columns" :key="column.key">
                {{ item[column.key] }}
              </td>
            </tr>
          </tbody>
        </table>
      </div>
      <div v-else>
        No items found.
      </div>
  
      <!-- Pagination -->
      <div v-if="paginate && pagination.last_page > 1">
        <button
          v-for="page in pageNumbers"
          :key="page"
          @click="goToPage(page)"
          :class="{ active: pagination.current_page === page }"
        >
          {{ page }}
        </button>
      </div>
    </div>
  </template>
  
  <script>
  import { ref, computed, watch, onMounted } from 'vue';
  import { useAPIFetch } from "@/utils/api";
  import { useRouter } from 'vue-router';
  
  export default {
    name: 'DataTable',
    props: {
      columns: Array,
      path: String,
      paginate: {
        type: Boolean,
        default: false,
      },
        detailsLink: {
            type: String,
            default: null,
        },
    },
    setup(props) {
      const items = ref([]);
    //   const detailsLink = ref('');
      const searchTerm = ref('');
      const pagination = ref({
        current_page: 1,
        last_page: 0,
        per_page: 25,
        total: 0,
      });
      const router = useRouter();
      const backend = "http://localhost:8000";
  
      watch(searchTerm, () => {
        loadItems();
      });
  
      onMounted(() => {
        loadItems();
      });
  
      async function loadItems() {
        const queryParams = new URLSearchParams({
          per_page: pagination.value.per_page,
          page: pagination.value.current_page,
          keyword: searchTerm.value,
        }).toString();
  
        const url = `${backend}${props.path}?${queryParams}`;
        const { data } = await useAPIFetch(url);
  
        if (data?.data) {
          items.value = data.data;
          pagination.value.current_page = data.current_page;
          pagination.value.last_page = data.last_page;
          pagination.value.per_page = data.per_page;
          pagination.value.total = data.total;
        }
      }
  
      function goToPage(page) {
        if (page >= 1 && page <= pagination.value.last_page) {
          pagination.value.current_page = page;
          loadItems();
        }
      }
  
      function goToDetails(item) {
        console.log("goToDetails", item, props.detailsLink);
        if (props.detailsLink) {
          router.push({ path: props.detailsLink, query: { project_id: item.id } });
        }
      }
  
      const pageNumbers = computed(() => {
        const start = Math.max(1, pagination.value.current_page - 1);
        const end = Math.min(
          pagination.value.last_page,
          pagination.value.current_page + 5
        );
        return Array.from({ length: end - start + 1 }, (_, i) => i + start);
      });
  
      return {
        items,
        searchTerm,
        pagination,
        pageNumbers,
        loadItems,
        goToPage,
        goToDetails,
      };
    },
  };
  </script>
  
  <style scoped lang="scss">
  button.active {
    font-weight: bold;
  }
  
  table {
    width: 100%;
    border-collapse: collapse;
  }
  
  th,
  td {
    padding: 8px;
    text-align: left;
    border-bottom: 1px solid #ddd;
  }
  
  input {
    margin-bottom: 10px;
    padding: 5px;
    width: 100%;
    box-sizing: border-box;
  }
  
  tr {
    cursor: pointer;
  }
  
  tr:hover {
    background-color: #f5f5f5;
  }
  </style>
  