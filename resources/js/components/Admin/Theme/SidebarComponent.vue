<template>
    <div class="sidebar">
        <div class="logo">
            <a :href="urlHome" class="logo-link">
                <img v-show="logo" :src="'/storage/' + logo" alt="Logo" class="logo-img">
            </a>
        </div>
        <ul class="sidebar-list">
            <li v-for="menu in menus" :key="menu.id">
                <template v-if="menu.children && menu.children.length > 0">
                    <div>
                        <a href="#" class="sidebar-nav" @click.prevent="toggleSubmenu(menu)">
                            <i id="icon" :class="menu.icon"></i>
                            <span style="margin-left: 10px;">{{ menu.label }}</span>
                            <i class="bi bi-caret-down" :class="{ 'open': menu.expanded }"></i>
                        </a>
                        <ul class="sidebar-submenu-list" v-show="menu.expanded">
                            <li v-for="child in menu.children" :key="child.id">
                                <a class="sidebar-nav" :href="child.url">
                                    <i id="icon" :class="child.icon"></i>
                                    <span style="margin-left: 10px;">{{ child.label }}</span>
                                </a>
                            </li>
                        </ul>
                    </div>
                </template>
                <template v-else>
                    <a class="sidebar-nav" :href="menu.url">
                        <i id="icon" :class="menu.icon"></i>
                        <span style="margin-left: 10px;">{{ menu.label }}</span>
                    </a>
                </template>
            </li>
        </ul>
    </div>
</template>

<script>
export default {
    name: 'Sidebar',
    props: {
        urlHome: String,
        logo: String,
    },
    data() {
        return {
            menus: [],
            submenuState: {},
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
