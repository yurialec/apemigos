<template>
    <div v-if="alertStatus === true" class="alert alert-success alert-dismissible fade show" role="alert">
        <i class="fa-regular fa-circle-check"></i> Registro excluído com sucesso
        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
    </div>

    <div v-if="alertStatus === 'notAllowed'" class="alert alert-warning alert-dismissible fade show" role="alert">
        <i class="fa-solid fa-triangle-exclamation"></i> Você não tem permissão para acessar essa funcionalidade
        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
    </div>

    <div class="card">
        <div class="card-header">
            <div class="row">
                <div class="col-md-6 text-start">
                    <h3>Blog</h3>
                </div>
                <div class="col-md-6 text-end">
                    <a :href="urlCreateBlog" type="button" class="btn btn-primary btn-sm">Cadastrar</a>
                </div>
            </div>
        </div>

        <div v-if="loading === true" class="d-flex justify-content-center">
            <div class="spinner-border" role="status">
                <span class="visually-hidden">Loading...</span>
            </div>
        </div>


        <div v-else class="card-body">

            <div v-show="!blogs.length" class="text-center">
                <p>Nenhum resultado encontrado</p>
            </div>

            <div v-show="blogs.length" class="table-responsive">
                <table class="table table-sm table-hover">
                    <thead>
                        <tr>
                            <th class="col-md-2">Título</th>
                            <th class="col-md-2">Descrição</th>
                            <th class="col-md-2">Autor</th>
                            <th class="col-md-1">Ações</th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr v-for="blog in blogs" :key="blog.id">
                            <td class="col-md-2">{{ blog.title }}</td>
                            <td class="col-md-2"
                                style="max-width:100px; white-space: nowrap; overflow: hidden; text-overflow: ellipsis">
                                {{ blog.description }}
                            </td>
                            <td class="col-md-2">{{ blog.user.name }} - {{ blog.user.email }}</td>
                            <td class="col-md-1">
                                <button type="button" style="color: #333; padding: 0;" class="btn"
                                    data-bs-toggle="modal" data-bs-target="#viewImgModal" @click="viewImage(blog)">
                                    <i class="bi bi-eye"></i>
                                </button>
                                &nbsp;&nbsp;&nbsp;
                                <a :href="'/admin/blog/edit/' + blog.id">
                                    <i class="bi bi-pencil-square"></i>
                                </a>
                                &nbsp;&nbsp;&nbsp;
                                <button type="button" style="color: red; padding: 0;" class="btn" data-bs-toggle="modal"
                                    data-bs-target="#exampleModal" @click="confirmExclusion(blog.id)">
                                    <i class="bi bi-trash3"></i>
                                </button>
                            </td>
                        </tr>
                    </tbody>
                </table>
            </div>
        </div>
    </div>

    <div class="modal fade" id="viewImgModal" tabindex="-1" aria-labelledby="viewImgModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="viewImgModalLabel">Visualizar imagen do blog</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">

                    <div id="carouselExample" class="carousel slide">
                        <div class="carousel-inner">
                            <div v-for="(image, index) in selectedBlog" :key="index"
                                :class="['carousel-item', { active: index === 0 }]">
                                <img :src="'/storage/' + image.image_path" class="d-block w-100 h-30 mb-4" alt="...">
                            </div>
                        </div>
                        <button class="carousel-control-prev" type="button" data-bs-target="#carouselExample"
                            data-bs-slide="prev">
                            <span style="background-color: #333; border-radius: 10px;"
                                class="carousel-control-prev-icon" aria-hidden="true"></span>
                            <span class="visually-hidden">Previous</span>
                        </button>
                        <button class="carousel-control-next" type="button" data-bs-target="#carouselExample"
                            data-bs-slide="next">
                            <span style="background-color: #333; border-radius: 10px;"
                                class="carousel-control-next-icon" aria-hidden="true"></span>
                            <span class="visually-hidden">Next</span>
                        </button>
                    </div>

                </div>
            </div>
        </div>
    </div>

    <!-- Modal de confirmação de exclusão -->
    <div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Confirmação de Exclusão</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    Tem certeza que deseja deletar este registro?
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancelar</button>
                    <button type="button" class="btn btn-danger" @click="deleteRecord">Excluir</button>
                </div>
            </div>
        </div>
    </div>
</template>

<script>
import axios from 'axios';
import { Modal } from 'bootstrap';

export default {
    props: {
        urlCreateBlog: String,
    },
    data() {
        return {
            blogToDelete: null,
            alertStatus: null,
            msg: [],
            loading: null,
            blogs: [],
            selectedBlog: {},
        };
    },
    mounted() {
        this.getBlog();
    },
    methods: {
        getBlog() {
            this.loading = true;
            axios.get('admin/blog/list')
                .then(response => {
                    this.blogs = response.data.blogs;
                })
                .catch(errors => {
                    this.alertStatus = 'error';
                }).finally(() => {
                    this.loading = false;
                });
        },
        confirmExclusion(blogId) {
            this.blogToDelete = blogId;
        },
        deleteRecord() {
            if (this.blogToDelete !== null) {
                axios.delete('/admin/blog/delete/' + this.blogToDelete)
                    .then(response => {
                        this.getBlog();
                        this.blogToDelete = null;

                        const modal = Modal.getInstance(document.getElementById('exampleModal'));
                        if (modal) {
                            modal.hide();
                        }

                        if (response.data == '') {
                            this.alertStatus = 'notAllowed';
                        } else {
                            this.alertStatus = true;
                        }
                    })
                    .catch(errors => {
                        const modal = Modal.getInstance(document.getElementById('exampleModal'));
                        if (modal) {
                            modal.hide();
                        }

                        if (errors.response.status == 405) {
                            this.alertStatus = 'notAllowed';
                        }
                    });
            }
        },
        viewImage(blog) {
            this.selectedBlog = blog.images;
            this.$nextTick(() => {
                const carouselElement = document.getElementById('carouselExample');
                const carousel = bootstrap.Carousel.getInstance(carouselElement);
                if (carousel) {
                    carousel.to(0);
                }
            });
        }
    }
}
</script>
