<template>
  <div>
    <div class="header">
      <h1>Employee list</h1>
      <router-link to="/employees/create" class="create-btn">
        + Create employee
      </router-link>
    </div>
    <table>
      <thead>
      <tr>
        <th>ID</th>
        <th>Name</th>
        <th>Surname</th>
        <th>Phone</th>
        <th>Email</th>
        <th>Actions</th>
      </tr>
      </thead>
      <tbody>
      <tr v-for="employee in employees" :key="employee.id">
        <td>{{ employee.id }}</td>
        <td>{{ employee.name }}</td>
        <td>{{ employee.surname }}</td>
        <td>{{ employee.phone }}</td>
        <td>{{ employee.email }}</td>
        <td>
          <router-link :to="'/employees/' + employee.id">View</router-link>
          <router-link :to="'/employees/edit/' + employee.id">Edit</router-link>
          <button @click="deleteEmployee(employee.id)">Delete</button>
        </td>
      </tr>
      </tbody>
    </table>
  </div>
</template>

<script>
import EmployeeService from "@/services/EmployeeService";

export default {
  data() {
    return {
      employees: [],
    };
  },
  mounted() {
    this.fetchEmployees();
  },
  methods: {
    async fetchEmployees() {
      try {
        const response = await EmployeeService.getEmployees();
        this.employees = response.data;
      } catch (error) {
        console.error("Failed to fetch employees", error);
      }
    },
    async deleteEmployee(id) {
      const confirmed = window.confirm("Are you sure you want to delete this employee?");
      if (!confirmed) return;

      try {
        await EmployeeService.deleteEmployee(id);
        this.fetchEmployees();
      } catch (error) {
        console.error("Failed to delete employee", error);
      }
    }
  },
};
</script>

<style scoped>
h1 {
  margin-bottom: 20px;
  font-size: 24px;
  font-weight: 600;
}

.header {
  display: flex;
  justify-content: space-between;
  align-items: center;
  margin-bottom: 20px;
}

.create-btn {
  background-color: #10b981;
  color: white;
  padding: 8px 14px;
  border-radius: 6px;
  text-decoration: none;
  font-weight: 500;
  transition: background 0.2s;
}

.create-btn:hover {
  background-color: #059669;
}

table {
  width: 100%;
  border-collapse: collapse;
  background: #fff;
  box-shadow: 0 2px 8px rgba(0,0,0,0.05);
  border-radius: 8px;
  overflow: hidden;
}

thead {
  background-color: #f5f7fa;
}

th, td {
  padding: 12px 16px;
  text-align: left;
}

th {
  font-weight: 600;
  color: #333;
}

tbody tr {
  border-top: 1px solid #eee;
  transition: background 0.2s;
}

tbody tr:hover {
  background-color: #f9fafb;
}

td a {
  margin-right: 10px;
  text-decoration: none;
  font-weight: 500;
  color: #3b82f6;
}

td a:hover {
  text-decoration: underline;
}

button {
  background-color: #ef4444;
  color: white;
  border: none;
  padding: 6px 12px;
  border-radius: 6px;
  cursor: pointer;
  transition: background 0.2s;
}

button:hover {
  background-color: #dc2626;
}
</style>