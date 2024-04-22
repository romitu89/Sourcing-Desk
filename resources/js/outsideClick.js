// function.js
export const outsideClickMixin = {
    mounted() {

        // Attach event listener to detect clicks outside the popup
        document.addEventListener("mousedown", this.handleClickOutside);
      },
      beforeDestroy() {
        // Clean up event listener when component is destroyed
        document.removeEventListener("mousedown", this.handleClickOutside);
      },
    methods: {

      handleClickOutside(event) {
        // Get the popup element
        const popupElement = this.$el;

        // Check if the clicked element is outside the popup
        if (!popupElement.contains(event.target)) {
          this.closePopup();
        }
      },

    }
  };
