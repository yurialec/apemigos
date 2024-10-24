<template>
    <div class="card">
        <div class="card-header">
            <h4>Cadastrar Blog</h4>
        </div>
        <div class="card-body">
            <div class="row justify-content-center">
                <div class="col-sm-6">
                    <form method="POST" @submit.prevent="save" class="col-lg-12" autocomplete="off">
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
                            <ul v-for="(errors, index) in messages.data.errors" :key="index">
                                <li v-for="message in errors" :key="message">{{ message }}</li>
                            </ul>
                            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                        </div>

                        <div class="form-group">
                            <label>Título</label>
                            <input type="text" class="form-control" v-model="blog.title">
                        </div>

                        <div class="form-group">
                            <label>Descrição</label>
                            <textarea class="form-control mb-3" v-model="blog.description"></textarea>
                        </div>

                        <hr>

                        <div class="form-group">
                            <input class="form-control mb-3 mt-3" type="file" multiple @change="onFileChange" />

                            <div class="jumbotron">
                                <div class="row">
                                    <div class="div-blog-image col-md-4" v-for="(image, index) in images" :key="index">
                                        <button class="btn btn-danger btn-sm mb-2" type="button"
                                            @click="removeImage(index)"
                                            style="position: absolute;  top: 5px;  right: 5px;  z-index: 10;">
                                            &times;
                                        </button>

                                        <img :src="image.preview" class="preview img-thumbnail"
                                            style="width: 100%;  border-radius: 10px;  object-fit: cover;" />

                                        <div style="text-align: center;  padding: 10px 0; font-weight: bold;">
                                            {{ image.name }}
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="row mt-5">
                            <div class="col-sm-6 text-start">
                                <a :href="urlIndexBlog" class="btn btn-secondary btn-sm">Voltar</a>
                            </div>
                            <div class="col-sm-6 text-end">
                                <button class="btn btn-primary btn-sm" type="submit">Cadastrar</button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</template>

<script>
import axios from 'axios';

export default {
    props: {
        urlIndexBlog: String,
    },
    data() {
        return {
            blog: {
                title: '',
                description: '',
            },
            images: [],
            alertStatus: null,
            messages: [],
        };
    },
    methods: {
        onFileChange(e) {
            const selectedFiles = e.target.files;
            for (let i = 0; i < selectedFiles.length; i++) {
                let reader = new FileReader();
                let file = selectedFiles[i];
                reader.onload = (event) => {
                    this.images.push({
                        file: file,
                        name: file.name,
                        preview: event.target.result
                    });
                };
                reader.readAsDataURL(file);
            }
        },
        removeImage(index) {
            this.images.splice(index, 1);
        },
        save() {
            const formData = new FormData();
            formData.append('title', this.blog.title);
            formData.append('description', this.blog.description);

            this.images.forEach((image, index) => {
                formData.append(`images[${index}]`, image.file);
            });

            axios.post('/admin/blog/store', formData, {
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
