class DesktopMenu {
  constructor() {
    this.menuButton = document.querySelector('#desktopMenu');
    this.menu = document.querySelector('#desktopMenu + #desktopNav .headerMenu__list');
    this.events();
  }

  events() {
    this.menuButton.addEventListener('click', () => {
      if (this.menu.style.visibility == "hidden" || !this.menu.getAttribute('style')) {
        this.menu.style.visibility = "visible";
      } else {
        this.menu.style.visibility = "hidden";
      }
    });
  }
}

export default DesktopMenu;