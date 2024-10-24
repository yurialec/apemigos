<template>
    <div v-if="this.alertStatus === true" class="alert alert-success alert-dismissible fade show" role="alert">
        <i class="fa-regular fa-circle-check"></i> Registro exluido com sucesso
        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
    </div>
    <div class="card">
        <div class="card-header">
            <div class="row">
                <div class="col-sm-3 text-left">
                    <h3>Perfis</h3>
                </div>
                <div class="col-sm-6">
                    <div class="input-group">
                        <input type="text" class="form-control" v-model="searchFilter" />
                        <button type="button" class="btn btn-primary" @click="pesquisar()">
                            <i class="bi bi-search"></i>
                        </button>
                    </div>
                </div>
            </div>
        </div>

        <div v-if="loading" class="d-flex justify-content-center">
            <div class="spinner-border" role="status">
                <span class="visually-hidden">Loading...</span>
            </div>
        </div>

        <div v-else class="card-body">
            <div class="table-responsive">
                <table class="table table-sm table-hover">
                    <thead>
                        <tr>
                            <th>#</th>
                            <th>Nome</th>
                            <th>Permissões</th>
                            <th>Ações</th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr v-for="role in this.roles.data" :key="role.id">
                            <th>{{ role.id }}</th>
                            <td>{{ role.name }}</td>

                            <td>
                                <span v-for="permission in role['permissions']" class="badge bg-success"
                                    id="span-role-permissions">{{ permission.label }}</span>&nbsp;
                            </td>

                            <td>
                                <a :href="'roles/edit/' + role.id">
                                    <i class="bi bi-pencil-square"></i>
                                </a>
                            </td>
                        </tr>
                    </tbody>
                </table>
            </div>
        </div>
        <div class="card-footer">
            <nav aria-label="Page navigation example">
                <ul class="pagination justify-content-center">
                    <li v-for="(link, key) in roles.links" :key="key" class="page-item"
                        :class="{ 'active': link.active }">
                        <a class="page-link" href="#" @click.prevent="paginacao(link.url)" v-html="link.label"></a>
                    </li>
                </ul>
            </nav>
        </div>
    </div>
</template>

<script>
import axios from 'axios';

export default {
    props: {
        urlCreateRole: String,
    },
    data() {
        return {
            roles: {
                data: [],
                links: []
            },
            searchFilter: '',
            alertStatus: null,
            msg: [],
            loading: null,
        };
    },
    mounted() {
        this.getRoles();
    },
    methods: {
        confirmarExclusao(roleId) {
            this.roleToDelete = roleId;
        },
        pesquisar() {
            this.getRoles(`/admin/roles/list?search=${this.searchFilter}`);
        },
        paginacao(url) {
            if (url) {
                this.getRoles(url);
            }
        },
        getRoles(url = '/admin/roles/list') {
            this.loading = true;
            axios.get(url)
                .then(response => {
                    this.roles = response.data.roles;
                })
                .catch(errors => {

                }).finally(() => {
                    this.loading = false;
                });
        }
    }
}
</script>