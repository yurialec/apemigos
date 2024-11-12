<template>
    <div id="layoutSidenav_nav">
        <nav class="sb-sidenav accordion sb-sidenav-dark" id="sidenavAccordion">
            <div class="sb-sidenav-menu">
                <div class="nav">
                    <template v-for="menu in menus" :key="menu.id">
                        <template v-if="menu.children && menu.children.length > 0">
                            <a class="nav-link collapsed" href="#" @click.prevent="toggleSubmenu(menu)"
                                data-bs-toggle="collapse" :data-bs-target="'#collapse' + menu.id" aria-expanded="false"
                                :aria-controls="'collapse' + menu.id">
                                <div class="sb-nav-link-icon">
                                    <i :class="menu.icon"></i>
                                </div>
                                {{ menu.label }}
                                <div class="sb-sidenav-collapse-arrow">
                                    <i class="bi bi-chevron-down"></i>
                                </div>
                            </a>
                            <div class="collapse" :id="'collapse' + menu.id" :class="{ show: menu.expanded }"
                                data-bs-parent="#sidenavAccordion">
                                <nav class="sb-sidenav-menu-nested nav">
                                    <a v-for="child in menu.children" :key="child.id" class="nav-link"
                                        :href="child.url">
                                        <i :class="child.icon"></i>
                                        {{ child.label }}
                                    </a>
                                </nav>
                            </div>
                        </template>
                        <template v-else>
                            <a class="nav-link" :href="menu.url">
                                <div class="sb-nav-link-icon">
                                    <i :class="menu.icon"></i>
                                </div>
                                {{ menu.label }}
                            </a>
                        </template>
                    </template>
                </div>
            </div>
            <div class="sb-sidenav-footer">
                Nome: {{ this.userName }}<br>
                Perfil: {{ this.role }}
            </div>
        </nav>
    </div>
</template>

<script>
export default {
    name: 'Sidebar',
    props: {
        userName: String,
        role: String,
    },
    data() {
        return {
            menus: [],
        };
    },
    created() {
        this.getMenus();
    },
    methods: {
        getMenus() {
            axios.get('/admin/menus')
                .then(response => {
                    this.menus = response.data.map(menu => {
                        return { ...menu, expanded: false };
                    });
                })
                .catch(error => {
                    console.error(error);
                });
        },
        toggleSubmenu(menu) {
            menu.expanded = !menu.expanded;
            this.closeAllSubmenus(menu);
        },
        closeAllSubmenus(currentMenu) {
            this.menus.forEach(menu => {
                if (menu !== currentMenu && menu.expanded) {
                    menu.expanded = false;
                }
            });
        }
    }
};
</script>
