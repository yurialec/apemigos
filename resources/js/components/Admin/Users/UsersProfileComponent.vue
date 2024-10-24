<template>
    <div class="card">
        <div class="card-header">
            <h4>Meu Cadastro</h4>
        </div>
        <div class="card-body">

            <div v-if="this.alertStatus === true"
                class="alert alert-success alert-dismissible fade show col-lg-4 offset-lg-4" role="alert">
                <i class="fa-regular fa-circle-check"></i> Registro atualizado com sucesso
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
            </div>

            <div v-if="this.alertStatus === false" class="alert alert-danger alert-dismissible fade show" role="alert">
                <i class="fa-regular fa-circle-xmark"></i> Erro ao atualizar registro
                <hr>
                <ul v-for="msg in this.messages.data.errors">
                    <li>{{ msg[0] }}</li>
                </ul>
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
            </div>

            <div v-if="loading" class="d-flex justify-content-center">
                <div class="spinner-border" role="status">
                    <span class="visually-hidden">Loading...</span>
                </div>
            </div>

            <form v-else method="POST" action="" @submit.prevent="save()" class="col-lg-4 offset-lg-4"
                autocomplete="off">
                <div class="form-group">
                    <label>Nome</label>
                    <input type="text" class="form-control" v-model="userProfile.name" autocomplete="off">
                </div>
                <div class="form-group">
                    <label>Email</label>
                    <input type="text" class="form-control" v-model="userProfile.email" @input="validateEmail"
                        autocomplete="off">

                    <div style="margin-top: 10px;" v-if="validEmail === false" class="alert alert-danger" role="alert">
                        E-mail inválido.
                    </div>
                </div>

                <div class="form-group">
                    <label>Perfil</label>
                    <input type="text" disabled class="form-control" v-model="userProfile.role">
                </div>

                <div class="form-group">
                    <label>Permissões</label><br>

                    <strong>
                        <p v-show="userProfile.permissions.length == 0">Você não tem nenhuma permissão</p>
                    </strong>

                    <span id="span-role-permissions" v-for="permission in userProfile.permissions" :key="permission.id"
                        class="badge bg-success">
                        {{ permission.label }}
                    </span>
                </div>

                <div class="form-group" v-show="changePassword">
                    <hr>
                    <div class="container">
                        <div class="row">
                            <div class="col-sm">
                                <label>Senha</label>
                                <input :type="inputPass ? 'text' : 'password'" class="form-control"
                                    v-model="userProfile.password" @input="passwordCheck" autocomplete="new-password">
                            </div>
                            <div class="col-sm">
                                <label>Confirmar senha</label>
                                <div class="input-group">
                                    <input :type="inputPass ? 'text' : 'password'" class="form-control"
                                        v-model="confirmPassword" autocomplete="new-password">
                                    <div class="input-group-prepend">
                                        <div class="input-group-text">
                                            <button class="btn" style="padding: 0;" type="button"
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
                            <small style="color: green; margin-bottom: 1px;" v-else>No mínimo 6 caracteres.</small>
                            <br>
                            <small style="color: red; margin-bottom: 1px;" v-if="!has_lowercase">Conter pelo menos uma
                                letra.</small>
                            <small style="color: green; margin-bottom: 1px;" v-else>Conter pelo menos uma letra.</small>
                            <br>
                            <small style="color: red; margin-bottom: 1px;" v-if="!has_number">Conter pelo menos um
                                número.</small>
                            <small style="color: green; margin-bottom: 1px;" v-else>Conter pelo menos um número.</small>
                            <br>
                            <small style="color: red; margin-bottom: 1px;" v-if="!has_special">Conter pelo menos um
                                caractere especial.</small>
                            <small style="color: green; margin-bottom: 1px;" v-else>Conter pelo menos um caractere
                                especial.</small>
                            <br>
                            <small style="color: red; margin-bottom: 1px;"
                                v-if="userProfile.password !== confirmPassword">A confirmação de senha precisa ser igual
                                a senha.</small>
                        </div>
                    </div>
                </div>

                <div class="container" style="margin-top: 10px;">
                    <div class="row">
                        <div class="col text-start">
                            <button class="btn btn-primary btn-sm" @click.prevent="changePass()">Alterar senha</button>
                        </div>
                        <div class="col text-end">
                            <button class="btn btn-primary btn-sm" type="submit">Atualizar</button>
                        </div>
                    </div>
                </div>
            </form>
        </div>
    </div>
</template>

<script>
import axios from 'axios';

export default {
    data() {
        return {
            user: {},
            userProfile: {
                name: '',
                email: '',
                role: '',
                permissions: [],
                password: '',
            },
            confirmPassword: '',
            inputPass: false,
            has_number: '',
            has_lowercase: '',
            has_special: '',
            has_six_chars: '',
            changePassword: false,
            validEmail: null,
            alertStatus: null,
            msg: [],
            loading: null,
        };
    },
    mounted() {
        this.getProfile();
    },
    methods: {
        validateEmail() {
            const emailPattern = /^\w+([\.-]?\w+)*@\w+([\.-]?\w+)*(\.\w{2,3})+$/;
            this.validEmail = emailPattern.test(this.userProfile.email);
        },
        getProfile() {
            this.loading = true;
            axios.get('admin/users/profile')
                .then(response => {
                    this.user = response.data.profile;
                    this.userProfile.name = this.user.name;
                    this.userProfile.email = this.user.email;
                    this.userProfile.role = this.user.role.name;
                    this.userProfile.permissions = this.user.role.permissions;
                })
                .catch(error => {

                })
                .finally(() => {
                    this.loading = false
                });
        },
        save() {
            const payload = {
                name: this.userProfile.name,
                email: this.userProfile.email,
                role_id: this.user.role_id
            };

            if (this.userProfile.password) {
                payload.password = this.userProfile.password;
            }
            axios.post('/admin/users/update/' + this.user.id, payload)
                .then(response => {
                    this.alertStatus = true;
                    this.msg = response.data;
                })
                .catch(errors => {
                    this.alertStatus = false;
                    this.msg = errors.response.data;
                });
        },
        changePass() {
            this.changePassword = !this.changePassword;
            if (!this.changePassword) {
                this.userProfile.password = '';
                this.confirmPassword = '';
            }
        },
        passwordCheck() {
            if (this.userProfile.password) {
                this.has_number = /\d/.test(this.userProfile.password);
                this.has_lowercase = /[a-zA-Z]/.test(this.userProfile.password);
                this.has_special = /[!@#\$%\^\&*\)\(+=._-]/.test(this.userProfile.password);
                this.has_six_chars = this.userProfile.password.length >= 6;
            }
        },
        showPassword() {
            this.inputPass = !this.inputPass;
        },
    },
}
</script>
