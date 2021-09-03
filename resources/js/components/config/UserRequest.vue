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
            sponsor: Object,
            payments: [],
            typeDocuments: [],
            paymentMethod: []
        }
    },
    mounted() {
        this.loadDataTable();
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
        },
        loadDataTable(){
             $('#list-user-requests').DataTable({
                destroy: true,
                select: false,
                data: this.allUserRequesting,
                columns: [
                    {data: 'id'},
                    {data: 'user'},
                    {data: 'name'},
                    {data: 'created_at'},
                    {data: 'account_type.account'},
                    {
                        orderable: false,
                        render: (d, t, f, m) => this.statusRequest(f.request)
                    },
                    {
                        orderable: false,
                        render: (d, t, f, m) => this.btnModalDetails(m.row)
                    }
                ],
                rowCallback: (r, d, i) => {
                    setTimeout(() => {
                        let rowUser = document.getElementById(`user-${i}`);
                        rowUser.addEventListener('click', () => this.modalUser(d.id))
                    }, 100)
                }
            });
        },
        statusRequest(s){
            let r = '<span class="badge badge-danger">Error Data</span>';
            if(s == 1){
                r = `<span class="badge badge-warning">Pending</span>`;
            }else if(s == 2){
                r = `<span class="badge badge-success">Accepted</span>`;
            }else if(s == 3){
                r = `<span class="badge badge-danger">Rejected</span>`;
            }
            return r;
        },
        btnModalDetails(r){
            const btn = `<button id="user-${r}" class="btn btn-info">Ver Detalles</button>`;
            return btn;
        }
    }
}
</script>