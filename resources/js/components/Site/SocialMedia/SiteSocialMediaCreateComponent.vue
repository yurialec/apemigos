<template>
    <div class="card">
        <div class="card-header">
            <div class="container">
                <div class="row">
                    <div class="col-sm">
                        <h4>Cadastrar Rede Social</h4>
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
                <form method="POST" @submit.prevent="save" class="col-lg-6" autocomplete="off">
                    <div v-if="alertStatus === true" class="alert alert-success alert-dismissible fade show"
                        role="alert">
                        <i class="fa-regular fa-circle-check"></i> Registro cadastrado com sucesso
                        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                    </div>

                    <div v-if="alertStatus === 'notAllowed'" class="alert alert-warning alert-dismissible fade show"
                        role="alert">
                        <i class="fa-solid fa-triangle-exclamation"></i> Você não tem permissão para acessar essa
                        funcionalidade
                        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                    </div>

                    <div v-if="alertStatus === false" class="alert alert-danger alert-dismissible fade show"
                        role="alert">
                        <i class="fa-regular fa-circle-xmark"></i> Erro ao atualizar registro
                        <hr>
                        <ul v-for="messages in messages.data.errors" :key="messages[0]">
                            <li>{{ messages[0] }}</li>
                        </ul>
                        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                    </div>

                    <div v-if="this.alertStatus == 'maxchars'" class="alert alert-danger alert-dismissible fade show"
                        role="alert">
                        <i class="fa-regular fa-circle-xmark"></i> Você atingiu o máximo de caracteres
                        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                    </div>

                    <div class="form-group">
                        <label>Nome</label>
                        <input type="text" required class="form-control" v-model="media.name">
                    </div>
                    <div class="form-group">
                        <label>Icone</label>
                        <input type="text" required class="form-control" v-model="media.icon">
                    </div>
                    <div class="form-group">
                        <label>URL</label>
                        <input type="text" required class="form-control" v-model="media.url">
                    </div>

                    <div class="row mt-5">
                        <div class="col-sm-6">
                            <div class="text-start">
                                <a :href="urlIndexSocialMedia" class="btn btn-secondary btn-sm">Voltar</a>
                            </div>
                        </div>
                        <div class="col-sm-6">
                            <div class="col text-end">
                                <button class="btn btn-primary btn-sm" type="submit">Cadastrar</button>
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
        urlIndexSocialMedia: String,
    },
    data() {
        return {
            media: {
                name: '',
                icon: '',
                url: '',
            },
            alertStatus: null,
            messages: [],
        };
    },
    methods: {
        save() {
            axios.post('/admin/site/social-media/store', this.media)
                .then(response => {
                    this.alertStatus = true;
                    this.messages = response.data;
                })
                .catch(errors => {
                    this.alertStatus = false;
                    this.messages = errors.response;
                });
        },
    }
}
</script>
