<template>
    <div class="card">
        <div class="card-header">
            <h4>Cadastrar Carousel</h4>
        </div>
        <div class="card-body">
            <div class="d-flex justify-content-center">
                <form method="POST" @submit.prevent="save" class="col-lg-8" autocomplete="off">
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
                        <label>Imagem</label>
                        <input type="file" required class="form-control" @change="loadImage">
                    </div>

                    <div class="form-group">
                        <label>Título</label>
                        <input type="text" class="form-control" v-model="carousel.title">
                    </div>

                    <div class="form-group">
                        <label>Texto</label>
                        <textarea class="form-control" v-model="carousel.description"></textarea>
                    </div>

                    <div class="form-group">
                        <label>Nome Link Externo</label>
                        <input type="text" class="form-control" v-model="carousel.name_link">

                        <small v-show="carousel.url_link.length && !carousel.name_link" style="color: red;">
                            É necessário inserir o nome do link externo
                        </small>
                    </div>

                    <div class="form-group">
                        <label>Url Link Externo</label>
                        <input type="text" class="form-control" v-model="carousel.url_link">

                        <small v-show="carousel.name_link.length && !carousel.url_link" style="color: red;">
                            É necessário inserir a url do link externo
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
        urlIndexCarousel: String,
    },
    data() {
        return {
            carousel: {
                title: '',
                description: '',
                image: null,
                text: '',
                name_link: '',
                url_link: '',
            },
            alertStatus: null,
            messages: [],
        };
    },
    methods: {
        loadImage(e) {
            this.carousel.image = e.target.files[0];
        },
        save() {
            let formData = new FormData();
            formData.append('title', this.carousel.title);
            formData.append('description', this.carousel.description);
            formData.append('name_link', this.carousel.name_link);
            formData.append('url_link', this.carousel.url_link);
            formData.append('image', this.carousel.image);

            axios.post('/admin/site/carousel/store', formData, {
                headers: {
                    'Content-Type': 'multipart/form-data'
                }
            })
                .then(response => {
                    this.alertStatus = true;
                    this.messages = response.data;
                })
                .catch(errors => {

                    console.log(errors);


                    this.alertStatus = false;
                    this.messages = errors.response;
                });
        },
    }
}
</script>
