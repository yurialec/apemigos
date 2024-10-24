<template>
    <div class="card">
        <div class="card-header">
            <div class="container">
                <div class="row">
                    <div class="col-sm">
                        <h4>Cadastrar Menu</h4>
                    </div>
                    <div class="col-sm text-end">
                        <a href="https://icons.getbootstrap.com/" target="_blank">Biblioteca de ícones</a>&nbsp;&nbsp;
                        <i class="bi bi-info-circle fs-4" style="color: #00a803;" data-bs-toggle="tooltip"
                            data-bs-placement="top"
                            title="Ao adicionar o nome do ícone, você deve inserir sem as tags HTML"></i>
                    </div>
                </div>
            </div>
        </div>
        <div class="card-body">
            <div class="d-flex justify-content-center">
                <form method="POST" action="" @submit.prevent="salvar()" class="col-lg-6">
                    <div v-if="this.alertStatus === true" class="alert alert-success alert-dismissible fade show"
                        role="alert">
                        <i class="fa-regular fa-circle-check"></i> Registro cadastrado com sucesso
                        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                    </div>
                    <div v-if="this.alertStatus === false" class="alert alert-danger alert-dismissible fade show"
                        role="alert">
                        <i class="fa-regular fa-circle-xmark"></i> Erro ao cadastrar registro
                        <hr>
                        <ul v-for="msg in this.messages.data.errors">
                            <li>{{ msg[0] }}</li>
                        </ul>
                        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                    </div>

                    <div class="form-group">
                        <label>Nome</label>
                        <input type="text" class="form-control" v-model="menu.label">
                    </div>

                    <div class="form-group">
                        <label>Ícone</label>
                        <input type="text" class="form-control" v-model="menu.icon">
                    </div>

                    <div class="row mt-5">
                        <div class="col-sm-6">
                            <div class="text-start">
                                <a :href="urlIndexMenu" class="btn btn-secondary btn-sm">Voltar</a>
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
        urlIndexMenu: String,
    },
    data() {
        return {
            menu: {
                label: '',
                icon: '',
            },
            alertStatus: null,
            msg: [],
            loading: null,
        };
    },
    methods: {
        salvar() {
            axios.post('/admin/menu/store', this.menu)
                .then(response => {
                    this.alertStatus = true;
                })
                .catch(errors => {
                    this.alertStatus = false;
                    this.messages = errors.response;
                });
        }
    }
}
</script>