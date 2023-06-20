<template>
    <div class="d-flex overflow-auto hidden-scroll pe-2 w-100">
        <div class="w-50 overflow-auto hidden-scroll wm-420px pb-5" style="border-right: 2px solid #ede8e8;">
            <orderMiddleInformation :state="informationState" />
            
        </div>
        <div class="w-50 py-2 px-5 h-100 overflow-auto hidden-scroll wm-420px">
            <productosOrdenesComida :products="informationProducts" />
        </div>
    </div>
</template>

<script setup>
import orderMiddleInformation from '../partials/orderMiddleInformation.vue';
import productosOrdenesComida from '../partials/productosOrdenesComida.vue';
import { ref, onMounted } from 'vue';
import { useRoute } from 'vue-router';

const refQrOrdenModal = ref()
let route = useRoute()

let props = defineProps({
    informationState:{
        type: Object,
        required: false,
        default: () => {}
    },
    informationProducts:{
        type: Array,
        required: false,
        default: () => []
    }
})

</script>

<style lang="scss" scoped>

</style>