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
                    <th>Request</th>
                    <th>Action</th>
                </tr>
            </thead>
            <tbody>
                <!-- <tr v-for="row in allUserRequesting" v-bind:key="row.id">
                    <td>{{ row.id }}</td>
                    <td>{{ row.user }}</td>
                    <td>{{ row.name }}</td>
                    <td>{{ row.created_at | formatDate }}</td>
                    <td>
                        <span v-bind:class="[row.request == 1 ? 'badge badge-success' : [row.request == 2 ? 'badge badge-danger' : 'badge badge-warning']]" v-text="row.request == 1 ? 'Approved' : row.request == 2 ? 'Denied' : 'Pending'"></span>
                    </td>
                    <td>{{ row.account_type.account }}</td>
                    <td>
                        <button class="btn btn-info" @click="modalUser(row.id)">Request</button>
                    </td>
                </tr> -->
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
                            <p><strong>Sponsor</strong> {{ sponsor.user }}</p>
                        </div>
                        <div class="form-group">
                            <p><strong>Total Amount</strong> {{ payments.amount }}</p>
                        </div>
                        <div class="form-group">
                            <p><strong>Type Document</strong> {{ typeDocuments.document }}</p>
                        </div>
                        <div class="form-group">
                            <p><strong>Nro Document</strong> {{ dataUser.nro_document }}</p>
                        </div>
                        <div class="form-group">
                            <p><strong>Method Payment</strong> {{ paymentMethod.name }}</p>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-danger" @click="approveDeny(dataUser.id, 2)">Deny</button>
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
            dataUser: [],
            sponsor: [],
            payments: [],
            typeDocuments: [],
            paymentMethod: []
        }
    },
    mounted() {
        $('#list-user-requests').DataTable({
            ajax: this.allUserRequesting
        });
    },
    methods: {
        modalUser(id) {
            $("#modalViewRequest").modal("show");
            axios.get(`user-request/get-user-by-id/${id}`)
            .then (r => {
                this.dataUser = r.data
                this.sponsor = this.dataUser.sponsor
                this.payments = this.dataUser.payments
                this.typeDocuments = this.dataUser.document_type
                this.paymentMethod = this.dataUser.payments.payment_method
            })
        },
        approveDeny(id, status){
            const form = {
                id: id,
                status: status,
            };

            axios.post(`user-request/update-request`, form)
            .then(r => {
                if(r.data.response == 200){
                    alert("Request accepted!")
                }else{
                    alert("Rejected request!")
                }
            })
        }
    }
}
</script>