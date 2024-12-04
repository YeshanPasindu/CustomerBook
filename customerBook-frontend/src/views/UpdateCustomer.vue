<template>
    <div>
      <h2>Update Customer</h2>
      <form @submit.prevent="handleSubmit">
        <div>
          <label>Name:</label>
          <input v-model="form.name" type="text" required />
        </div>
  
        <div>
          <label>NIC:</label>
          <input v-model="form.nic" type="text" required />
        </div>
  
        <div>
          <label>Address:</label>
          <input v-model="form.address" type="text" required />
        </div>
  
        <div>
          <label>Mobile Numbers:</label>
          <div v-for="(number, index) in form.contacts" :key="index">
            <input v-model="form.contacts[index]" type="text" required />
            <button type="button" @click="removeContact(index)">Remove</button>
          </div>
          <button type="button" @click="addContact">Add Mobile Number</button>
        </div>
  
        <button type="submit">Update</button>
      </form>
    </div>
  </template>
  
  <script>
  import { ref, onMounted } from "vue";
  import { getCustomer, updateCustomer } from "../apiService";
  import { useRoute, useRouter } from "vue-router";
  
  export default {
    props: ['id'],
    setup() {
      const form = ref({
        name: "",
        nic: "",
        address: "",
        contacts: [],
      });
  
      const route = useRoute();
      const router = useRouter();
  
      const fetchCustomer = async () => {
        console.log("gfdtf")
        try {
            const response = await getCustomer(route.params.id);
    console.log("Customer Response:", response); 
    const customer = response.data;
    console.log("Customer Data:", customer);
          form.value = {
            name: customer.name,
            nic: customer.nic,
            address: customer.address.address,
            contacts: customer.contacts.map(contact => contact.mobile_number),
          };
        } catch (error) {
          console.error("Error fetching customer data:", error);
        }
      };
  
      const addContact = () => {
        form.value.contacts.push("");
      };
  
      const removeContact = (index) => {
        form.value.contacts.splice(index, 1);
      };
  
      const handleSubmit = async () => {
        try {
          await updateCustomer(route.params.id, form.value);
          alert("Customer updated successfully!");
          router.push("/");  
        } catch (error) {
          console.error("Error updating customer:", error);
          alert("Error updating customer");
        }
      };
  
      onMounted(() => {
        fetchCustomer();
      });
  
      return {
        form,
        addContact,
        removeContact,
        handleSubmit,
      };
    },
  };
  </script>
  
  <style scoped>
  
form {
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

div {
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

div > div {
  display: flex;
  align-items: center;
  gap: 10px;
}

button[type="button"] {
  background-color: #dc3545;
  color: white;
  padding: 8px 12px;
  border: none;
  border-radius: 5px;
  cursor: pointer;
  font-size: 14px;
}

button[type="button"]:hover {
  background-color: #c82333;
}

button[type="button"]:last-of-type {
  background-color: #28a745;
}

button[type="button"]:last-of-type:hover {
  background-color: #218838;
}

button[type="submit"] {
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

button[type="submit"]:hover {
  background-color: #0056b3;
}
</style>
