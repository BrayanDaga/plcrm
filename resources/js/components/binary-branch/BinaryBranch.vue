<template>
    <div>
        <custom-spinner v-if="initialLoading"></custom-spinner>
        <template v-if="!initialLoading">
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
                                        <td>
                                            <p style="width: 220px">
                                                {{ tempUsers.name }}
                                            </p>
                                        </td>

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

                        <!-- Separated Pagination starts -->
                        <div class="col-md-6 col-sm-12">
                            <div class="card">
                                <nav aria-label="Page navigation example">
                                    <ul class="pagination justify-content-center mt-2">
                                        <li
                                            v-if="pagination.current_page > 1"
                                            class="page-item prev-item"
                                        >
                                            <a
                                                href="#"
                                                @click.prevent="
                                                    changePage(pagination.current_page - 1)
                                                "
                                                class="page-link"
                                            ></a>
                                        </li>
                                        <template v-for="page in pagesNumber">
                                            <li
                                                class="page-item"
                                                v-bind:class="[page === isActive && 'active']"
                                            >
                                                <a
                                                    href="#"
                                                    class="page-link"
                                                    @click.prevent="changePage(page)"
                                                >
                                                    {{ page }}
                                                </a>
                                            </li>
                                        </template>
                                        <li
                                            v-if="pagination.current_page < pagination.last_page"
                                            class="page-item next-item"
                                        >
                                            <a
                                                href="#"
                                                @click.prevent="
                                                    changePage(pagination.current_page + 1)
                                                "
                                                class="page-link"
                                            ></a>
                                        </li>
                                    </ul>
                                </nav>
                            </div>
                        </div>
                    </div>
                    <!-- Separated Pagination ends -->
                </div>
            </div>
        </template>
    </div>
</template>

<script>
import apiUserMembreship from '../../api/api.user-membreship';
import CustomSpinner from '../custom-spinner/CustomSpinner';

export default {
    components: { CustomSpinner },
    created() {
        this.getUsersMembreship();
    },
    data() {
        return {
            initialLoading: true,
            filter: {
                name: 'name',
                created_at: 'created_at',
            },
            pagination: {
                total: 0,
                current_page: 0,
                per_page: 0,
                last_page: 0,
                from: 0,
                to: 0,
            },
            offset: 2,
            usersMembreship: [],
        };
    },
    computed: {
        isActive: function () {
            return this.pagination.current_page;
        },
        pagesNumber: function () {
            if (!this.pagination.to) {
                return [];
            }

            let from = this.pagination.current_page - this.offset;
            if (from < 1) {
                from = 1;
            }
            let to = from + this.offset * 2;
            if (to >= this.pagination.last_page) {
                to = this.pagination.last_page;
            }

            const pagesArray = [];
            while (from <= to) {
                pagesArray.push(from);
                from++;
            }
            return pagesArray;
        },
    },
    methods: {
        getUsersMembreship: function (page) {
            apiUserMembreship.list(page).then((response) => {
                this.usersMembreship = response.result.data;
                this.pagination = response.pagination;
                this.initialLoading = false;
            });
        },
        changePage: function (page) {
            this.pagination.current_page = page;
            this.getUsersMembreship(page);
        },
    },
    name: 'BinaryBranch',
};
</script>

<style scoped></style>
