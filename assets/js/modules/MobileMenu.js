class MobileMenu {

  constructor() {
    this.hamburger = document.querySelector('#hamburger');
    this.nav = document.querySelector('.headerMenu');
    this.events();
  }

  events() {
    this.hamburger.addEventListener('click', (ev) => {
      this.nav.classList.toggle('headerMenu--open');
      this.hamburger.classList.toggle('hamburger--toggled');
    });
  }
}

export default MobileMenu;


