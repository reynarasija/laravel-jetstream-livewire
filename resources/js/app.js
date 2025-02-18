import './bootstrap';


window.themeSwitcher = function () {
  return {
    switchOn: JSON.parse(localStorage.getItem('isDark')) || false,
    switchTheme() {
      this.switchOn = !this.switchOn;
      localStorage.setItem('isDark', this.switchOn);
      document.documentElement.classList.toggle('dark', this.switchOn);
    }
  }
}