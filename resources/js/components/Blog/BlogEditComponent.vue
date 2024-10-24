<template>
    <div class="card">
        <div class="card-header">
            <h4>Editar Blog</h4>
        </div>
        <div class="card-body">
            <div class="row justify-content-center">
                <div class="col-sm-6">

                    <div v-if="loading" class="d-flex justify-content-center">
                        <div class="spinner-border" role="status">
                            <span class="visually-hidden">Loading...</span>
                        </div>
                    </div>

                    <form v-else method="POST" action="" @submit.prevent="save()" class="col-lg-8" autocomplete="off">
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
                            <label>Título</label>
                            <input type="text" class="form-control" v-model="blog.blog.title">
                        </div>

                        <div class="form-group mb-3">
                            <label>Descrição</label>
                            <input type="text" class="form-control" v-model="blog.blog.description">
                        </div>

                        <div class="form-group mb-3">
                            <label>Imagem</label>

                            <input class="form-control mb-3 mt-3" type="file" multiple @change="onFileChange" />

                            <div class="jumbotron">
                                <div class="row">
                                    <div v-for="image in blog.blog.images" class="div-blog-image col-md-4"
                                        :key="image.id">
                                        <button @click="removeImage(image.id)" class="btn btn-danger btn-sm mb-2"
                                            type="button"
                                            style="position: absolute;  top: 5px;  right: 5px;  z-index: 10;">
                                            &times;
                                        </button>
                                        <img :src="'/storage/' + image.image_path" class="preview img-thumbnail"
                                            style="width: 100%;  border-radius: 10px;  object-fit: cover;" />
                                    </div>

                                    <div v-for="(newImage, index) in this.newImages" :key="index"
                                        class="div-blog-image col-md-4">
                                        <button @click="removeNewImages(index)" class="btn btn-danger btn-sm mb-2"
                                            type="button"
                                            style="position: absolute;  top: 5px;  right: 5px;  z-index: 10;">
                                            &times;
                                        </button>
                                        <img :src="newImage.preview" class="preview img-thumbnail"
                                            style="width: 100%;  border-radius: 10px;  object-fit: cover;" />
                                    </div>
                                </div>

                            </div>
                        </div>

                        <div class="row mt-5">
                            <div class="col-sm-6">
                                <div class="text-start">
                                    <a :href="urlIndexBlog" class="btn btn-secondary btn-sm">Voltar</a>
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
    </div>
</template>

<script>
import axios from 'axios';

export default {
    props: {
        blogById: {
            type: String,
            required: true
        },
        urlIndexBlog: String,
    },
    data() {
        return {
            blog: {
                blog: JSON.parse(this.blogById),
            },
            alertStatus: null,
            messages: [],
            loading: null,
            newImages: [],
            file: '',
        };
    },
    mounted() {
    },
    methods: {
        onFileChange(e) {
            const selectedFiles = e.target.files;
            for (let i = 0; i < selectedFiles.length; i++) {
                let reader = new FileReader();
                let file = selectedFiles[i];
                reader.onload = (event) => {
                    this.newImages.push({
                        file: file,
                        name: file.name,
                        preview: event.target.result
                    });
                };
                reader.readAsDataURL(file);
            }
        },
        removeImage(id) {
            const index = this.blog.blog.images.findIndex(image => image.id === id);
            if (index !== -1) {
                this.blog.blog.images.splice(index, 1);
            }
        },
        removeNewImages(index) {
            this.newImages.splice(index, 1);
        },
        loadImage(e) {
            this.newImage = e.target.files[0];
            this.urlImage = URL.createObjectURL(this.newImage);
        },
        save() {
            const formData = new FormData();
            formData.append('title', this.blog.blog.title);
            formData.append('description', this.blog.blog.description);

            this.newImages.forEach((image, index) => {
                formData.append(`new_images[${index}]`, image.file);
            });

            this.blog.blog.images.forEach((image, index) => {
                formData.append(`old_data[${index}]`, image.image_path);
            });

            axios.post('/admin/blog/update/' + this.blog.blog.id, formData, {
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
