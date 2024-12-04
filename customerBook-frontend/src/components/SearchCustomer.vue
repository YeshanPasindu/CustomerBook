<template>
    <div class="search-container">
      <h2>Search Customers</h2>
      <div class="search-bar">
        <input v-model="query" placeholder="Search by name, NIC, address, or phone" />
        <button @click="handleSearch">Search</button>
      </div>
  
      <div v-if="customers.length > 0" class="results">
        <h3>Results:</h3>
        <ul>
          <li v-for="customer in customers" :key="customer.id">
            <span class="customer-name">{{ customer.name }}</span> - 
            <span class="customer-nic">{{ customer.nic }}</span> - 
            <span class="customer-address">{{ customer.address?.address || 'No Address' }}</span> - 
            <span class="customer-contacts">{{ customer.contacts.map((contact) => contact.mobile_number).join(", ") }}</span>
          </li>
        </ul>
      </div>
      <div v-else-if="query.length >= 3" class="no-results">
        <p>No results found.</p>
      </div>
    </div>
  </template>
  
  <script>
  import { ref } from "vue";
  import { searchCustomers } from "../apiService";
  
  export default {
    setup() {
      const query = ref("");
      const customers = ref([]);
  
      const handleSearch = async () => {
        console.log("Search triggered with query:", query.value);
  
        if (query.value.length < 1) {
          console.log("Please enter at least 3 characters to search.");
          return;
        }
  
        try {
          const response = await searchCustomers(query.value);
          console.log("Search Results:", response);
          customers.value = response.data;
        } catch (error) {
          console.error("Error while searching:", error);
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
  
  <style scoped>
  .search-container {
    max-width: 600px;
    margin: 40px auto;
    padding: 20px;
    background-color: #f9f9f9;
    border-radius: 8px;
    box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
  }
  
  h2 {
    font-size: 24px;
    margin-bottom: 20px;
    color: #333;
    text-align: center;
  }
  
  .search-bar {
    display: flex;
    gap: 10px;
  }
  
  .search-bar input {
    flex: 1;
    padding: 10px;
    border: 1px solid #ccc;
    border-radius: 4px;
    font-size: 16px;
  }
  
  .search-bar button {
    padding: 10px 20px;
    background-color: #007bff;
    color: white;
    border: none;
    border-radius: 4px;
    font-size: 16px;
    cursor: pointer;
  }
  
  .search-bar button:hover {
    background-color: #0056b3;
  }
  
  .results {
    margin-top: 20px;
  }
  
  .results h3 {
    font-size: 20px;
    color: #333;
  }
  
  .results ul {
    list-style-type: none;
    padding: 0;
  }
  
  .results li {
    padding: 10px 0;
    border-bottom: 1px solid #ddd;
  }
  
  .results li:last-child {
    border-bottom: none;
  }
  
  .customer-name {
    font-weight: bold;
    color: #333;
  }
  
  .customer-nic,
  .customer-address,
  .customer-contacts {
    color: #555;
  }
  
  .no-results {
    text-align: center;
    color: #888;
    font-size: 16px;
    margin-top: 20px;
  }
  </style>
  