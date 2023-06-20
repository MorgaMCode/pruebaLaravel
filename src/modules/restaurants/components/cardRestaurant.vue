<template>
    <div class="restaurants h-54px d-middle gap-3 cr-pointer" :class="{ 'bg-blue-lightest lineSelected': seleccionado }">
        <div class="lineBlue h-45px w-4px bg-blue" style="border-radius: 0px 2px 2px 0px;" />
        <i class="f-25 icon" :class="icons[indice].icon, { 'text-blue' : seleccionado }" />
        <p class="f-12 iconText" :class="{ 'text-blue' : seleccionado }" >{{ data.nombre }}</p>
        <div v-if="notifications" class="w-20px h-21px bg-red-badge br-11 d-middle-center ms-auto me-3">
            <span class="text-white f-12">
                {{ countStores }}
            </span>
        </div>
    </div>
</template>

<script setup>
import { computed } from "vue";

let icons = [
    {
        id: 1,
        icon: 'icon-restaurant'
    },
    {
        id: 2,
        icon: 'icon-bill'
    }
]

const props = defineProps({
    data: {
        type: Object,
        required: true
    },
    indice: {
        type: Number,
         required: false
    },
    seleccionado: {
        type: Boolean,
        required: false
    },
    countStores:{
        type: Number,
        required: false
    }
})

const notifications = computed(() => {
    if(props.data.notificaciones !== null) return props.countStores
})


</script>

<style lang="scss" scoped>
.restaurants{
    .lineBlue{
        visibility: hidden;
    }
    &:hover > .lineBlue{
        visibility: visible;
    }
    &:hover{
        background-color: var(--blue-lightest);
    }
    &.lineSelected > .lineBlue{
        visibility: visible;
    }
}

</style>