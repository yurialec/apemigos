<template>
    <div class="card">
        <div class="card-header">
            <h4>Editar perfil</h4>
        </div>
        <div class="card-body">
            <div class="row justify-content-center">
                <div class="col-sm-6">
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

                    <div v-if="loading" class="d-flex justify-content-center">
                        <div class="spinner-border" role="status">
                            <span class="visually-hidden">Loading...</span>
                        </div>
                    </div>

                    <form v-else method="POST" action="" @submit.prevent="salvar">
                        <div class="form-group">
                            <label>Nome</label>
                            <input type="text" class="form-control" disabled v-model="role.role.name">
                        </div>

                        <br>

                        <div class="form-group">
                            <multiselect v-model="role.permissionsSelected" :options="permissions" :multiple="true"
                                label="label" track-by="id">
                            </multiselect>
                        </div>

                        <div class="row">
                            <div class="col-sm-6">
                                <div class="text-start" style="margin-top: 10px;">
                                    <a :href="urlIndexRole" class="btn btn-secondary btn-sm">Voltar</a>
                                </div>
                            </div>
                            <div class="col-sm-6">
                                <div class="text-end" style="margin-top: 10px;">
                                    <a href="#" class="btn btn-primary btn-sm" @click="salvar">Salvar
                                        Alterações</a>
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
import Multiselect from 'vue-multiselect';

export default {
    components: { Multiselect },
    props: {
        roleById: {
            type: String,
            required: true
        },
        urlIndexRole: String,
    },
    data() {
        return {
            role: {
                role: JSON.parse(this.roleById),
                permissionsSelected: [],
            },
            alertStatus: null,
            messages: [],
            permissions: [],
            loading: null,
        };
    },
    mounted() {
        this.getPermissions();
    },
    methods: {
        salvar() {
            const permissionsIds = this.role.permissionsSelected.map(permission => permission.id);

            const dataToSend = {
                role_id: this.role.role.id,
                name: this.role.role.name,
                permissions: permissionsIds
            };

            axios.post('/admin/roles/update/' + this.role.role.id, dataToSend)
                .then(response => {
                    this.alertStatus = true;
                })
                .catch(errors => {
                    this.alertStatus = false;
                    this.messages = errors.response;
                });
        },
        getPermissions() {
            this.loading = true;
            axios.get('/admin/roles/list-permissions')
                .then(response => {
                    this.permissions = response.data.permissions;
                    this.setSelectedPermissions();
                })
                .catch(errors => {

                }).finally(() => {
                    this.loading = false;
                });
        },
        setSelectedPermissions() {
            const selectedPermissions = this.role.role.permissions.map(permission => {
                return this.permissions.find(p => p.id === permission.id);
            });
            this.role.permissionsSelected = selectedPermissions;
        }
    }
}
</script>
