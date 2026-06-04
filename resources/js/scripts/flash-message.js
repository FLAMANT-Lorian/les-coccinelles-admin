(function () {
    const flashMessage = {
        init() {
            this.handleFlashMessage();
        },
        handleFlashMessage() {
            document.addEventListener('animationend', e => {
                if (e.animationName === 'flashMessage') {
                    this.flashMessage = document.querySelector('.flash-message');
                    this.flashMessage.remove();
                }
            })
        }
    };
    flashMessage.init();
})();
