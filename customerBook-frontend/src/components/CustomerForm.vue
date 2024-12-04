<template>
    <div class="add-customer">
      <h2>Add Customer</h2>
      <form @submit.prevent="handleSubmit">
        <div class="form-group">
          <label>Name:</label>
          <input v-model="form.name" type="text" required />
        </div>
  
        <div class="form-group">
          <label>NIC:</label>
          <input v-model="form.nic" type="text" required />
        </div>
  
        <div class="form-group">
          <label>Address:</label>
          <input v-model="form.address" type="text" required />
        </div>
  
        <div class="form-group">
          <label>Mobile Numbers:</label>
          <div v-for="(number, index) in form.contacts" :key="index" class="mobile-group">
            <input v-model="form.contacts[index]" type="text" required />
            <button type="button" @click="removeMobileNumber(index)" class="remove-btn">Remove</button>
          </div>
          <button type="button" @click="addMobileNumber" class="add-btn">Add Mobile Number</button>
        </div>
  
        <button type="submit" class="submit-btn">Submit</button>
      </form>
    </div>
  </template>
  
  <script>
  import { ref } from 'vue';
  import { addCustomer } from '../apiService';
  
  export default {
    setup() {
      const form = ref({
        name: '',
        nic: '',
        address: '',
        contacts: ['']
      });
  
      const addMobileNumber = () => {
        form.value.contacts.push('');
      };
  
      const removeMobileNumber = (index) => {
        form.value.contacts.splice(index, 1);
      };
  
      const handleSubmit = async () => {
        console.log(form.value);
        try {
          await addCustomer(form.value);
          alert('Customer added successfully!');
          window.location.reload(); 
        } catch (error) {
          alert('Error adding customer');
        }
      };
  
      return {
        form,
        addMobileNumber,
        removeMobileNumber,
        handleSubmit,
      };
    },
  };
  </script>
  
  <style scoped>
  .add-customer {
    width: 50vw;
    margin: 0 auto;
    padding: 20px;
    background-color: #f9f9f9;
    border-radius: 10px;
    box-shadow: 0 2px 10px rgba(0, 0, 0, 0.1);
  }
  
  h2 {
    text-align: center;
    color: #333;
    margin-bottom: 20px;
  }
  
  .form-group {
    margin-bottom: 15px;
  }
  
  label {
    display: block;
    font-weight: bold;
    margin-bottom: 5px;
    color: #555;
  }
  
  input[type="text"] {
    width: 100%;
    padding: 10px;
    font-size: 14px;
    border: 1px solid #ccc;
    border-radius: 5px;
    box-sizing: border-box;
    background-color: #fff;
  }
  
  input[type="text"]:focus {
    border-color: #007bff;
    outline: none;
    box-shadow: 0 0 5px rgba(0, 123, 255, 0.5);
  }
  
  .mobile-group {
    display: flex;
    align-items: center;
    gap: 10px;
    margin-bottom: 10px;
  }
  
  .add-btn {
    background-color: #28a745;
    color: white;
    padding: 8px 12px;
    border: none;
    border-radius: 5px;
    cursor: pointer;
    font-size: 14px;
  }
  
  .add-btn:hover {
    background-color: #218838;
  }
  
  .remove-btn {
    background-color: #dc3545;
    color: white;
    padding: 8px 12px;
    border: none;
    border-radius: 5px;
    cursor: pointer;
    font-size: 14px;
  }
  
  .remove-btn:hover {
    background-color: #c82333;
  }
  
  .submit-btn {
    display: block;
    width: 100%;
    background-color: #007bff;
    color: white;
    padding: 12px;
    border: none;
    border-radius: 5px;
    cursor: pointer;
    font-size: 16px;
  }
  
  .submit-btn:hover {
    background-color: #0056b3;
  }
  </style>
  