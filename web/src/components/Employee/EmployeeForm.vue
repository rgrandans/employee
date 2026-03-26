<template>
  <div class="page-container">
    <header class="page-header">
      <h1>{{ employee.id ? 'Edit employee' : 'Create employee' }}</h1>
    </header>

    <form @submit.prevent="saveEmployee" class="employee-form">
      <div class="form-row">
        <label>Name</label>
        <input v-model="employee.name" :class="{ 'input-error': errors.name }" />
        <span v-if="errors.name" class="error">{{ errors.name }}</span>
      </div>

      <div class="form-row">
        <label>Surname</label>
        <input v-model="employee.surname" :class="{ 'input-error': errors.surname }" />
        <span v-if="errors.surname" class="error">{{ errors.surname }}</span>
      </div>

      <div class="form-row">
        <label>Personal identification number</label>
        <input v-model="employee.personalIdentityNumber" :class="{ 'input-error': errors.personalIdentityNumber }" />
        <span v-if="errors.personalIdentityNumber" class="error">
          {{ errors.personalIdentityNumber }}
        </span>
      </div>

      <div class="form-row">
        <label>Gender</label>
        <select v-model="employee.gender" :class="{ 'input-error': errors.gender }">
          <option value="" disabled>Select gender</option>
          <option value="male">Male</option>
          <option value="female">Female</option>
        </select>
        <span v-if="errors.gender" class="error">{{ errors.gender }}</span>
      </div>

      <div class="form-row">
        <label>Phone</label>
        <input v-model="employee.phone" :class="{ 'input-error': errors.phone }" />
        <span v-if="errors.phone" class="error">{{ errors.phone }}</span>
      </div>

      <div class="form-row">
        <label>Email</label>
        <input v-model="employee.email" :class="{ 'input-error': errors.email }" />
        <span v-if="errors.email" class="error">{{ errors.email }}</span>
      </div>

      <fieldset class="address-fieldset">
        <legend>Address</legend>

        <div class="form-row">
          <label>Country code</label>
          <input v-model="employee.address.countryCode"
                 :class="{ 'input-error': errors['address.countryCode'] }" />
          <span v-if="errors['address.countryCode']" class="error">
            {{ errors['address.countryCode'] }}
          </span>
        </div>

        <div class="form-row">
          <label>City</label>
          <input v-model="employee.address.city"
                 :class="{ 'input-error': errors['address.city'] }" />
          <span v-if="errors['address.city']" class="error">
            {{ errors['address.city'] }}
          </span>
        </div>

        <div class="form-row">
          <label>Street</label>
          <input v-model="employee.address.street"
                 :class="{ 'input-error': errors['address.street'] }" />
          <span v-if="errors['address.street']" class="error">
            {{ errors['address.street'] }}
          </span>
        </div>

        <div class="form-row">
          <label>Street number</label>
          <input v-model="employee.address.streetNumber"
                 :class="{ 'input-error': errors['address.streetNumber'] }" />
          <span v-if="errors['address.streetNumber']" class="error">
            {{ errors['address.streetNumber'] }}
          </span>
        </div>

        <div class="form-row">
          <label>Postal code</label>
          <input v-model="employee.address.postalCode"
                 :class="{ 'input-error': errors['address.postalCode'] }" />
          <span v-if="errors['address.postalCode']" class="error">
            {{ errors['address.postalCode'] }}
          </span>
        </div>
      </fieldset>

      <div class="form-actions">
        <button type="submit" class="btn-primary">
          {{ employee.id ? 'Save' : 'Create' }}
        </button>
        <router-link to="/employees" class="btn-secondary">Cancel</router-link>
      </div>
    </form>
  </div>
</template>

<script>
import EmployeeService from "@/services/EmployeeService";

export default {
  data() {
    return {
      employee: {
        id: null,
        name: '',
        surname: '',
        personalIdentityNumber: '',
        gender: '',
        phone: '',
        email: '',
        address: {
          countryCode: '',
          city: '',
          street: '',
          streetNumber: '',
          postalCode: ''
        }
      },
      errors: {}
    };
  },

  async created() {
    const id = this.$route.params.id;
    if (id) {
      this.fetchEmployee(id);
    }
  },

  methods: {
    async fetchEmployee(id) {
      try {
        const response = await EmployeeService.getEmployee(id);

        this.employee = {
          ...response.data,
          address: response.data.address || {
            countryCode: '',
            city: '',
            street: '',
            streetNumber: '',
            postalCode: ''
          }
        };
      } catch (error) {
        console.error("Failed to fetch employee", error);
      }
    },

    async saveEmployee() {
      this.errors = {};

      try {
        if (this.employee.id) {
          await EmployeeService.updateEmployee(this.employee);
        } else {
          await EmployeeService.createEmployee(this.employee);
        }

        this.$router.push('/employees');
      } catch (error) {
        if (error.response && error.response.status === 422) {
          const violations = error.response.data.violations;

          violations.forEach(v => {
            this.errors[v.propertyPath] = v.title;
          });
        } else {
          console.error("Failed to save employee", error);
        }
      }
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

.page-header h1 {
  font-size: 26px;
  font-weight: 600;
  border-bottom: 2px solid #e5e7eb;
  padding-bottom: 10px;
}

.employee-form {
  display: flex;
  flex-direction: column;
  gap: 16px;
  background-color: #f9fafb;
  padding: 20px;
  border-radius: 8px;
}

.form-row {
  display: flex;
  flex-direction: column;
}

.form-row label {
  margin-bottom: 6px;
  font-weight: 500;
}

.form-row input,
.form-row select {
  padding: 10px;
  border: 1px solid #d1d5db;
  border-radius: 6px;
}

.input-error {
  border-color: #ef4444;
}

.error {
  color: #ef4444;
  font-size: 13px;
  margin-top: 4px;
}

.address-fieldset {
  border: 1px solid #d1d5db;
  padding: 15px;
  border-radius: 6px;
}

.form-actions {
  display: flex;
  gap: 12px;
}

.btn-primary {
  background: #3b82f6;
  color: white;
  padding: 10px 16px;
  border-radius: 6px;
  border: none;
}

.btn-secondary {
  background: #ef4444;
  color: white;
  padding: 10px 16px;
  border-radius: 6px;
  text-decoration: none;
}
</style>