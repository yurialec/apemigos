<template>
    <div class="card">
        <div class="card-header">
            <h4>Cadastrar Sobre</h4>
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
                        <i class="fa-solid fa-triangle-exclamation"></i>
                        Você não tem permissão para acessar essa funcionalidade
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
                        <label>Imagem</label>
                        <img v-show="urlImage" class="form-control mb-3" :src="urlImage" width="200">
                        <input type="file" required class="form-control" @change="loadImage">
                    </div>

                    <div class="form-group">
                        <label>Título</label>
                        <input type="text" class="form-control" v-model="about.title">
                    </div>

                    <div class="form-group">
                        <label>Descrição</label>
                        <textarea class="form-control" rows="5" v-model="about.description"></textarea>
                    </div>

                    <div class="row mt-5">
                        <div class="col-sm-6">
                            <div class="text-start">
                                <a :href="urlIndexAbout" class="btn btn-secondary btn-sm">Voltar</a>
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
        urlIndexAbout: String,
    },
    data() {
        return {
            about: {
                title: '',
                description: '',
                image: null,
            },
            urlImage: null,
            alertStatus: null,
            messages: [],
        };
    },
    methods: {
        loadImage(e) {
            this.about.image = e.target.files[0];
            this.urlImage = URL.createObjectURL(this.about.image);
        },
        save() {
            let formData = new FormData();

            if (this.about.image) {
                formData.append('image', this.about.image);
            }

            if (this.about.title) {
                formData.append('title', this.about.title);
            }

            if (this.about.description) {
                formData.append('description', this.about.description);
            }

            axios.post('/admin/site/site-about/store', formData, {
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
