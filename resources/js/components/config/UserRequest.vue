<template>
    <div>
        <table id="list-user-requests" class="table">
            <thead>
                <tr>
                    <th>#</th>
                    <th>User</th>
                    <th>Name</th>
                    <th>Subcription Date</th> 
                    <th>Account Type</th>
                    <th>Action</th>
                </tr>
            </thead>
            <tbody>
                <tr v-for="row in allUserRequesting" v-bind:key="row.id">
                    <td>{{ row.id }}</td>
                    <td>{{ row.user }}</td>
                    <td>{{ row.name }}</td>
                    <td>{{ row.created_at | formatDate }}</td>
                    <td>{{ row.account_type.account }}</td>
                    <td>
                        <button class="btn btn-info" @click="modalUser(row.id)">Request</button>
                    </td>
                </tr>
            </tbody>
        </table>

        <!-- Modal View Request -->
        <div class="modal fade" id="modalViewRequest" tabindex="-1" aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title">User Information</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        <div class="form-group">
                            <p><strong>User</strong> {{ dataUser.user }}</p>
                        </div>
                        <div class="form-group">
                            <p><strong>Sponsor</strong> {{ dataUser.id_referrer_sponsor }}</p>
                        </div>
                        <div class="form-group">
                            <p><strong>Total Amount</strong> 0.00</p>
                        </div>
                        <div class="form-group">
                            <p><strong>Type Document</strong> {{ dataUser.id_document_type }}</p>
                        </div>
                        <div class="form-group">
                            <p><strong>Nro Document</strong> {{ dataUser.nro_document }}</p>
                        </div>
                        <div class="form-group">
                            <p><strong>Method Payment</strong> 1</p>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-danger" @click="approveDeny(dataUser.id, 0)">Deny</button>
                        <button type="button" class="btn btn-primary" @click="approveDeny(dataUser.id, 1)">Approve</button>
                    </div>
                </div>
            </div>
        </div>
    </div>
</template>
<script>
export default {
    props: ['allUserRequesting'],
    data() {
        return {
            dataUser: []
        }
    },
    methods: {
        modalUser(id) {
            $("#modalViewRequest").modal("show");
            // axios.get(`/api/user-request/get-user-by-id/${id}`)
            // .then (r => console.log(r.data))
            fetch(`/api/user-request/get-user-by-id/${id}`)
            .then (r => r.json())
            .then (r => this.dataUser = r)
        },
        approveDeny(id, status){
            fetch(`/api/user-request`)
        }
    }
}
</script>