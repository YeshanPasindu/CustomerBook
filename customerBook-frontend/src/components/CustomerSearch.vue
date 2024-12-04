<template>
    <div>
      <h2>Search Customers</h2>
      <input v-model="query" @input="handleSearch" placeholder="Search by name, NIC, address, or phone" />
  
      <div v-if="customers.length > 0">
        <h3>Results:</h3>
        <ul>
          <li v-for="customer in customers" :key="customer.id">
            {{ customer.name }} - {{ customer.nic }} - {{ customer.address?.address }} - 
            {{ customer.contacts.map(contact => contact.mobile_number).join(', ') }}
          </li>
        </ul>
      </div>
      <div v-else>
        <p>No results found.</p>
      </div>
    </div>
  </template>
  
  <script>
  import { ref } from 'vue';
  import { searchCustomers } from '../apiService';
  
  export default {
    setup() {
      const query = ref('');
      const customers = ref([]);
  
      const handleSearch = async () => {
        console.log("hgf");
        if (query.value.length < 3) return; // Search after 3 characters
        try {
          const response = await searchCustomers(query.value);
          console.log(response)
          customers.value = response.data;
        } catch (error) {
          customers.value = [];
        }
      };
  
      return {
        query,
        customers,
        handleSearch,
      };
    },
  };
  </script>
  