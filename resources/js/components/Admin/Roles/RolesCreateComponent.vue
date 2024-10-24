<template>
    <div class="card">
        <div class="card-header">
            <h4>Cadastrar perfil</h4>
        </div>
        <div class="card-body">
            <div class="row justify-content-center">
                <div class="col-sm-6">

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

                    <form method="POST" action="" @submit.prevent="salvar()">
                        <div class="form-group">
                            <label>Nome</label>
                            <input type="text" class="form-control" v-model="role.name">
                        </div>
                        <div class="row">
                            <div class="col-sm-6">
                                <div class="text-start">
                                    <a :href="this.urlIndexRole" class="btn btn-secondary btn-sm">Voltar</a>
                                </div>
                            </div>
                            <div class="col-sm-6">
                                <div class="text-end">
                                    <a href="#" class="btn btn-primary btn-sm" @click="salvar()">Cadastrar</a>
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
        urlIndexRole: String,
    },
    data() {
        return {
            role: {
                name: '',
            },
            alertStatus: null,
            msg: [],
            loading: null,
        };
    },
    methods: {
        salvar() {
            axios.post('/admin/roles/store', this.role)
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