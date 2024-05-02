<template>
  <div class="nav_bar" :class="{ 'dark-theme': selectedTheme === 'dark' }">
    <div class="nav_icon">
      <font-awesome-icon :icon="['fas', 'magnifying-glass']" />
      <div class="nav_icon_b">
        <div>
          <span> <font-awesome-icon :icon="['fas', 'message']" /></span>
        </div>

        <div>
          <span><font-awesome-icon :icon="['fas', 'bell']" /></span>
        </div>

        <div class="dropdown" @click="toggleDropdown()" ref="dropdown">
          <span><b>Ashock kumar panday</b></span>
          <span v-if="dropDown" style="margin-left: 10px; color: goldenrod">
            <font-awesome-icon :icon="['fas', 'chevron-down']" />
          </span>
          <span v-else style="margin-left: 10px; color: goldenrod">
            <font-awesome-icon :icon="['fas', 'chevron-left']" />
          </span>

          <div class="dropdown-content" v-if="dropDown">
            <a href="#" @click="openSettingsPopup"><font-awesome-icon :icon="['fas', 'gear']" /> Settings</a>
            <a href="#"><font-awesome-icon :icon="['fas', 'user']" /> Profile</a>
            <a href="#"><font-awesome-icon :icon="['fas', 'envelope']" /> My message</a>
            <a href="#" @click="logout"><font-awesome-icon :icon="['fas', 'right-from-bracket']" /> Logout</a>
          </div>
        </div>
      </div>
    </div>
  </div>

  <!-- Settings popup -->
  <div v-if="settingsPopupVisible" class="settings-popup" @click.self="closeSettingsPopup">
    <div class="settings-popup-content">
      <span class="close" @click="closeSettingsPopup">&times;</span>
      <h2>Settings</h2>
      <div class="theme-options">
        <p>Background Theme:</p>
        <div class="theme-radio">
          <input type="radio" id="defaultTheme" value="default" v-model="selectedTheme">
          <label for="defaultTheme">Default</label>
        </div>
        <div class="theme-radio">
          <input type="radio" id="darkTheme" value="dark" v-model="selectedTheme">
          <label for="darkTheme">Dark</label>
        </div>
      </div>
      <button class="apply-button" @click="applySettings">Apply</button>
    </div>
  </div>
</template>

<script>
export default {
  name: "NavigationBar",

  data() {
    return {
      dropDown: false,
      settingsPopupVisible: false,
      selectedTheme: "default",
    };
  },

  methods: {
    toggleDropdown() {
      this.dropDown = !this.dropDown;
      if (this.dropDown) {
        document.body.addEventListener("click", this.closeDropdownOnClickOutside);
      } else {
        document.body.removeEventListener("click", this.closeDropdownOnClickOutside);
      }
    },

    closeDropdownOnClickOutside(event) {
      // Check if the click is outside the dropdown
      const dropdown = this.$refs.dropdown;
      if (!dropdown.contains(event.target)) {
        this.dropDown = false;
        document.body.removeEventListener("click", this.closeDropdownOnClickOutside);
      }
    },

    openSettingsPopup() {
      this.settingsPopupVisible = true;
    },

    closeSettingsPopup() {
      this.settingsPopupVisible = false;
    },

    applySettings() {
      // Implement theme change logic here
      if (this.selectedTheme === "dark") {
        document.body.classList.add("dark-theme"); // Apply dark theme
      } else {
        document.body.classList.remove("dark-theme"); // Remove dark theme
      }
      this.closeSettingsPopup();
    },

    logout() {
      this.$router.push({ path: "/login" });
    },
  },
};
</script>

<style scoped>
/* Your existing styles */

.nav_bar {
  background-color: whitesmoke;
  width: 100%;
  height: 50px;
  padding: 0.5%;
  color: #002147;
  position: sticky;
  top: 0;
  box-shadow: 0 0 4px 2px lightgray;
}

.nav_icon {
  display: flex;
  padding: 5px 60px;
  justify-content: space-between;
  margin-top: 10px;
}

.nav_icon_b {
  display: flex;
  gap: 40px;
}

.dropdown-content {
  position: absolute;
  top: 45px;
  right: 25px;
  background-color: #f9f9f9;
  min-width: 110px;
  box-shadow: 0px 8px 16px 0px rgba(0, 0, 0, 0.2);
  z-index: 1;
}

.dropdown-content a {
  color: black;
  padding: 12px 16px;
  text-decoration: none;
  display: block;
}

.dropdown-content a:hover {
  background-color: #f1f1f1;
}

.dropdown:hover .dropdown-content {
  display: block;
}

.dark-theme {
  background-color: #333; /* Dark background color */
  color: #fff; /* Light text color */
}

.settings-popup {
  display: flex;
  position: fixed;
  z-index: 1;
  top: calc(50px + 10px); /* Adjust the distance from the navbar */
  right: 25px;
  background-color: white;
  border-radius: 5px;
  box-shadow: 0px 8px 16px 0px rgba(0, 0, 0, 0.2);
}

.settings-popup-content {
  padding: 20px;
  max-width: 300px;
}

.settings-popup-content .close {
  color: #aaa;
  float: right;
  font-size: 28px;
  font-weight: bold;
  cursor: pointer;
}

.settings-popup-content .close:hover,
.settings-popup-content .close:focus {
  color: black;
  text-decoration: none;
  cursor: pointer;
}

.theme-options {
  margin-bottom: 20px;
}

.theme-radio {
  display: flex;
  align-items: center;
  margin-bottom: 10px;
}

.theme-radio input[type="radio"] {
  margin-right: 5px;
}

.apply-button {
  background-color: #007bff;
  color: white;
  border: none;
  padding: 10px 20px;
  border-radius: 5px;
  cursor: pointer;
  transition: background-color 0.3s ease;
}

.apply-button:hover {
  background-color: #0056b3;
}
</style>
