<template>
    <div>
        <section id="basic-horizontal-layouts">
            <div class="row">
                <div class="col-md-12 col-12">
                    <div class="card">
                        <div class="card-header">
                            <h4 class="card-title">{{ editMode ? 'Edit Bank' : 'Add Bank' }}</h4>
                        </div>
                        <div class="card-body">
                            <form class="form form-horizontal">
                                <div class="row">
                                    <div class="col-12">
                                        <div class="form-group row">
                                            <div class="col-sm-3 col-form-label">
                                                <label for="bank-name">
                                                    Bank Name
                                                </label>
                                            </div>
                                            <div class="col-sm-9">
                                                <input
                                                    v-model="form.name"
                                                    type="text"
                                                    id="bank-name"
                                                    class="form-control"
                                                    name="name"
                                                    placeholder="Bank Name"
                                                />
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-sm-9 offset-sm-3">
                                        <button
                                            @click.prevent="submit"
                                            type="reset"
                                            class="btn btn-primary mr-1"
                                        >
                                            {{ editMode ? 'Edit' : 'Add' }}
                                        </button>
                                        <button
                                            @click.prevent="resetForm"
                                            type="reset"
                                            class="btn btn-outline-secondary"
                                        >
                                            Reset
                                        </button>
                                    </div>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </section>
        <div class="row" id="basic-table">
            <div class="col-12">
                <div class="card">
                    <div class="card-header">
                        <h4 class="card-title">BANK</h4>
                    </div>
                    <div class="card-body">
                        <div class="card-text">
                            This table lists all the Promolider banks
                        </div>
                    </div>

                    <div class="table-responsive">
                        <table class="table">
                            <thead>
                                <tr>
                                    <th>Nro</th>
                                    <th>Name</th>
                                    <th>Actions</th>
                                </tr>
                            </thead>
                            <tbody>
                                <tr>
                                    <td>1</td>
                                    <td style="width: 220px;">Interbank</td>
                                    <td>
                                        <div class="demo-inline-spacing">
                                            <button
                                                type="button"
                                                class="btn btn-outline-secondary round"
                                                @click.prevent="editBank"
                                            >
                                                Edit
                                            </button>
                                            <button
                                                type="button"
                                                class="btn btn-outline-danger round"
                                            >
                                                Delete
                                            </button>
                                            <button
                                                type="button"
                                                class="btn btn-outline-info round"
                                            >
                                                Detail
                                            </button>
                                        </div>
                                    </td>
                                </tr>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
</template>

<script>
const formBank = {
    name: ''
};
export default {
    data() {
        return {
            form: { ...formBank },
            editMode: false
        };
    },
    methods: {
        editBank() {
            this.editMode = true;
        },
        resetForm() {
            this.form = { ...formBank };
            this.editMode = false;
        },
        submit() {
            this.resetForm();
        }
    },
    name: 'Bank'
};
</script>

<style scoped></style>
