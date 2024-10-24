<template>
    <div class="card">
        <div class="card-header">
            <h4>Editar Logo</h4>
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
                        <input type="text" class="form-control" v-model="main.main.title">
                    </div>

                    <div class="form-group">
                        <label>Texto</label>
                        <textarea class="form-control" rows="5" v-model="main.main.text"></textarea>
                    </div>

                    <div class="row mt-5">
                        <div class="col-sm-6">
                            <div class="text-start">
                                <a :href="urlIndexMainText" class="btn btn-secondary btn-sm">Voltar</a>
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
        mainTextById: {
            type: String,
            required: true
        },
        urlIndexMainText: String,
    },
    data() {
        return {
            main: {
                main: JSON.parse(this.mainTextById),
            },
            alertStatus: null,
            messages: [],
            loading: false,
        };
    },
    methods: {
        save() {
            this.loading = true;
            axios.post('/admin/site/main-text/update/' + this.main.main.id, this.main.main)
                .then(response => {
                    this.alertStatus = true;
                    this.messages = response.data;
                    this.loading = false;
                })
                .catch(errors => {
                    this.alertStatus = false;
                    this.messages = errors.response.data;
                    this.loading = false;
                });
        },
    }
}
</script>
