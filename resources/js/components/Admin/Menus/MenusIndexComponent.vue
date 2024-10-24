<template>
    <div v-if="this.alertStatus === true" class="alert alert-success alert-dismissible fade show" role="alert">
        <i class="fa-regular fa-circle-check"></i> Registro exluido com sucesso
        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
    </div>
    <div class="card">
        <div class="card-header">
            <div class="row align-items-center">
                <div class="col-12 col-md-3 text-md-left text-center mb-2 mb-md-0">
                    <h3>Menus</h3>
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
                    <a :href="urlCreateMenu" type="button" class="btn btn-primary btn-sm">Cadastrar</a>
                </div>
            </div>
        </div>
        <div class="card-body">

            <div v-if="loading" class="d-flex justify-content-center">
                <div class="spinner-border" role="status">
                    <span class="visually-hidden">Loading...</span>
                </div>
            </div>

            <table v-else class="table table-sm table-hover">
                <thead>
                    <tr>
                        <th scope="col">#</th>
                        <th scope="col">Nome</th>
                        <th scope="col">Ícone</th>
                        <th scope="col">Url</th>
                        <th scope="col">Ações</th>
                    </tr>
                </thead>
                <tbody>
                    <tr v-for="menu in menus.data" :key="menu.id">
                        <th scope="row">{{ menu.id }}</th>
                        <td>{{ menu.label }}</td>
                        <td><i :class="menu.icon"></i></td>
                        <td>{{ menu.url }}</td>
                        <td>
                            <a :href="'menu/edit/' + menu.id">
                                <i class="bi bi-pencil-square"></i>
                            </a>
                            &nbsp;&nbsp;&nbsp;

                            <button type="button" style="color: red; padding: 0;" class="btn"
                                @click="confirmExclusion(menu.id)" data-bs-toggle="modal"
                                data-bs-target="#exampleModal">
                                <i class="bi bi-trash3"></i>
                            </button>
                        </td>
                    </tr>
                </tbody>
            </table>
        </div>
        <div class="card-footer">
            <nav aria-label="Page navigation example">
                <ul class="pagination justify-content-center">
                    <li v-for="(link, key) in menus.links" :key="key" class="page-item"
                        :class="{ 'active': link.active }">
                        <a class="page-link" href="#" @click.prevent="pagination(link.url)" v-html="link.label"></a>
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
        urlCreateMenu: String,
    },
    data() {
        return {
            menus: {
                data: [],
                links: []
            },
            searchFilter: '',
            menuToDelete: null,
            alertStatus: null,
            msg: [],
            loading: null,
        };
    },
    mounted() {
        this.getMenus();
    },
    methods: {
        pesquisar() {
            this.getUsuarios('admin/menu/list', this.searchFilter);
        },
        pagination(url) {
            if (url) {
                this.getUsuarios(url);
            }
        },
        getMenus(url = 'admin/menu/list') {
            this.loading = true;
            axios.get(url)
                .then(response => {
                    this.menus = response.data.menus;
                })
                .catch(errors => {

                }).finally(() => {
                    this.loading = false
                });
        },
        confirmExclusion(menuId) {
            this.menuToDelete = menuId;
        },
        excluirRegistro() {
            if (this.menuToDelete !== null) {
                axios.delete('/admin/menu/delete/' + this.menuToDelete)
                    .then(response => {
                        this.getMenus();
                        this.menuToDelete = null;
                        // Fecha a modal

                        const modal = Modal.getInstance(document.getElementById('exampleModal'));
                        if (modal) {
                            modal.hide();
                        }

                        this.alertStatus = true;
                    })
                    .catch(errors => {
                        const modal = Modal.getInstance(document.getElementById('exampleModal'));
                        if (modal) {
                            modal.hide();
                        }

                        this.alertStatus = false;
                    });
            }
        },
    }
}
</script>