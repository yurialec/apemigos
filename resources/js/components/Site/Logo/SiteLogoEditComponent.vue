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

                <form v-else method="POST" action="" @submit.prevent="save()" class="col-lg-6" autocomplete="off">
                    <div v-if="alertStatus === true" class="alert alert-success alert-dismissible fade show"
                        role="alert">
                        <i class="fa-regular fa-circle-check"></i> Registro atualizado com sucesso
                        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                    </div>

                    <div v-if="alertStatus === false" class="alert alert-danger alert-dismissible fade show"
                        role="alert">
                        <i class="fa-regular fa-circle-xmark"></i> Erro ao atualizar registro
                        <hr>
                        <ul v-for="msg in messages.data.errors">
                            <li>{{ msg[0] }}</li>
                        </ul>
                        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                    </div>

                    <div class="form-group">
                        <label>Nome</label>
                        <input type="text" class="form-control" v-model="logo.logo.name">
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
        logoById: {
            type: String,
            required: true
        },
        urlIndexLogo: String,
    },
    data() {
        return {
            logo: {
                logo: JSON.parse(this.logoById),
            },
            alertStatus: null,
            messages: [],
            loading: null,
        };
    },
    mounted() {
    },
    methods: {
        loadImage(e) {
            this.logo.logo.imageFile = e.target.files[0];
        },
        save() {
            let formData = new FormData();
            formData.append('name', this.logo.logo.name);
            if (this.logo.logo.imageFile) {
                formData.append('imageFile', this.logo.logo.imageFile);
            }

            axios.post('/admin/site/logo/update/' + this.logo.logo.id, formData, {
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
