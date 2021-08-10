/**
 * Collection IDs
 */
const openModalAlignetVpos2 = document.getElementById('open_modal_alignet_vpos2');
const accountTypes = document.getElementById('id_account_type');

//Select account type and get the amount total
const accountTypesChanged = (e) => {
    console.log(e.target);
};
accountTypes.addEventListener('change', (event) => accountTypesChanged(event));

openModalAlignetVpos2.addEventListener('click', () => {
    AlignetVPOS2.openModal('https://integracion.alignetsac.com/', '1');
});