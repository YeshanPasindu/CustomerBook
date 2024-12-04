<template>
    <div class="customer-list">
      <h2>All Customers</h2>
  
      <table v-if="customers.data.length > 0">
        <thead>
          <tr>
            <th style="min-width: 150px;">Name</th>
            <th style="min-width: 120px;">NIC</th>
            <th style="min-width: 200px;">Address</th>
            <th style="min-width: 200px;">Mobile Numbers</th>
            <th style="min-width: 100px;">Action</th>
            <th style="min-width: 100px;">Action</th>
          </tr>
        </thead>
        <tbody>
          <tr v-for="customer in customers.data" :key="customer.id">
            <td>{{ customer.name }}</td>
            <td>{{ customer.nic }}</td>
            <td>{{ customer.address?.address || 'No Address' }}</td>
            <td>
              <ul>
                <li v-for="contact in customer.contacts" :key="contact.id">
                  {{ contact.mobile_number }}
                </li>
              </ul>
            </td>
            <td>
              <button class="delete-btn" @click="deleteCustomer(customer.id)">Delete</button>
            </td>
            <td>
              <router-link :to="{ name: 'CustomerUpdate', params: { id: customer.id } }">
                <button class="update-btn">Update</button>
              </router-link>
            </td>
          </tr>
        </tbody>
      </table>
  
      <div v-if="customers.data.length === 0">
        <p>No customers found.</p>
      </div>
    </div>
  </template>
  
  <script>
  import { ref, onMounted } from 'vue'
  import { getCustomers, deleteCustomer } from '../apiService'
  
  export default {
    setup() {
      const customers = ref({ data: [] })
  
      const fetchCustomers = async () => {
        try {
          customers.value = await getCustomers()
        } catch (error) {
          console.error('Error fetching customers:', error)
        }
      }
  
      const removeCustomer = async (id) => {
        try {
          await deleteCustomer(id)
          fetchCustomers() 
        } catch (error) {
          console.error('Error deleting customer:', error)
        }
      }
  
      onMounted(() => {
        fetchCustomers()
      })
  
      return {
        customers,
        deleteCustomer: removeCustomer,
      }
    },
  }
  </script>
  
  <style scoped>
  .customer-list {
    max-width:1200px;
    padding: 20px;
  }
  
  h2 {
    font-size: 24px;
    margin-bottom: 20px;
    color: #333;
  }
  
  table {
    width: 100%;
    border-collapse: collapse;
    margin-bottom: 20px;
  }
  
  th,
  td {
    padding: 12px 15px;
    border: 1px solid #ddd;
    text-align: left;
    font-size: 14px;
    white-space: nowrap; 
  }
  
  th {
    background-color: #f4f4f4;
    color: #333;
  }
  
  td {
    background-color: #fff;
    color: black;
  }
  
  button {
    padding: 6px 12px;
    margin-right: 8px;
    cursor: pointer;
    border: none;
    border-radius: 5px;
    font-size: 14px;
  }
  
  
  .update-btn {
    background-color: #007bff;
    color: white;
  }
  
  .update-btn:hover {
    background-color: #0056b3;
  }
  
  
  .delete-btn {
    background-color: #ff4d4f;
    color: white;
  }
  
  .delete-btn:hover {
    background-color: #d32f2f;
  }
  
  ul {
    list-style-type: none;
    padding: 0;
  }
  
  ul li {
    margin: 5px 0;
  }
  
  .customer-list .no-customers {
    color: #888;
    font-size: 16px;
    padding: 20px;
    text-align: center;
  }
  </style>
  