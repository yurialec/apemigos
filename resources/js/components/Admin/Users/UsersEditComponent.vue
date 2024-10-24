<template>
    <div class="card">
        <div class="card-header">
            <h4>Editar Usuário</h4>
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
                            <i class="bi bi-check2-circle"></i> Registro atualizado com sucesso
                            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                        </div>

                        <div v-if="alertStatus === false" class="alert alert-danger alert-dismissible fade show"
                            role="alert">
                            <i class="bi bi-exclamation-circle"></i> Erro ao atualizar registro
                            <hr>
                            <ul v-for="msg in messages.data.errors">
                                <li>{{ msg[0] }}</li>
                            </ul>
                            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                        </div>

                        <div class="form-group">
                            <label>Nome</label>
                            <input type="text" class="form-control" v-model="user.user.name">
                        </div>

                        <div class="form-group">
                            <label>Perfil</label>
                            <select class="form-control" v-model="user.user.role_id">
                                <option v-for="role in this.roles" :value="role.id">{{ role.name }}</option>
                            </select>
                        </div>

                        <div class="form-group">
                            <label>E-mail</label>
                            <input type="text" class="form-control" v-model="user.user.email" @input="validateEmail"
                                autocomplete="off">

                            <div style="margin-top: 10px;" v-if="validEmail === false" class="alert alert-danger"
                                role="alert">
                                E-mail inválido.
                            </div>
                        </div>


                        <div class="form-group" v-show="changePassword">
                            <hr>
                            <div class="container">
                                <div class="row">
                                    <div class="col-sm">
                                        <label>Senha</label>
                                        <input :type="inputPass ? 'text' : 'password'" class="form-control"
                                            v-model="user.password" @input="passwordCheck" autocomplete="new-password">
                                    </div>
                                    <div class="col-sm">
                                        <label>Confirmar senha</label>
                                        <div class="input-group">
                                            <input :type="inputPass ? 'text' : 'password'" class="form-control"
                                                v-model="confirmPassword" autocomplete="new-password">
                                            <div class="input-group-prepend">
                                                <div class="input-group-text">
                                                    <button class="btn btn-outline-secondary btn-sm" type="button"
                                                        @click="showPassword()" id="button-addon2">
                                                        <i class="bi bi-eye"></i>
                                                    </button>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <div class="col-sm" style="margin-top: 5px;">
                                <div>
                                    <h6>Requisitos mínimos para a senha:</h6>
                                </div>
                                <div>
                                    <small style="color: red; margin-bottom: 1px;" v-if="!has_six_chars">No mínimo 6
                                        caracteres.</small>
                                    <small style="color: green; margin-bottom: 1px;" v-else>No mínimo 6
                                        caracteres.</small>
                                    <br>
                                    <small style="color: red; margin-bottom: 1px;" v-if="!has_lowercase">Conter pelo
                                        menos uma
                                        letra.</small>
                                    <small style="color: green; margin-bottom: 1px;" v-else>Conter pelo menos uma
                                        letra.</small>
                                    <br>
                                    <small style="color: red; margin-bottom: 1px;" v-if="!has_number">Conter pelo menos
                                        um
                                        número.</small>
                                    <small style="color: green; margin-bottom: 1px;" v-else>Conter pelo menos um
                                        número.</small>
                                    <br>
                                    <small style="color: red; margin-bottom: 1px;" v-if="!has_special">Conter pelo menos
                                        um
                                        caractere especial.</small>
                                    <small style="color: green; margin-bottom: 1px;" v-else>Conter pelo menos um
                                        caractere
                                        especial.</small>
                                    <br>
                                    <small style="color: red; margin-bottom: 1px;"
                                        v-if="user.password !== confirmPassword">A confirmação de senha precisa
                                        ser igual
                                        a senha.</small>
                                </div>
                            </div>
                        </div>

                        <div class="container" style="margin-top: 10px;">
                            <div class="row">
                                <div class="col text-end">
                                    <button class="btn btn-primary btn-sm" @click.prevent="changePass()">
                                        Alterar senha
                                    </button>
                                </div>
                            </div>
                        </div>

                        <div class="row mt-5">
                            <div class="col-sm-6">
                                <div class="text-start">
                                    <a :href="urlIndexUser" class="btn btn-secondary btn-sm">Voltar</a>
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
import { computed } from 'vue';
import { useStore } from 'vuex';

export default {
    props: {
        userById: {
            type: String,
            required: true
        },
        urlIndexUser: String,
    },
    setup() {
        const store = useStore();
        const loggedUser = computed(() => store.getters.getUser);

        return {
            loggedUser
        };
    },
    data() {
        return {
            roles: [],
            user: {
                user: JSON.parse(this.userById),
                password: '',
            },
            confirmPassword: '',
            inputPass: false,
            has_number: '',
            has_lowercase: '',
            has_special: '',
            has_six_chars: '',
            alertStatus: null,
            messages: [],
            changePassword: false,
            validEmail: null,
            loading: null,
        };
    },
    mounted() {
        this.getRoles();
    },
    methods: {
        validateEmail() {
            const emailPattern = /^\w+([\.-]?\w+)*@\w+([\.-]?\w+)*(\.\w{2,3})+$/;
            this.validEmail = emailPattern.test(this.user.user.email);
        },
        getRoles() {
            this.loading = true;
            axios.get('/admin/roles/list')
                .then(response => {
                    this.roles = response.data.roles.data;
                })
                .catch(errors => {

                }).finally(() => {
                    this.loading = false
                });
        },
        save() {
            const payload = {
                name: this.user.user.name,
                email: this.user.user.email,
                role_id: this.user.user.role_id,
            };
            if (this.user.password) {
                payload.password = this.user.password;
            }
            axios.post('/admin/users/update/' + this.user.user.id, payload)
                .then(response => {
                    this.alertStatus = true;
                    this.messages = response.data;
                })
                .catch(errors => {
                    this.alertStatus = false;
                    this.messages = errors.response;
                });
        },
        changePass() {
            this.changePassword = !this.changePassword;
            if (!this.changePassword) {
                this.user.password = '';
                this.confirmPassword = '';
            }
        },
        passwordCheck() {
            if (this.user.password) {
                this.has_number = /\d/.test(this.user.password);
                this.has_lowercase = /[a-zA-Z]/.test(this.user.password);
                this.has_special = /[!@#\$%\^\&*\)\(+=._-]/.test(this.user.password);
                this.has_six_chars = this.user.password.length >= 6;
            }
        },
        showPassword() {
            this.inputPass = !this.inputPass;
        },
    }
}
</script>
