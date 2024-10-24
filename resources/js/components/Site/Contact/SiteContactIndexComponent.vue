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
                    <h3>Informações Contato</h3>
                </div>

                <div v-show="this.contacts.length == 0" class="col-md-6 text-end">
                    <a :href="urlCreateContact" type="button" class="btn btn-primary btn-sm">Cadastrar</a>
                </div>
            </div>
        </div>

        <div v-if="loading === true" class="d-flex justify-content-center">
            <div class="spinner-border" role="status">
                <span class="visually-hidden">Loading...</span>
            </div>
        </div>

        <div v-else class="card-body">

            <div v-if="this.contacts.length == 0" class="text-center">
                <p>Nenhum resultado encontrado</p>
            </div>

            <div v-else class="table-responsive">
                <table class="table table-sm table-hover">
                    <thead>
                        <tr>
                            <th class="col-md-1">Telefone</th>
                            <th class="col-md-1">E-mail</th>
                            <th class="col-md-1">Cidade</th>
                            <th class="col-md-1">UF</th>
                            <th class="col-md-3">Endereço</th>
                            <th class="col-md-1">CEP</th>
                            <th class="col-md-1">Ações</th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr v-for="contact in contacts" :key="contact.id">
                            <td class="col-md-1">{{ contact.phone }}</td>
                            <td class="col-md-1">{{ contact.email }}</td>
                            <td class="col-md-1">{{ contact.city }}</td>
                            <td class="col-md-1">{{ contact.state }}</td>
                            <td class="col-md-3">{{ contact.address }}</td>
                            <td class="col-md-1">{{ contact.zipcode }}</td>
                            <td class="col-md-1">
                                <a :href="'/admin/site/contact/edit/' + contact.id">
                                    <i class="bi bi-pencil-square"></i>
                                </a>
                                &nbsp;&nbsp;&nbsp;
                                <button type="button" style="color: red; padding: 0;" class="btn" data-bs-toggle="modal"
                                    data-bs-target="#exampleModal" @click="confirmExclusion(contact.id)">
                                    <i class="bi bi-trash3"></i>
                                </button>
                            </td>
                        </tr>
                    </tbody>
                </table>
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
        urlCreateContact: String,
    },
    data() {
        return {
            contactToDelete: null,
            alertStatus: null,
            msg: [],
            loading: null,
            contacts: [],
        };
    },
    mounted() {
        this.getContact();
    },
    methods: {
        getContact() {
            this.loading = true;
            axios.get('admin/site/contact/list')
                .then(response => {
                    this.contacts = response.data.contacts;
                    console.log(this.contacts);

                })
                .catch(errors => {
                    this.alertStatus = 'error';
                }).finally(() => {
                    this.loading = false;
                });
        },
        confirmExclusion(contactId) {
            this.contactToDelete = contactId;
        },
        deleteRecord() {
            if (this.contactToDelete !== null) {
                axios.delete('/admin/site/contact/delete/' + this.contactToDelete)
                    .then(response => {
                        this.getContact();

                        const modal = Modal.getInstance(document.getElementById('exampleModal'));
                        if (modal) {
                            modal.hide();
                        }

                        if (response.data == '') {
                            this.alertStatus = 'notAllowed';
                        } else {
                            this.alertStatus = true;
                        }
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
    }
}
</script>
