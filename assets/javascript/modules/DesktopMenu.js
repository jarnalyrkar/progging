class DesktopMenu {
  constructor() {
    this.menuButton = document.querySelector('#desktopMenu');
    this.menu = document.querySelector('#desktopMenu + #desktopNav .headerMenu__list');
    this.events();
  }

  events() {
    this.menuButton.addEventListener('click', () => {
      this.menu.classList.toggle('headerMenu__list--open');
    });
  }
}

export default DesktopMenu;