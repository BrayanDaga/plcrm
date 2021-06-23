<template>
    <div>
        <h2>Register User</h2>
        <form @submit.prevent="add">
            <div class="row">
                <div class="col-lg-3">
                    <div class="form-group">
                        <label for="user">User <span v-if="validateUserMembreship" class="text-danger font-weight-bold pl-1">User Exists</span></label>
                        <input type="text" id="user" class="form-control" v-model="form.user" @keyup="validateUser">
                    </div>
                    <div class="form-group">
                        <label for="password">Password</label>
                        <input type="password" id="password" class="form-control" v-model="form.password">
                    </div>
                    <div class="form-group">
                        <label for="repassword">Re-Password <span v-if="form.repassword !== form.password" class="text-danger font-weight-bold pl-1">Passwords do not match</span></label>
                        <input type="password" id="repassword" class="form-control" v-model="form.repassword">
                    </div>
                    <div class="form-group">
                        <label for="email">Email</label>
                        <input type="email" id="email" class="form-control" v-model="form.email">
                    </div>
                </div>
                <div class="col-lg-3">
                    <div class="form-group">
                        <label for="name">Name</label>
                        <input type="text" id="name" class="form-control" v-model="form.name">
                    </div>
                    <div class="form-group">
                        <label for="last_name">Last Name</label>
                        <input type="text" id="last_name" class="form-control" v-model="form.last_name">
                    </div>
                    <div class="form-group">
                        <label for="phone">Phones</label>
                        <input type="tel" id="phone" class="form-control" v-model="form.phone" maxlength="10">
                    </div>
                    <div class="form-group">
                        <label for="date_birth">Date Birth</label>
                        <input type="date" id="date_birth" class="form-control" v-model="form.date_birth">
                    </div>
                </div>
                <div class="col-lg-3">
                    <div class="form-group">
                        <label for="id_document_type">Document Type</label>
                        <select id="id_document_type" class="form-control" v-model="form.id_document_type">
                            <option v-for="dt in listDocumentType" v-bind:key="dt.id" :value="dt.id">{{ dt.document }}</option>
                        </select>
                    </div>
                    <div class="form-group">
                        <label for="nro_document">Nro. Document</label>
                        <input type="number" id="nro_document" class="form-control" v-model="form.nro_document" maxlength="12">
                    </div>
                </div>
                <div class="col-lg-3">
                    <div class="form-group">
                        <label for="referrer_sponsor">Referrer/Sponsor</label>
                        <input type="text" id="referrer_sponsor" class="form-control" v-model="form.referrer_sponsor" value="Admin">
                    </div>
                    <div class="form-group">
                        <label for="id_country">Country</label>
                        <select id="id_country" class="form-control" v-model="form.id_country">
                            <option value="1">test country</option>
                        </select>
                    </div>
                    <div class="form-group">
                        <label for="id_account_type">Account Type</label>
                        <select id="id_account_type" class="form-control" v-model="form.id_account_type">
                            <option v-for="at in listAccountType" v-bind:key="at.id" :value="at.id">{{ at.account }}</option>
                        </select>
                    </div>
                </div>
                <div class="col-lg-12">
                    <button type="submit" class="btn btn-success">Register</button>
                </div>
            </div>
        </form>
    </div>
</template>
<script>
export default {
    props: ['documentType', 'accountType'],
    data(){
        return {
            form: {
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
                id_account_type:''
            },
            validateUserMembreship: false,
            listDocumentType: [],
            listAccountType: []
        }
    },
    created(){
        this.listDocumentType = this.documentType
        this.listAccountType = this.accountType
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
        add(){
            axios.post('/user-membreship/create', this.form)
        }
    },
    mounted() {
        const idDocumentType = document.getElementById('id_document_type');
        idDocumentType.selectedIndex = 0;

        const idAccountType = document.getElementById('id_account_type');
        idAccountType.selectedIndex = 0;
    }
}

</script>