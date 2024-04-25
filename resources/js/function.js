// function.js
export const commonFunctionsMixin = {
    methods: {
      getUniqueValues(array, key) {
        if (!Array.isArray(array)) {
          console.warn('getUniqueValues was given a non-array argument:', array);
          return [];
        }
        const values = array.map(item => item[key]);
        const filterValues = values.filter(item => item != '')
        return Array.from(new Set(filterValues));
      },
      checkValidation(fieldName) {
        let dataError = Object.values(this.errors);
        if (dataError.length > 1) {
          this.submitForm();
        } else {
          if (this.errors.hasOwnProperty(fieldName)) {
            delete this.errors[fieldName];
          }
        }
      },
      formatDateTime(dateTime) {
        const localDateTime = new Date(dateTime); // Convert to local time
        const datePart = localDateTime.toLocaleDateString(); // Get formatted date
        const timePart = localDateTime.toLocaleTimeString([], { hour: '2-digit', minute: '2-digit' }); // Get formatted time

        return `${datePart} ${timePart}`; // Combine date and time parts
      },
    }
  };
