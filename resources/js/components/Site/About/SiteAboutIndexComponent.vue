<template>
    <div v-if="alertStatus === true" class="alert alert-success alert-dismissible fade show" role="alert">
        <i class="fa-regular fa-circle-check"></i> Registro excluído com sucesso
        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
    </div>

    <div v-if="alertStatus === 'notAllowed'" class="alert alert-warning alert-dismissible fade show" role="alert">
        <i class="fa-solid fa-triangle-exclamation"></i> Você não tem permissão para acessar essa funcionalidade
        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
    </div>

    <div class="card">
        <div class="card-header">
            <div class="row">
                <div class="col-md-6 text-start">
                    <h3>Sobre</h3>
                </div>

                <div v-show="this.abouts.length == 0" class="col-md-6 text-end">
                    <a :href="urlCreateAbout" type="button" class="btn btn-primary btn-sm">Cadastrar</a>
                </div>
            </div>
        </div>

        <div v-if="loading === true" class="d-flex justify-content-center">
            <div class="spinner-border" role="status">
                <span class="visually-hidden">Loading...</span>
            </div>
        </div>

        <div v-else class="card-body">

            <div v-if="this.abouts.length == 0" class="text-center">
                <p>Nenhum resultado encontrado</p>
            </div>

            <div v-else class="table-responsive">
                <table class="table table-sm table-hover">
                    <thead>
                        <tr>
                            <th class="col-md-3">Preview Imagem</th>
                            <th class="col-md-3">Título</th>
                            <th class="col-md-3">Descrição</th>
                            <th class="col-md-3">Ações</th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr v-for="about in abouts" :key="about.id">
                            <td class="col-md-3"><img :src="'/storage/' + about.image" width="80"></td>
                            <td class="col-md-3">{{ about.title }}</td>
                            <td class="col-md-3"
                                style="max-width:100px; white-space: nowrap; overflow: hidden; text-overflow: ellipsis">
                                {{ about.description }}
                            </td>
                            <td class="col-md-3">
                                <button type="button" style="color: #333; padding: 0;" class="btn"
                                    data-bs-toggle="modal" data-bs-target="#viewImgModal" @click="viewImage(about)">
                                    <i class="bi bi-eye"></i>
                                </button>
                                &nbsp;&nbsp;&nbsp;
                                <a :href="'/admin/site/site-about/edit/' + about.id">
                                    <i class="bi bi-pencil-square"></i>
                                </a>
                                &nbsp;&nbsp;&nbsp;
                                <button type="button" style="color: red; padding: 0;" class="btn" data-bs-toggle="modal"
                                    data-bs-target="#exampleModal" @click="confirmExclusion(about.id)">
                                    <i class="bi bi-trash3"></i>
                                </button>
                            </td>
                        </tr>
                    </tbody>
                </table>
            </div>
        </div>
    </div>

    <div class="modal fade" id="viewImgModal" tabindex="-1" aria-labelledby="viewImgModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="viewImgModalLabel">Visualizar imagem</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <div style="text-align: center;">
                        <img :src="'/storage/' + selectedAbout.image" width="450">
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Modal de confirmação de exclusão -->
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
                    <button type="button" class="btn btn-danger" @click="deleteRecord">Excluir</button>
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
        urlCreateAbout: String,
    },
    data() {
        return {
            aboutToDelete: null,
            alertStatus: null,
            msg: [],
            loading: null,
            abouts: [],
            selectedAbout: {},
        };
    },
    mounted() {
        this.getAbout();
    },
    methods: {
        getAbout() {
            this.loading = true;
            axios.get('admin/site/site-about/list')
                .then(response => {
                    this.abouts = response.data.abouts;
                })
                .catch(errors => {
                    this.alertStatus = 'error';
                }).finally(() => {
                    this.loading = false;
                });
        },
        confirmExclusion(aboutId) {
            this.aboutToDelete = aboutId;
        },
        deleteRecord() {
            if (this.aboutToDelete !== null) {
                axios.delete('/admin/site/site-about/delete/' + this.aboutToDelete)
                    .then(response => {
                        this.getAbout();
                        this.aboutToDelete = null;

                        const modal = Modal.getInstance(document.getElementById('exampleModal'));
                        if (modal) {
                            modal.hide();
                        }

                        this.alertStatus = response.data === '' ? 'notAllowed' : true;
                    })
                    .catch(errors => {
                        const modal = Modal.getInstance(document.getElementById('exampleModal'));
                        if (modal) {
                            modal.hide();
                        }

                        if (errors.response.status == 405) {
                            this.alertStatus = 'notAllowed';
                        }
                    });
            }
        },
        viewImage(about) {
            this.selectedAbout = about;
        },
    }
}
</script>
