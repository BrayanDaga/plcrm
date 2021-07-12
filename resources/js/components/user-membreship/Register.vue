<template>
    <div>
        <div class="row">
            <div class="col-lg-6">
                <form @submit.prevent="add">
                    <input type="hidden" v-model="form.id_referrer_sponsor">
                    <h4>User</h4>
                    <hr>
                    <div class="d-flex flex-wrap">
                        <div class="form-group pr-1">
                            <label for="user">User <span v-if="validateUserMembreship" class="text-danger font-weight-bold pl-1">User Exists</span></label>
                            <input type="text" id="user" class="form-control" v-model="form.user" @keyup="validateUser">
                        </div>
                        <div class="form-group pr-1">
                            <label for="password">Password</label>
                            <input type="password" id="password" class="form-control" v-model="form.password">
                        </div>
                        <div class="form-group pr-1">
                            <label for="repassword">Re-Password <span v-if="form.repassword !== form.password" class="text-danger font-weight-bold pl-1">Passwords do not match</span></label>
                            <input type="password" id="repassword" class="form-control" v-model="form.repassword">
                        </div>
                        <div class="form-group pr-1">
                            <label for="email">Email</label>
                            <input type="email" id="email" class="form-control" v-model="form.email">
                        </div>
                    </div>
                    <h4>Personal Information</h4>
                    <hr>
                    <div class="d-flex flex-wrap">
                        <div class="form-group pr-1">
                            <label for="name">Name</label>
                            <input type="text" id="name" class="form-control" v-model="form.name">
                        </div>
                        <div class="form-group pr-1">
                            <label for="last_name">Last Name</label>
                            <input type="text" id="last_name" class="form-control" v-model="form.last_name">
                        </div>
                        <div class="form-group pr-1">
                            <label for="phone">Phones</label>
                            <input type="tel" id="phone" class="form-control" v-model="form.phone" maxlength="10">
                        </div>
                        <div class="form-group pr-1">
                            <label for="date_birth">Date Birth</label>
                            <input type="date" id="date_birth" class="form-control" v-model="form.date_birth">
                        </div>
                        <div class="form-group pr-1">
                            <label for="id_document_type">Document Type</label>
                            <select id="id_document_type" class="form-control" v-model="form.id_document_type">
                                <option v-for="dt in listDocumentType" v-bind:key="dt.id" :value="dt.id">{{ dt.document }}</option>
                            </select>
                        </div>
                        <div class="form-group pr-1">
                            <label for="nro_document">Nro. Document</label>
                            <input type="number" id="nro_document" class="form-control" v-model="form.nro_document" maxlength="12">
                        </div>
                        <div class="form-group pr-1">
                            <label for="id_country">Country</label>
                            <select id="id_country" class="form-control" v-model="form.id_country">
                                <option v-for="co in listCountry" v-bind:key="co.id" :value="co.id">{{ co.name }}</option>
                            </select>
                        </div>
                    </div>
                    <h4>Direct Sponsor</h4>
                    <hr>
                    <div class="d-flex flex-wrap">
                        <div class="form-group">
                            <label for="referrer_sponsor">Referrer/Sponsor</label>
                            <input type="text" id="referrer_sponsor" class="form-control" v-model="form.referrer_sponsor" disabled>
                        </div>
                    </div>
                    <h4>Membreship Data</h4>
                    <hr>
                    <div class="d-flex flex-wrap">
                        <div class="form-group pr-1">
                            <label for="id_account_type">Account Type</label>
                            <select id="id_account_type" class="form-control" @change="changeTablePrice($event)" v-model="form.id_account_type">
                                <option value="0">-------</option>
                                <option v-for="at in listAccountType" v-bind:key="at.id" :value="at.id">{{ at.account }}</option>
                            </select>
                        </div>
                        <div class="form-group pr-1" v-if="tablePrice">
                            <label for="price">Price</label>
                            <input type="text" id="price" class="form-control" v-model="form.price" disabled>
                        </div>
                        <div class="form-group pr-1" v-if="tablePrice">
                            <label for="iva">IVA</label>
                            <input type="text" id="iva" class="form-control" v-model="form.iva" disabled>
                        </div>
                        <div class="form-group pr-1" v-if="tablePrice">
                            <label for="total_cost_membreship">Total cost of Membreship</label>
                            <input type="text" id="total_cost_membreship" class="form-control" v-model="form.total_cost_membreship" disabled>
                        </div>
                    </div>
                    <h4>Payment Methods</h4>
                    <div class="d-flex flex-wrap">
                        <div class="form-group pr-1">
                            <label for="id_payment_method">Select Type of Payment</label>
                            <select id="id_payment_method" class="form-control" v-model="form.id_payment_method">
                                <option value="0">-------</option>
                                <option v-for="pm in listPaymentMethods" v-bind:key="pm.id" :value="pm.id">{{ pm.name }}</option>
                            </select>
                        </div>
                    </div>
                    <button type="submit" class="btn btn-success">Register</button>
                </form>
            </div>
        </div>
    </div>
</template>
<script>
export default {
    props: ['documentType', 'accountType', 'country', 'idReferrerSponsor', 'sponsorName', 'paymentMethods'],
    data(){
        return {
            form: {
                id_referrer_sponsor:'',
                user:'',
                password:'',
                repassword:'',
                email:'',
                name:'',
                last_name:'',
                phone:'',
                date_birth:'',
                id_document_type:'',
                nro_document:'',
                referrer_sponsor:'',
                id_country:'',
                id_account_type:'',
                price:'',
                iva:'',
                total_cost_membreship:'',
                id_payment_method:'',
            },
            validateUserMembreship: false,
            listDocumentType: [],
            listAccountType: [],
            listCountry: [],
            listPaymentMethods: [],
            tablePrice: false
        }
    },
    created(){
        this.form.id_referrer_sponsor = this.idReferrerSponsor;
        this.form.referrer_sponsor = this.sponsorName;
        this.listDocumentType = this.documentType
        this.listAccountType = this.accountType
        this.listCountry = this.country
        this.listPaymentMethods = this.paymentMethods
    },
    methods: {
        validateUser(){
            const user = this.form.user;
            axios.get(`/user-membreship/get-data-user/${user}`)
            .then(r => {
                if(Array.isArray(r.data) && r.data.length){
                    if(r.data[0].user == user){
                        this.validateUserMembreship = true;
                    }
                }else{
                    this.validateUserMembreship = false;
                }
            })
            .catch(r => console.log(r));
        },
        validateDate(){
            const now = new Date();
            const yearCurrent = now.getFullYear();
            
            const dateBirth = new Date(this.form.date_birth);
            const yearBirth = dateBirth.getFullYear();

            const yearsDiff = yearCurrent - yearBirth;
            return yearsDiff;
        },
        add(){
            if(this.validateDate() <= 18){
                alert("You need to be at least 18 years");
                return false;    
            }

            if(this.form.id_payment_method == 0){
                alert("Select a payment of type")
                return false;
            }
            
            axios.post('/user-membreship/create', this.form)
        },
        changeTablePrice: function(e){
            const id = parseInt(e.target.value);
            this.tablePrice = id ? true : false;
            axios.get(`/api/account-type/get-data-id/${id}`)
            .then (r => this.outputPriceAccountType(r.data))
        },
        outputPriceAccountType: function(d){
            /**
             * Exite un tiempo de respuesta lenta que retrasa en mostrar la peticion de datos
             */
            const price = parseFloat(d.price);
            const iva = parseFloat(d.iva);

            const getIva = price * iva;
            const totalAmount = price + getIva;
            const total = totalAmount;
            
            this.form.price = price.toFixed(2);
            this.form.iva = getIva.toFixed(2);
            this.form.total_cost_membreship = total.toFixed(2);
        }
    },
    mounted() {
        const idDocumentType = document.getElementById('id_document_type');
        idDocumentType.selectedIndex = 0;

        const idAccountType = document.getElementById('id_account_type');
        idAccountType.selectedIndex = 0;

        const idCountry = document.getElementById('id_country');
        idCountry.selectedIndex = 0;

        const idPaymentMethod = document.getElementById('id_payment_method');
        idPaymentMethod.selectedIndex = 0;
    }
}

</script>