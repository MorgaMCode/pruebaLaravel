<template>
    <div class="d-middle gap-2 h-54px border-bottom cr-pointer card-coupon">
        <div class="leftBar w-4px h-40px bg-blue" />
        <p class="f-12">{{ data.text }}</p>
        <div class="ms-auto d-middle me-3">
            <div v-if="data.notificacion" class="d-middle">
                <p class="f-12">{{ data.notificacion }}</p>
                <i class="icon-product f-23 me-2" />
            </div>
            <div v-if="data.restaurants" class="d-middle">
                <p class="f-12">{{ data.restaurants }}</p>
                <i class="icon-restaurant f-23" />
            </div>
        </div>
    </div>
</template>

<script setup>

let prop = defineProps({
    data: {
        type: Object,
        required: true,
        default: () => {}
    }
})

</script>

<style lang="scss" scoped>

.card-coupon{
    &:hover > .leftBar{
        visibility: visible;
    }
    &:hover{
        background-color: var(--blue-lightest);
    }
}
.leftBar{
    border-radius: 0px 2px 2px 0px;
    visibility: hidden;
}

</style>