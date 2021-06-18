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
                                    <th>Pierna Afiliacion</th>
                                    <th>Patrocinador Binario</th>
                                    <th>Fecha de inscripcion</th>
                                    <th>Fecha de Vencimiento</th>
                                    <th>Activo</th>
                                    <th>Calificado</th>
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
                                    <td>{{ tempUsers.created_at | formatDate }}</td>
                                    <td>5</td>
                                    <td>6</td>
                                    <td>7</td>
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
                this.usersMembreship = response.data;
                console.log(response.data);
            });
    },
    name: 'BinaryBranch',
};
</script>

<style scoped></style>
