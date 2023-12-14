/**
 * Copyright © Codfish Development. All rights reserved.
 * See COPYING.txt for license details.
 */

define([], function () {
    return function () {
        const customerServiceMenu = document.getElementById('assisted_cart_customer_service_menu_list');
        getSharableId(customerServiceMenu);
        const customerServiceMenuTrigger = document.getElementById('assisted-cart-menu-trigger');
        customerServiceMenuTrigger.addEventListener('mouseover', function(){
            getSharableId(customerServiceMenu);
            customerServiceMenu.style.display = 'flex !important';
        });
    }
});

function getSharableId(customerServiceMenu) {

    if (customerServiceMenu) {
        let xhr = new XMLHttpRequest();
        let url = '/rest/V1/assisted-cart/get-sharable-id';
        xhr.open("GET", url, true);

        xhr.onreadystatechange = function () {
            if (this.readyState === 4 && this.status === 200) {
                const sharableIdContainer = document.createElement('div');
                sharableIdContainer.classList.add('assisted_cart_sharable_id');
                sharableIdContainer.innerText = this.responseText;
                customerServiceMenu.append(sharableIdContainer);
            }
        }

        xhr.send();
    }
}
