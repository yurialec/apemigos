<template>
    <div style=" justify-content: center; align-items: center; margin-top: 30px;" :class="estilo" role="alert">
        {{ titulo }}
        <hr>
        <span v-if="detalhes.data.id">{{ detalhes.data.name }}</span>
        <ul v-if="detalhes.data.errors">
            <li v-for="erro, key in detalhes.data.errors" :key="key">{{ erro[0] }}</li>
        </ul>
    </div>
</template>

<script>
export default {
    props: ['tipo', 'titulo', 'detalhes'],
    computed: {
        estilo() {
            return 'alert alert-' + this.tipo
        }
    }
}
</script>
