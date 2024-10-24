<template>
    <div class="card">
        <div class="card-header">
            <h4>Editar Informações Contato</h4>
        </div>
        <div class="card-body">
            <div class="d-flex justify-content-center">

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

                    <div v-if="loading === true" class="d-flex justify-content-center">
                        <button class="btn btn-primary" type="button" disabled>
                            <span class="spinner-border spinner-border-sm" role="status" aria-hidden="true"></span>
                        </button>
                    </div>


                    <div v-else class="container">
                        <div class="row">
                            <div class="col-sm">
                                <div class="form-group mb-3">
                                    <label>CEP</label>
                                    <input type="text" class="form-control" @keyup="searchCep()"
                                        v-model="contact.contact.zipcode" autocomplete="off" v-mask="'########'">
                                </div>
                                <div class="form-group mb-3">
                                    <label>Estado</label>
                                    <select class="form-control" v-model="contact.contact.state">
                                        <option v-for="(name, abbreviation) in states" :key="abbreviation"
                                            :value="abbreviation">
                                            {{ name }}
                                        </option>
                                    </select>
                                </div>
                                <div class="form-group mb-3">
                                    <label>Endereço</label>
                                    <input type="text" class="form-control" v-model="contact.contact.address"
                                        autocomplete="off">
                                </div>
                            </div>
                            <div class="col-sm">
                                <div class="form-group mb-3">
                                    <label>Telefone</label>
                                    <input type="text" class="form-control" v-model="contact.contact.phone"
                                        @input="validatePhone" maxlength="11" autocomplete="off">

                                    <small v-if="this.validPhone === false" class="text-danger">Telefone
                                        inválido</small>
                                </div>

                                <div class="form-group mb-3">
                                    <label>E-mail</label>
                                    <input type="text" class="form-control" v-model="contact.contact.email"
                                        @input="validateEmail" autocomplete="off">

                                    <small v-if="this.validEmail === false" class="text-danger">
                                        E-mail inválido
                                    </small>
                                </div>

                                <div class="form-group mb-3">
                                    <label>Cidade</label>
                                    <input type="text" class="form-control" v-model="contact.contact.city"
                                        autocomplete="off">
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="row mt-5">
                        <div class="col-sm-6">
                            <div class="text-start">
                                <a :href="urlIndexContact" class="btn btn-secondary btn-sm">Voltar</a>
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

export default {
    props: {
        contactById: {
            type: String,
            required: true
        },
        urlIndexContact: String,
    },
    data() {
        return {
            contact: {
                contact: JSON.parse(this.contactById),
            },
            alertStatus: null,
            messages: [],
            loading: null,
            dataZipCode: null,
            validPhone: null,
            validEmail: null,
            validZipCode: null,
            states: {
                'AC': 'Acre',
                'AL': 'Alagoas',
                'AP': 'Amapá',
                'AM': 'Amazonas',
                'BA': 'Bahia',
                'CE': 'Ceará',
                'DF': 'Distrito Federal',
                'ES': 'Espírito Santo',
                'GO': 'Goiás',
                'MA': 'Maranhão',
                'MT': 'Mato Grosso',
                'MS': 'Mato Grosso do Sul',
                'MG': 'Minas Gerais',
                'PA': 'Pará',
                'PB': 'Paraíba',
                'PR': 'Paraná',
                'PE': 'Pernambuco',
                'PI': 'Piauí',
                'RJ': 'Rio de Janeiro',
                'RN': 'Rio Grande do Norte',
                'RS': 'Rio Grande do Sul',
                'RO': 'Rondônia',
                'RR': 'Roraima',
                'SC': 'Santa Catarina',
                'SP': 'São Paulo',
                'SE': 'Sergipe',
                'TO': 'Tocantins'
            },
        };
    },
    mounted() {
    },
    methods: {
        searchCep() {
            if (this.contact.contact.zipcode.length == 8) {
                this.loading = true;
                axios.get('admin/cep/' + this.contact.contact.zipcode)
                    .then(response => {
                        this.dataZipCode = response.data;

                        console.log(this.dataZipCode);


                        if (this.dataZipCode) {
                            this.contact.contact.city = this.dataZipCode.localidade
                            this.contact.contact.state = this.dataZipCode.uf
                            this.contact.contact.address = this.dataZipCode.logradouro
                            this.contact.contact.zipcode = this.dataZipCode.cep
                        }
                    }).catch(error =>
                        console.log(error)
                    ).finally(() => {
                        this.loading = false;
                    });
            }
        },
        validateEmail() {
            const emailPattern = /^\w+([\.-]?\w+)*@\w+([\.-]?\w+)*(\.\w{2,3})+$/;
            this.validEmail = emailPattern.test(this.contact.contact.email);
        },
        validatePhone() {

            this.validPhone = true;
            this.contact.contact.phone = this.contact.contact.phone.replace(/\D/g, '');

            if (!(this.contact.contact.phone.length >= 10 && this.contact.contact.phone.length <= 11)) {
                this.validPhone = false;
                return;
            }

            if (this.contact.contact.phone.length === 11 && parseInt(this.contact.contact.phone.substring(2, 3)) !== 9) {
                this.validPhone = false;
                return;
            }

            for (var n = 0; n < 10; n++) {
                if (this.contact.contact.phone == new Array(11).join(n) || this.contact.contact.phone == new Array(12).join(n)) this.validPhone = false;
            }

            var codigosDDD = [11, 12, 13, 14, 15, 16, 17, 18, 19,
                21, 22, 24, 27, 28, 31, 32, 33, 34,
                35, 37, 38, 41, 42, 43, 44, 45, 46,
                47, 48, 49, 51, 53, 54, 55, 61, 62,
                64, 63, 65, 66, 67, 68, 69, 71, 73,
                74, 75, 77, 79, 81, 82, 83, 84, 85,
                86, 87, 88, 89, 91, 92, 93, 94, 95,
                96, 97, 98, 99];

            if (codigosDDD.indexOf(parseInt(this.contact.contact.phone.substring(0, 2))) == -1) this.validPhone = false;

            if (new Date().getFullYear() < 2017) this.validPhone = true;
            if (this.contact.contact.phone.length == 10 && [2, 3, 4, 5, 7].indexOf(parseInt(this.contact.contact.phone.substring(2, 3))) == -1) this.validPhone = false;

            if (!this.validPhone) return;
        },
        save() {
            let formData = new FormData();

            if (this.contact.contact.phone) {
                formData.append('phone', this.contact.contact.phone);
            }
            if (this.contact.contact.email) {
                formData.append('email', this.contact.contact.email);
            }
            if (this.contact.contact.city) {
                formData.append('city', this.contact.contact.city);
            }
            if (this.contact.contact.state) {
                formData.append('state', this.contact.contact.state);
            }
            if (this.contact.contact.address) {
                formData.append('address', this.contact.contact.address);
            }
            if (this.contact.contact.zipcode) {
                formData.append('zipcode', this.contact.contact.zipcode);
            }

            axios.post('/admin/site/contact/update/' + this.contact.contact.id, formData)
                .then(response => {
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
