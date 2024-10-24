<template>
    <div v-if="this.alertStatus === true" class="alert alert-success alert-dismissible fade show" role="alert">
        <i class="fa-regular fa-circle-check"></i> Registro exluido com sucesso
        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
    </div>
    <div class="card">
        <div class="card-header">
            <div class="row align-items-center">
                <div class="col-12 col-md-3 text-md-left text-center mb-2 mb-md-0">
                    <h3>Permissões</h3>
                </div>
                <div class="col-12 col-md-6 text-center mb-2 mb-md-0">
                    <div class="input-group">
                        <input type="text" class="form-control" v-model="searchFilter" />
                        <button type="button" class="btn btn-primary" @click="pesquisar()">
                            <i class="bi bi-search"></i>
                        </button>
                    </div>
                </div>
                <div class="col-12 col-md-3 text-md-end text-end">
                    <a :href="urlCreatePermission" type="button" class="btn btn-primary btn-sm">Cadastrar</a>
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
                            <th scope="col" class="text-center">#</th>
                            <th scope="col" class="text-center">Nome</th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr v-for="permission in permissions.data" :key="permission.id">
                            <td class="text-center">{{ permission.id }}</td>
                            <td class="text-center">{{ permission.label }}</td>
                        </tr>
                    </tbody>
                </table>
            </div>
        </div>
        <div class="card-footer">
            <nav aria-label="Page navigation example">
                <ul class="pagination justify-content-center">
                    <li v-for="(link, key) in permissions.links" :key="key" class="page-item"
                        :class="{ 'active': link.active }">
                        <a class="page-link" href="#" @click.prevent="paginacao(link.url)" v-html="link.label"></a>
                    </li>
                </ul>
            </nav>
        </div>
    </div>

    <div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Confirmação de Exclusão</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    Tem certeza que deseja deletar este registro?
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancelar</button>
                    <button type="button" class="btn btn-danger" @click="excluirRegistro">Excluir</button>
                </div>
            </div>
        </div>
    </div>
</template>

<script>
import axios from 'axios';
import { Modal } from 'bootstrap';

export default {
    props: {
        urlCreatePermission: String,
    },
    data() {
        return {
            permissions: {
                data: [],
                links: []
            },
            searchFilter: '',
            permissionToDelete: null,
            alertStatus: null,
            msg: [],
            loading: null,
        };
    },
    mounted() {
        this.getPermissions();
    },
    methods: {
        confirmarExclusao(permissionId) {
            this.permissionToDelete = permissionId;
        },
        excluirRegistro() {
            if (this.permissionToDelete !== null) {
                axios.delete('/admin/permissions/delete/' + this.permissionToDelete)
                    .then(response => {
                        this.getPermissions();
                        this.permissionToDelete = null;
                        // Fecha a modal
                        const modal = Modal.getInstance(document.getElementById('exampleModal'));
                        if (modal) {
                            modal.hide();
                        }

                        this.alertStatus = true;
                    })
                    .catch(errors => {

                    });
            }
        },
        pesquisar() {
            this.getPermissions(`/admin/permissions/list?search=${this.searchFilter}`);
        },
        paginacao(url) {
            if (url) {
                this.getPermissions(url);
            }
        },
        getPermissions(url = '/admin/permissions/list') {
            this.loading = true;
            axios.get(url)
                .then(response => {
                    this.permissions = response.data.permission;

                })
                .catch(errors => {

                }).finally(() => {
                    this.loading = false;
                });
        },
    }
}
</script>