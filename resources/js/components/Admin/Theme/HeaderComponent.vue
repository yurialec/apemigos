<template>
    <nav class="sb-topnav navbar navbar-expand navbar-dark bg-dark">
        <a class="navbar-brand ps-3" :href="urlHome">
            <img v-if="logo" :src="'/storage/' + logo" alt="Logo" class="logo-img"
                style="max-width: 100%; height: 50px;">
            <h3 v-else>APEMIGOS</h3>
        </a>

        <button class="btn btn-link btn-sm order-1 order-lg-0 me-4 me-lg-0" id="sidebarToggle" href="#!"
            @click="handleClick">
            <i class="bi bi-list h3"></i>
        </button>

        <ul class="navbar-nav ms-auto me-3 me-lg-4">
            <li class="nav-item dropdown">
                <a class="nav-link dropdown-toggle" id="navbarDropdown" href="#" role="button" data-bs-toggle="dropdown"
                    aria-expanded="false">
                    <i class="bi bi-person-circle h3"></i>
                </a>
                <ul class="dropdown-menu dropdown-menu-end" aria-labelledby="navbarDropdown">
                    <li><a class="dropdown-item" :href="urlProfile">Meu Cadastro</a></li>
                    <li>
                        <hr class="dropdown-divider" />
                    </li>
                    <li><a class="dropdown-item" :href="urlSair">Sair</a></li>
                </ul>
            </li>
        </ul>
    </nav>
</template>

<script>
export default {
    name: 'Header',
    props: {
        urlSair: String,
        urlProfile: String,
        urlHome: String,
        logo: String,
    },
    data() {
        return {
            showDropdown: false,
            user: [],
        };
    },
    mounted() {
        this.getProfile();
    },
    methods: {
        toggleDropdown() {
            this.showDropdown = !this.showDropdown;
        },
        getProfile() {
            axios.get('admin/users/profile')
                .then(response => {
                    this.user = response.data.profile;
                })
                .catch(error => {
                });
        },
        handleClick() {
            let body = document.body;

            if (body.classList.contains("sb-sidenav-toggled")) {
                body.classList.remove("sb-sidenav-toggled");
            } else {
                body.classList.add("sb-sidenav-toggled");
            }
        }
    }
};
</script>
