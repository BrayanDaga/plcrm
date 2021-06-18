<template>
    <div>
        <div>Aqui ira el branch</div>
        <div class="row" id="basic-table">
            <div class="col-12">
                <div class="card">
                    <div class="card-header">
                        <h4 class="card-title">Mis Directos</h4>
                    </div>
                    <div class="card-body">
                        <p class="card-text">
                            En la siguiente tabla encontrara los datos de sus directivos
                        </p>
                    </div>
                    <div class="table-responsive">
                        <table class="table">
                            <thead>
                                <tr>
                                    <th>Nombre</th>
                                    <th>Posicion</th>
                                    <th>Patrocinador</th>
                                    <th>Tipo de Documento</th>
                                    <th>Tipo de Cuenta</th>
                                    <th>Telefono</th>
                                    <th>Email</th>
                                    <th>Pais</th>
                                    <th>Fecha de inscripcion</th>
                                </tr>
                            </thead>
                            <tbody>
                                <tr
                                    v-for="tempUsers in this.usersMembreship"
                                    v-bind:key="tempUsers.id"
                                >
                                    <td>{{ tempUsers.name }}</td>
                                    <td>2</td>
                                    <td>{{ tempUsers.referrer_sponsor }}</td>
                                    <td>{{ tempUsers.document_type.document }}</td>
                                    <td>{{ tempUsers.account_type.account }}</td>
                                    <td>{{ tempUsers.phone }}</td>
                                    <td>{{ tempUsers.email }}</td>
                                    <td>{{ tempUsers.country.name }}</td>
                                    <td>{{ tempUsers.created_at | formatDate }}</td>
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
export default {
    data() {
        return {
            filter: {
                name: 'name',
                created_at: 'created_at',
            },
            usersMembreship: [],
        };
    },
    mounted() {
        const url = '/api/usersMembreship/list';
        axios
            .get(url, {
                params: {
                    sName: 'name',
                },
            })
            .then((response) => {
                this.usersMembreship = response.data.data;
                console.log(response.data.data);
            });
    },
    name: 'BinaryBranch',
};
</script>

<style scoped></style>
