<template>
    <div class="card">
        <div class="card-header">
            <h4>Editar Carousel</h4>
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

                        <img v-show="!newImage" :src="'/storage/' + carousel.carousel.image" class="form-control mb-3"
                            width="200">

                        <img v-show="newImage" class="form-control mb-3" :src="urlImage" width="200">

                        <input type="file" class="form-control mb-3" @change="loadImage">
                    </div>

                    <div class="form-group mb-3">
                        <label>Título</label>
                        <input type="text" class="form-control" v-model="carousel.carousel.title">
                    </div>

                    <div class="form-group mb-3">
                        <label>Descrição</label>
                        <input type="text" class="form-control" v-model="carousel.carousel.description">
                    </div>

                    <div class="form-group mb-3">
                        <label>Nome Link Externo</label>
                        <input type="text" class="form-control" v-model="carousel.carousel.name_link">

                        <small
                            v-show="carousel?.carousel?.url_link?.length > 1 && carousel?.carousel?.name_link?.length == 0"
                            style="color: red;">
                            É necessário inserir o nome do link externo
                        </small>
                    </div>

                    <div class="form-group mb-3">
                        <label>URL Link Externo</label>
                        <input type="text" class="form-control" v-model="carousel.carousel.url_link">

                        <small
                            v-show="carousel?.carousel?.name_link?.length > 1 && carousel?.carousel?.url_link.length == 0"
                            style="color: red;">
                            É necessário inserir o nome do link externo
                        </small>
                    </div>

                    <div class="row mt-5">
                        <div class="col-sm-6">
                            <div class="text-start">
                                <a :href="urlIndexCarousel" class="btn btn-secondary btn-sm">Voltar</a>
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
        carouselById: {
            type: String,
            required: true
        },
        urlIndexCarousel: String,
    },
    data() {
        return {
            carousel: {
                carousel: JSON.parse(this.carouselById),
            },
            alertStatus: null,
            messages: [],
            loading: null,
            newImage: null,
            file: '',
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

            if (this.carousel.carousel.title) {
                formData.append('title', this.carousel.carousel.title);
            }

            if (this.carousel.carousel.description) {
                formData.append('description', this.carousel.carousel.description);
            }

            if (this.carousel.carousel.url_link) {
                formData.append('url_link', this.carousel.carousel.url_link);
            }

            if (this.carousel.carousel.name_link) {
                formData.append('name_link', this.carousel.carousel.name_link);
            }

            axios.post('/admin/site/carousel/update/' + this.carousel.carousel.id, formData, {
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
