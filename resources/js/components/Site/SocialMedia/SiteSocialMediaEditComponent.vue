<template>
    <div class="card">
        <div class="card-header">
            <div class="container">
                <div class="row">
                    <div class="col-sm">
                        <h4>Editar Rede Social</h4>
                    </div>
                    <div class="col-sm text-end">
                        <a href="https://icons.getbootstrap.com/" target="_blank">Biblioteca de ícones</a>&nbsp;&nbsp;
                        <i class="bi bi-info-circle fs-4" style="color: #00a803;" data-bs-toggle="tooltip"
                            data-bs-placement="top"
                            title="Ao adicionar o nome do ícone, você deve inserir sem as tags HTML"></i>
                    </div>
                </div>
            </div>
        </div>
        <div class="card-body">
            <div class="d-flex justify-content-center">
                <div v-if="loading" class="d-flex justify-content-center">
                    <div class="spinner-border" role="status">
                        <span class="visually-hidden">Loading...</span>
                    </div>
                </div>

                <form v-else method="POST" @submit.prevent="save()" class="col-lg-6" autocomplete="off">
                    <div v-if="alertStatus === true" class="alert alert-success alert-dismissible fade show"
                        role="alert">
                        <i class="fa-regular fa-circle-check"></i> Registro atualizado com sucesso
                        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                    </div>

                    <div v-if="alertStatus === false" class="alert alert-danger alert-dismissible fade show"
                        role="alert">
                        <i class="fa-regular fa-circle-xmark"></i> Erro ao atualizar registro
                        <hr>
                        <ul>
                            <li v-for="msg in messages.errors" :key="msg">{{ msg }}</li>
                        </ul>
                        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                    </div>

                    <div class="form-group">
                        <label>Nome</label>
                        <input type="text" class="form-control" v-model="socialmedia.name">
                    </div>

                    <div class="form-group">
                        <label>Ícone</label>
                        <input type="text" class="form-control" v-model="socialmedia.icon">
                    </div>

                    <div class="form-group">
                        <label>URL</label>
                        <input type="text" class="form-control" v-model="socialmedia.url">
                    </div>

                    <div class="row mt-5">
                        <div class="col-sm-6">
                            <div class="text-start">
                                <a :href="urlIndexSocialMedia" class="btn btn-secondary btn-sm">Voltar</a>
                            </div>
                        </div>
                        <div class="col-sm-6">
                            <div class="col text-end">
                                <button class="btn btn-primary btn-sm" type="submit">Atualizar</button>
                            </div>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
</template>

<script>
import axios from 'axios';

export default {
    props: {
        socialMediaById: {
            type: String,
            required: true
        },
        urlIndexSocialMedia: String,
    },
    data() {
        return {
            socialmedia: JSON.parse(this.socialMediaById),
            alertStatus: null,
            messages: [],
            loading: false,
        };
    },
    methods: {
        save() {
            this.loading = true;
            axios.post('/admin/site/social-media/update/' + this.socialmedia.id, this.socialmedia)
                .then(response => {
                    this.alertStatus = true;
                    this.messages = response.data;
                    this.loading = false;
                })
                .catch(errors => {
                    this.alertStatus = false;
                    this.messages = errors.response.data.errors || ['Erro desconhecido'];
                    this.loading = false;
                });
        },
    }
}
</script>
