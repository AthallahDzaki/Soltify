class ModalManager {
    constructor() {
        this.modals = [];
    }

    open(modal) {
        if(this.modals.length > 0) {
            this.modals[this.modals.length - 1].hide(); // Hide the last modal
        }
        this.modals.push(modal);
        modal.show();
    }

    close(modal) {
        const index = this.modals.indexOf(modal);
        console.log(index, this.modals);
        if (index > -1) {
            this.modals.splice(index, 1);
            modal.hide();
        }
    }

    closeAll() {
        this.modals.forEach(modal => modal.hide());
        this.modals = [];
    }
}

class Modal {
    constructor(id) {
        this.id = id;
        this.element = document.getElementById(id);
    }

    show() {
        if (this.element) {
            this.element.classList.add('show');
            this.element.style.display = 'block';
        }
    }

    hide() {
        if (this.element) {
            this.element.classList.remove('show');
            this.element.style.display = 'none';
        }
    }
}

// Usage example
// const modalManager = new ModalManager();
// const myModal = new Modal('myModalId');

// modalManager.open(myModal);
// // To close the modal
// // modalManager.close(myModal);
// // To close all modals
// // modalManager.closeAll();