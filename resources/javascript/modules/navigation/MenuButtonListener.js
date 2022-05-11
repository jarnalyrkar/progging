/**
 * Listens to button with ID menu_button, and opens the menu
 */

class MenuButtonListener {
  constructor() {
    this.button = document.querySelector('#menu_button')
    if (this.button) this.button.addEventListener('click', this.openMenu)
  }

  openMenu() {
    console.log("Consider me open")
  }

}

export default MenuButtonListener;