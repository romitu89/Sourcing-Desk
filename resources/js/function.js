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
      }
    }
  };
  