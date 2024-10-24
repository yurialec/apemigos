<template>
    <div class="card">
        <div class="card-header">
            <div class="container">
                <div class="row">
                    <div class="col-sm">
                        <h4>Editar Menu</h4>
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
                <form method="POST" @submit.prevent="save()" class="col-lg-8" autocomplete="off">
                    <div v-if="alertStatus === true" class="alert alert-success alert-dismissible fade show"
                        role="alert">
                        <i class="fa-regular fa-circle-check"></i> Registro atualizado com sucesso
                        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                    </div>

                    <div v-if="alertStatus === false" class="alert alert-danger alert-dismissible fade show"
                        role="alert">
                        <i class="fa-regular fa-circle-xmark"></i> Erro ao atualizar registro
                        <hr>
                        <ul v-for="msg in messages.data.errors" :key="msg[0]">
                            <li>{{ msg[0] }}</li>
                        </ul>
                        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                    </div>

                    <div class="form-group">
                        <label>Nome</label>
                        <input type="text" class="form-control" v-model="menu.menu[0].label">
                    </div>

                    <div class="form-group">
                        <label>Ícone</label>
                        <input type="text" class="form-control" v-model="menu.menu[0].icon">
                    </div>

                    <div class="container mt-3">
                        <div class="row">
                            <div class="col-sm text-start">
                                Adicionar submenu
                            </div>
                            <div class="col-sm text-end">
                                <button type="button" @click="addRow" class="btn btn-primary">
                                    <i class="bi bi-plus-square"></i>
                                </button>
                            </div>
                        </div>
                    </div>

                    <hr>

                    <div class="form-group row mt-3" v-for="(child, index) in menu.menu[0].children" :key="index">
                        <div class="col-lg-3">
                            <input type="text" :name="'children[' + index + '][label]'" class="form-control"
                                placeholder="Nome" v-model="child.label">
                        </div>
                        <div class="col-lg-4">
                            <input type="text" :name="'children[' + index + '][icon]'" class="form-control"
                                placeholder="Ícone" v-model="child.icon">
                        </div>
                        <div class="col-lg-4">
                            <input type="text" :name="'children[' + index + '][url]'" class="form-control"
                                placeholder="URL" v-model="child.url">
                        </div>
                        <div class="col-lg-1">
                            <button type="button" @click="deleteRow(index)"
                                class="btn btn-outline-danger rounded-circle">
                                <i class="bi bi-x-circle-fill"></i>
                            </button>
                        </div>
                    </div>

                    <div class="row mt-5">
                        <div class="col-sm-6">
                            <div class="text-start">
                                <a :href="urlIndexMenu" class="btn btn-secondary btn-sm">Voltar</a>
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
import Multiselect from 'vue-multiselect';

export default {
    components: { Multiselect },
    props: {
        menuById: {
            type: String,
            required: true
        },
        urlIndexMenu: String,
    },
    created() {

    },
    data() {
        return {
            menu: {
                menu: JSON.parse(this.menuById),
            },
            alertStatus: null,
            messages: null,
        };
    },
    methods: {
        save() {
            axios.post('/admin/menu/update/' + this.menu.menu[0].id, this.menu)
                .then(response => {
                    this.alertStatus = true;
                    this.messages = response.data;

                    window.scrollTo(0, 0);
                })
                .catch(errors => {
                    this.alertStatus = false;
                    this.messages = errors.response;
                });
        },
        addRow() {
            this.menu.menu[0].children.push({
                label: "",
                icon: "",
                url: "",
                active: 1,
                son: this.menu.menu[0].id
            });
        },
        deleteRow(index) {
            this.menu.menu[0].children.splice(index, 1);
        }
    }
}
</script>
