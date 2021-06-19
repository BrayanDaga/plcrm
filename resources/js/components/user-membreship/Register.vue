<template>
    <div>
        <h2>Register User</h2>
        <form @submit.prevent="add">
            <div class="row">
                <div class="col-lg-3">
                    <div class="form-group">
                        <label for="user">User</label>
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
                        <input type="tel" id="phone" class="form-control" v-model="form.phone">
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
                            <option value="1">document type</option>
                        </select>
                    </div>
                    <div class="form-group">
                        <label for="nro_document">Nro. Document</label>
                        <input type="text" id="nro_document" class="form-control" v-model="form.nro_document">
                    </div>
                </div>
                <div class="col-lg-3">
                    <div class="form-group">
                        <label for="referrer_sponsor">Referrer/Sponsor</label>
                        <input type="text" id="referrer_sponsor" class="form-control" v-model="form.referrer_sponsor">
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
                            <option value="1">test account_type</option>
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
            validatePassword: false
        }
    },
    methods: {
        validateUser(){
            const user = this.form.user;
            axios.get(`/user-membreship/get-data-user/${user}`)
            .then(r => {
                console.log(r);
            })
            .catch(r => console.log(r));
        },
        add(){
            axios.post('/user-membreship/create', this.form)
        }
    }
}
</script>