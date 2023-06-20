<template>
    <div class="d-middle gap-2 h-54px border-bottom cr-pointer card-coupon">
        <div class="leftBar w-4px h-40px bg-blue" />
        <p class="f-12">{{ data.text }}</p>
        <div class="ms-auto d-middle me-3">
            <p class="f-12">{{ data.users }}</p>
            <i class="icon-users f-23 me-2" />
            <p class="f-12">{{ data.restaurants }}</p>
            <i class="icon-restaurant f-23" />
        </div>
    </div>
</template>

<script setup>

const prop = defineProps({
    data: {
        type: Object
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