class CollectAnchors {
  constructor() {
    this.anchors = document.querySelectorAll('.headingAnchor');
    this.tableOfContents = document.querySelector('#tableOfContents');
    this.tableOfContentsButton = document.querySelector('#tableOfContentsButton');
    this.tableOfContents.style.display = "none";
    this.collect();
    this.listen();
  }

  collect() {
    if (this.anchors.length > 0) {
      this.anchors.forEach(anchor => {
        this.tableOfContents.appendChild(anchor);
      });
    } else {
      this.tableOfContents.style.display = "none";
      this.tableOfContents.parentElement.style.display = "none";
      this.tableOfContentsButton.style.display = "none";
    }
  }

  setHeight() {
    if (this.tableOfContents.parentElement.offsetHeight < 500) {
      this.tableOfContents.parentElement.style.top = "30%";
    } else {
      if (window.innerHeight > 760) {
        this.tableOfContents.parentElement.style.top = "90px";
      } else {
        this.tableOfContents.parentElement.style.top = "0px";
      }
    }
  }

  listen() {
    this.tableOfContentsButton.addEventListener('click', () => {
      this.tableOfContentsButton.classList.toggle('tableOfContents__button--hover');
      if (this.tableOfContents.style.display == "none") {
        this.tableOfContents.style.display = "flex";
        this.setHeight();
      } else {
        this.tableOfContents.style.display = "none"
      }
    })
  }
}

export default CollectAnchors;