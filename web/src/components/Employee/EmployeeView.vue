<template>
  <div class="page-container">
    <header class="page-header">
      <h1>Employee details</h1>
    </header>

    <div class="employee-details">
      <div class="detail-row">
        <span class="label">ID:</span>
        <span class="value">{{ employee.id }}</span>
      </div>

      <div class="detail-row">
        <span class="label">Name:</span>
        <span class="value">{{ employee.name }}</span>
      </div>

      <div class="detail-row">
        <span class="label">Surname:</span>
        <span class="value">{{ employee.surname }}</span>
      </div>

      <div class="detail-row">
        <span class="label">Personal identification number:</span>
        <span class="value">{{ employee.personalIdentityNumber }}</span>
      </div>

      <div class="detail-row">
        <span class="label">Gender:</span>
        <span class="value">{{ employee.gender }}</span>
      </div>

      <div class="detail-row">
        <span class="label">Phone:</span>
        <span class="value">{{ employee.phone }}</span>
      </div>

      <div class="detail-row">
        <span class="label">Email:</span>
        <span class="value">{{ employee.email }}</span>
      </div>

      <div class="detail-row">
        <span class="label">Address:</span>
        <span class="value">
          {{ formatAddress(employee.address) }}
        </span>
      </div>

      <div class="actions">
        <router-link :to="'/employees/edit/' + employee.id" class="btn-primary">Edit</router-link>
        <router-link to="/employees" class="btn-secondary">Back to List</router-link>
      </div>
    </div>
  </div>
</template>

<script>
import EmployeeService from "@/services/EmployeeService";

export default {
  data() {
    return {
      employee: {
        address: {}
      }
    };
  },
  async created() {
    this.fetchEmployee(this.$route.params.id);
  },
  methods: {
    async fetchEmployee(id) {
      try {
        const response = await EmployeeService.getEmployee(id);
        this.employee = response.data;

        if (!this.employee.address) {
          this.employee.address = {};
        }
      } catch (error) {
        console.error("Failed to fetch employee", error);
      }
    },
    formatAddress(address) {
      if (!address) return "";
      const parts = [
        address.street,
        address.streetNumber,
        address.city,
        address.postalCode,
        address.countryCode
      ];
      return parts.filter(Boolean).join(", ");
    }
  }
};
</script>

<style scoped>
.page-container {
  max-width: 1000px;
  margin: 40px auto;
  padding: 0 20px;
  font-family: Arial, sans-serif;
}

.page-header {
  margin-bottom: 25px;
}

.page-header h1 {
  font-size: 26px;
  font-weight: 600;
  color: #111827;
  border-bottom: 2px solid #e5e7eb;
  padding-bottom: 10px;
}

.employee-details {
  background-color: #f9fafb;
  padding: 20px;
  border-radius: 8px;
  display: flex;
  flex-direction: column;
  gap: 12px;
}

.detail-row {
  display: flex;
  gap: 12px;
}

.detail-row .label {
  font-weight: 600;
  color: #374151;
  min-width: 150px;
}

.detail-row .value {
  color: #111827;
}

.actions {
  margin-top: 20px;
  display: flex;
  gap: 12px;
}

.btn-primary {
  background-color: #3b82f6;
  color: white;
  padding: 10px 16px;
  border-radius: 6px;
  font-weight: 500;
  text-decoration: none;
  display: inline-flex;
  align-items: center;
  justify-content: center;
}

.btn-primary:hover {
  background-color: #2563eb;
}

.btn-secondary {
  background-color: #ef4444;
  color: white;
  padding: 10px 16px;
  border-radius: 6px;
  font-weight: 500;
  text-decoration: none;
  display: inline-flex;
  align-items: center;
  justify-content: center;
}

.btn-secondary:hover {
  background-color: #dc2626;
}

@media (max-width: 640px) {
  .detail-row {
    flex-direction: column;
  }
  .detail-row .label {
    min-width: auto;
  }
  .actions {
    flex-direction: column;
  }
  .btn-primary,
  .btn-secondary {
    width: 100%;
    text-align: center;
  }
}
</style>