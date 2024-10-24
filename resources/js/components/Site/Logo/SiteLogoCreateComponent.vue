<template>
    <div class="card">
        <div class="card-header">
            <h4>Cadastrar logotipo</h4>
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

                    <div class="form-group">
                        <label>Nome</label>
                        <input type="text" class="form-control" v-model="logo.name">
                    </div>

                    <div class="form-group">
                        <label>Imagem</label>
                        <input type="file" class="form-control" @change="loadImage">
                    </div>

                    <div class="row mt-5">
                        <div class="col-sm-6">
                            <div class="text-start">
                                <a :href="urlIndexLogo" class="btn btn-secondary btn-sm">Voltar</a>
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
        urlIndexLogo: String,
    },
    data() {
        return {
            logo: {
                name: '',
                imageFile: null,
            },
            alertStatus: null,
            messages: [],
        };
    },
    methods: {
        loadImage(e) {
            this.logo.imageFile = e.target.files[0];
        },
        save() {
            let formData = new FormData();
            formData.append('name', this.logo.name);
            formData.append('image', this.logo.imageFile);

            axios.post('/admin/site/logo/store', formData, {
                headers: {
                    'Content-Type': 'multipart/form-data'
                }
            })
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
