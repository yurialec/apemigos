<template>
    <div class="card">
        <div class="card-header">
            <h4>Editar Sobre</h4>
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

                    <div class="form-group mb-3">
                        <label>Imagem</label>

                        <img v-show="!newImage" :src="'/storage/' + about.about.image" class="form-control mb-3"
                            width="200">

                        <img v-show="newImage" class="form-control mb-3" :src="urlImage" width="200">

                        <input type="file" class="form-control mb-3" @change="loadImage">
                    </div>

                    <div class="form-group mb-3">
                        <label>Título</label>
                        <input type="text" class="form-control" v-model="about.about.title">
                    </div>

                    <div class="form-group mb-3">
                        <label>Descrição</label>
                        <input type="text" class="form-control" v-model="about.about.description">
                    </div>

                    <div class="row mt-5">
                        <div class="col-sm-6">
                            <div class="text-start">
                                <a :href="urlIndexAbout" class="btn btn-secondary btn-sm">Voltar</a>
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
        aboutById: {
            type: String,
            required: true
        },
        urlIndexAbout: String,
    },
    data() {
        return {
            about: {
                about: JSON.parse(this.aboutById),
            },
            alertStatus: null,
            messages: [],
            loading: null,
            newImage: null,
            urlImage: null,
        };
    },
    mounted() {
    },
    methods: {
        loadImage(e) {
            this.newImage = e.target.files[0];
            this.urlImage = URL.createObjectURL(this.newImage);
        },
        save() {
            let formData = new FormData();

            if (this.newImage) {
                formData.append('image', this.newImage);
            }

            if (this.about.about.title) {
                formData.append('title', this.about.about.title);
            }

            if (this.about.about.description) {
                formData.append('description', this.about.about.description);
            }

            axios.post('/admin/site/site-about/update/' + this.about.about.id, formData, {
                headers: {
                    'Content-Type': 'multipart/form-data'
                }
            }).then(response => {
                this.alertStatus = true;
                this.messages = response.data;
            }).catch(errors => {
                this.alertStatus = false;
                this.messages = errors.response;
            });
        },
    }
}
</script>
