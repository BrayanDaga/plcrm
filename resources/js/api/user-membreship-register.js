/**
 * Collection Name Payment
 */
const shippingFirstName = document.getElementsByName('shippingFirstName')[0];
const shippingLastName = document.getElementsByName('shippingLastName')[0];
const shippingEmail = document.getElementsByName('shippingEmail')[0];
const purchaseAmount = document.getElementsByName('purchaseAmount')[0];
const descriptionProducts = document.getElementsByName('descriptionProducts')[0];
const purchaseOperationNumber = document.getElementsByName('purchaseOperationNumber')[0];
const purchaseVerification = document.getElementsByName('purchaseVerification')[0];


/**
 * Collection IDs
 */
const openModalAlignetVpos2 = document.getElementById('open_modal_alignet_vpos2');
const accountTypes = document.getElementById('id_account_type');
const accountTypesPrice = document.getElementById('account_type-price');
const accountTypesIva = document.getElementById('account_type-iva');
const accountTypesTotalCostMembreship = document.getElementById('account_type-total_cost_membreship');

const email = document.getElementById('email');
const firstName = document.getElementById('name');
const lastName = document.getElementById('last_name');



//Select account type and get the amount total
const accountTypesChanged = (e) => {
    const id = parseInt(e.target.value);
    if (!id) {
        descriptionProducts.value = '';
        accountTypesPrice.value = '';
        accountTypesIva.value = '';
        accountTypesTotalCostMembreship.value = '';
        purchaseAmount.value = '';
        return false;
    }

    axios.get(`/api/account-type/get-data-id/${id}`)
        .then(r => {
            descriptionProducts.value = r.data.account
            outputPriceAccountType(r.data)
        });
};

const outputPriceAccountType = (d) => {
    const price = parseFloat(d.price);
    const iva = parseFloat(d.iva);

    const getIva = price * iva;
    const totalAmount = price + getIva;
    let total = totalAmount;

    accountTypesPrice.value = price.toFixed(2);
    accountTypesIva.value = getIva.toFixed(2);
    accountTypesTotalCostMembreship.value = total.toFixed(2);

    total = total.toString();
    total = total.split('.')[0] + total.split('.')[1];
    total = parseInt(total);
    purchaseAmount.value = total;
    shaPurchaseVerification(purchaseAmount.value)
}

const shaPurchaseVerification = (valueAmount = 0) => {
    axios.get(`/user-membreship/sha/${purchaseOperationNumber.value}/${valueAmount}`)
        .then(r => purchaseVerification.value = r.data)
}

accountTypes.addEventListener('change', (event) => accountTypesChanged(event));

const eventKeyInput = (e, elHidden) => setTimeout(() => elHidden.value = e.target.value, 100);

let eventInputForm = (el, elHidden) => el.addEventListener('keydown', (event) => eventKeyInput(event, elHidden), false);

eventInputForm(email, shippingEmail);
eventInputForm(firstName, shippingFirstName);
eventInputForm(lastName, shippingLastName);

openModalAlignetVpos2.addEventListener('click', () => {
    const a = AlignetVPOS2.openModal('https://integracion.alignetsac.com/', '1');
    console.log(a);
});