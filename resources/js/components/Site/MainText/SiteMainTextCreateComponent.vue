<template>
    <div class="card">
        <div class="card-header">
            <h4>Cadastrar Conteúdo Principal</h4>
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

                        <div v-if="this.alertStatus == 'maxchars'"
                            class="alert alert-danger alert-dismissible fade show" role="alert">
                            <i class="fa-regular fa-circle-xmark"></i> Você atingiu o máximo de caracteres
                            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                        </div>

                        <div class="form-group">
                            <label>Titulo</label>
                            <input type="text" class="form-control" v-model="main.title">
                        </div>

                        <div class="form-group">
                            <label>Texto</label>
                            <textarea class="form-control" v-model="main.text"></textarea>

                            <small v-show="main.text.length > 255" style="color: red;">Você atingiu o máximo de
                                caracteres</small>
                        </div>

                        <div class="row mt-5">
                            <div class="col-sm-6">
                                <div class="text-start">
                                    <a :href="urlIndexMainText" class="btn btn-secondary btn-sm">Voltar</a>
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
        urlIndexMainText: String,
    },
    data() {
        return {
            main: {
                title: '',
                text: '',
            },
            alertStatus: null,
            messages: [],
        };
    },
    methods: {
        save() {

            if (this.main.text.length > 255) {
                this.alertStatus = 'maxchars';
                return;
            }

            axios.post('/admin/site/main-text/store', this.main)
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
