<template>
    <nav class="navbar">
        <div class="navbar-content">
            <button class="btn custom-btn" @click="handleClick">
                <i class="bi bi-list fs-2"></i>
            </button>
        </div>
        <div class="navbar-content">
            <div class="avatar" @click="toggleDropdown">
                {{ this.user.name }}&nbsp;&nbsp;&nbsp;<i class="bi bi-person fs-3"></i>
                <div class="dropdown-menu setting" :class="{ active: showDropdown }">
                    <a class="item" :href="urlProfile">
                        <span class="bi bi-person fs-4"></span> Meu Cadastro
                    </a>
                    <a class="item" :href="urlSair">
                        <span class="bi bi-box-arrow-right fs-4"></span> Sair
                    </a>
                </div>
            </div>
        </div>
    </nav>
</template>

<script>
export default {
    name: 'Header',
    props: {
        urlSair: String,
        urlProfile: String,
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
            let sidebar = document.querySelector(".sidebar");
            sidebar.classList.contains("deactivate") ? sidebar.classList.remove("deactivate") : sidebar.classList.add("deactivate");
        }
    }
};
</script>
