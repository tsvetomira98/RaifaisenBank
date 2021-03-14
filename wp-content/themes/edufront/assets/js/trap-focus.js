jQuery(function ($) {
    /**
         * Accessibility code for trapping focus.
         *
         * @link https://uxdesign.cc/how-to-trap-focus-inside-modal-to-make-it-ada-compliant-6a50f9a70700
         */
    // add all the elements inside modal which you want to make focusable
    var focusableElements = 'button, [href], input, select, textarea, [tabindex]:not([tabindex="-1"])';
    var modal = document.querySelector('#site-navigation'); // select the modal by it's id
    var closeBtn = document.querySelector('button.menu-toggle'); // select the modal by it's id
    var firstFocusableElement = modal.querySelectorAll(focusableElements)[0]; // get first element to be focused inside modal
    var focusableContent = modal.querySelectorAll(focusableElements);
    var lastFocusableElement = focusableContent[focusableContent.length - 1]; // get last element to be focused inside modal
    $(document).on('keydown', 'body', function (e) {
        var windowWidth = window.innerWidth;
        /**
         * Bail if desktop nav starts.
         */
        if (windowWidth > 990) {
            return;
        }
        var isTabPressed = e.key === 'Tab' || e.which == 9;
        if (!isTabPressed) {
            return;
        }
        if (e.shiftKey) {
            // if shift key pressed for shift + tab combination
            if (document.activeElement === firstFocusableElement) {
                lastFocusableElement.focus(); // add focus for the last focusable element
                e.preventDefault();
            }
        } else {
            // if tab key is pressed
            if (document.activeElement === lastFocusableElement) {
                // if focused has reached to last focusable element then focus first focusable element after pressing tab
                // firstFocusableElement.focus(); // add focus for the first focusable element
                closeBtn.focus(); // add focus for the first focusable element
                e.preventDefault();
            }
        }
    });
    // firstFocusableElement.focus();
    closeBtn.focus();
})
