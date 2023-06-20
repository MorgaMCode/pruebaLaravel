<template>
    <section class="d-middle gap-2 w-100 py-2 ps-2 pe-4 box-shadowBoxTwo br-8 mb-2">
        <img :src="data.image" alt="">
        <p class="f-14 f-light">{{ data.content }}</p>
        <el-tooltip v-if="data.seeList" content="ver listado" placement="bottom" effect="light">
            <div @click="emit('toGoRoute')" class="cr-pointer grey-hover rounded-circle">
                <i class="icon-go-to f-20" style="color: var(--shadow-dark)" />
            </div>
        </el-tooltip>
        <p class="ms-auto f-16 f-semibold text-blue">{{ data.price }}</p>
    </section>
</template>

<script setup>

const props = defineProps({
    data: {
        type: Object
    }
})

const emit = defineEmits(['toGoRoute'])
</script>

<style lang="scss" scoped>

</style>